<?php
session_start();
// Проверка времени последней активности
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    // Если прошло более 10 минут (600 секунд) с момента последней активности
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>
<?php
require_once 'connect_bd.php'; // Подключение к базе данных

// Обработка изменения состояния выполнения заказа
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['order_id']) && isset($_POST['completed'])) {
        $order_id = $_POST['order_id'];
        $completed = $_POST['completed'];

        $stmt = $conn->prepare("UPDATE making_an_order SET completed = ? WHERE id = ?");
        $stmt->bind_param("ii", $completed, $order_id);
        $stmt->execute();
        $stmt->close();
        exit;
    }

    if (isset($_POST['delete_order_id'])) {
        $order_id = $_POST['delete_order_id'];

        $stmt = $conn->prepare("DELETE FROM making_an_order WHERE id = ?");
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $stmt->close();
        exit;
    }

    if (isset($_POST['clear_db'])) {
        $stmt = $conn->prepare("DELETE FROM making_an_order");
        $stmt->execute();
        $stmt->close();
        exit;
    }
}

$sql = "SELECT * FROM making_an_order ORDER BY completed ASC, id DESC";
$result = $conn->query($sql);

$orders = [];
$total_income = 0;
$product_totals = []; // Массив для хранения сумм по каждому товару

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
        $cart_items = json_decode($row['cart'], true);
        
        if (json_last_error() === JSON_ERROR_NONE && is_array($cart_items)) {
            foreach ($cart_items as $item) {
                $product_name = $item['name'];
                $item_total = $item['price'] * $item['quantity'];
                
                // Если товар уже есть в массиве, добавляем к его сумме
                if (isset($product_totals[$product_name])) {
                    $product_totals[$product_name] += $item_total;
                } else {
                    // Если товара еще нет, инициализируем его сумму
                    $product_totals[$product_name] = $item_total;
                }
            }
        }
    }
    // Теперь суммируем все значения в $product_totals для получения общего дохода
    $total_income = array_sum($product_totals);
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
        .table-responsive {
            background: rgba(58, 49, 83, 0.72);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow-x: auto; /* Добавлено для горизонтального скролла */
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

            // Обработчик для кнопок удаления заказа
            const deleteButtons = document.querySelectorAll('.delete-order-button');
            let orderIdToDelete;
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    orderIdToDelete = this.dataset.orderId;
                    const deleteOrderModal = new bootstrap.Modal(document.getElementById('confirmDeleteOrderModal'));
                    deleteOrderModal.show();
                });
            });

            document.getElementById('confirmDeleteOrderButton').addEventListener('click', function() {
                fetch('', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `delete_order_id=${orderIdToDelete}`
                }).then(() => {
                    location.reload();
                });
            });

            // Обработчик для кнопки очистки БД
            document.getElementById('clearDbButton').addEventListener('click', function() {
                const clearDbModal = new bootstrap.Modal(document.getElementById('confirmClearDbModal'));
                clearDbModal.show();
            });

            document.getElementById('confirmClearDbButton').addEventListener('click', function() {
                fetch('', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'clear_db=1'
                }).then(() => {
                    location.reload();
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
                <div class="table-responsive ">
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
                                <th>Удалить</th>
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
                                                    $quantity = isset($item['quantity']) ? (int)$item['quantity'] : 1;
                                                    echo '<div>';
                                                    echo '<img src="../' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '">';
                                                    echo '<p>' . htmlspecialchars($item['name']) . ' - ' . htmlspecialchars($item['price']) . '₽<br>Размер: ' . $size . '<br>Количество: ' . $quantity . '</p>';
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
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-order-button" data-order-id="<?php echo $order['id']; ?>">Удалить</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button id="clearDbButton" class="btn btn-danger mt-3">Очистить БД</button>
                </main>
        </div>
    </div>
    
    <!-- Модальное окно для подтверждения удаления заказа -->
    <div class="modal fade" id="confirmDeleteOrderModal" tabindex="-1" aria-labelledby="confirmDeleteOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteOrderModalLabel" style="color: black;">Подтверждение удаления</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;">
                    Вы уверены, что хотите удалить этот заказ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteOrderButton">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Модальное окно для подтверждения очистки базы данных -->
    <div class="modal fade" id="confirmClearDbModal" tabindex="-1" aria-labelledby="confirmClearDbModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmClearDbModalLabel" style="color: black;">Подтверждение очистки базы данных</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="color: black;">
                    Вы уверены, что хотите очистить базу данных?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger" id="confirmClearDbButton">Очистить</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
