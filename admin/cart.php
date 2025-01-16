<?php
require_once 'connect_bd.php'; // Подключение к базе данных

// Обработка изменения состояния выполнения заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $completed = $_POST['completed'];

    $stmt = $conn->prepare("UPDATE making_an_order SET completed = ? WHERE id = ?");
    $stmt->bind_param("ii", $completed, $order_id);
    $stmt->execute();
    $stmt->close();
    exit;
}

$sql = "SELECT * FROM making_an_order ORDER BY completed ASC, id DESC";
$result = $conn->query($sql);

$orders = [];
$total_income = 0;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
        $cart_items = json_decode($row['cart'], true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($cart_items)) {
            foreach ($cart_items as $item) {
                $total_income += $item['price'];
            }
        }
    }
} else {
    echo "Нет данных для отображения.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <!-- Подключение Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Иконки Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .table-container {
            background: rgba(58, 49, 83, 0.72);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border-collapse: collapse;
            animation: slideUp 1s ease-in-out;
        }
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .income-box {
            background-color:rgb(21, 40, 58);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cart-item {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .cart-item div {
            flex: 1 1 calc(50% - 10px);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .cart-item img {
            width: 100px;
            height: auto;
        }
        .completed {
            background-color: #d4edda !important;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.order-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const orderId = this.dataset.orderId;
                    const completed = this.checked ? 1 : 0;

                    fetch('', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `order_id=${orderId}&completed=${completed}`
                    }).then(() => {
                        if (completed) {
                            row.classList.add('completed');
                            row.parentNode.appendChild(row);
                        } else {
                            row.classList.remove('completed');
                            const tbody = row.parentNode;
                            tbody.insertBefore(row, tbody.querySelector('.completed'));
                        }
                    });
                });
            });
        });
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Боковая панель -->
            <?php require_once 'navbar.php'; ?>

            <!-- Основной контент -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Оформленные заказы:</h1>
                </div>

                <div class="income-box">
                    <h4>Общий доход</h4>
                    <p class="fs-4"><?php echo number_format($total_income, 2, ',', ' '); ?>₽</p>
                </div>

                <div class="table-responsive table-container">
                    <table class="table table-striped table-dark table-columns">
                         
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ФИО</th>
                                <th>Email и Телефон</th>
                                <th>Адрес доставки</th>
                                <th>Корзина</th>
                                <th>Детали заказа</th>
                                <th>Выполнен</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr class="<?php echo $order['completed'] ? 'completed' : ''; ?>">
                                    <td><?php echo htmlspecialchars($order['id']); ?></td>
                                    <td>
                                        <?php echo htmlspecialchars($order['last_name']) . ' ' . htmlspecialchars($order['first_name']) . ' ' . htmlspecialchars($order['middle_name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($order['email']); ?><br>
                                        <?php echo htmlspecialchars($order['phone']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($order['delivery_address']); ?></td>
                                    <td>
                                        <div class="cart-item">
                                            <?php
                                            $cart_items = json_decode($order['cart'], true);
                                            if (json_last_error() === JSON_ERROR_NONE && is_array($cart_items)) {
                                                foreach ($cart_items as $item) {
                                                    $size = isset($item['size']) && !empty($item['size']) ? htmlspecialchars($item['size']) : 'Размер не был указан';
                                                    echo '<div>';
                                                    echo '<img src="../image/' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '">';
                                                    echo '<p>' . htmlspecialchars($item['name']) . ' - ' . htmlspecialchars($item['price']) . '₽<br>Размер: ' . $size . '</p>';
                                                    echo '</div>';
                                                }
                                            } else {
                                                echo 'Ошибка в данных корзины';
                                            }
                                            ?>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($order['order_details']); ?></td>
                                    <td>
                                        <input type="checkbox" class="form-check-input order-checkbox" data-order-id="<?php echo $order['id']; ?>" <?php echo $order['completed'] ? 'checked' : ''; ?>>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
