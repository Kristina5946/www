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
}  else {
    echo "Нет данных для отображения.";
    exit;
}
?>
<div class="row">
    <!-- Карточка 1 -->
    <div class="col-md-4 mb-3">
        <div class="card p-3">
            <h5 class="card-title">Доход</h5>
            <p class="fs-4"><?php echo number_format($total_income, 2, ',', ' '); ?>₽</p>
            <small>+34 С прошлой недели</small>
        </div>
    </div>
    <!-- Карточка 2 -->
    <div class="col-md-4 mb-3">
        <div class="card p-3">
            <h5 class="card-title">Всего клиентов</h5>
            <p class="fs-4">8.4K</p>
            <small>+12 С прошлой недели</small>
        </div>
    </div>
    <!-- Карточка 3 -->
    <div class="col-md-4 mb-3">
        <div class="card p-3">
            <h5 class="card-title">Новые заказы</h5>
            <p class="fs-4">
            <?php
            $max_order_id = 0;
            $sql_max_id = "SELECT MAX(id) as max_id FROM making_an_order";
            $result_max_id = $conn->query($sql_max_id);

            if ($result_max_id->num_rows > 0) {
                $row_max_id = $result_max_id->fetch_assoc();
                $max_order_id = $row_max_id['max_id'];
            }
            echo $max_order_id;
            ?></p>
            <small>+15 С прошлой недели</small>
        </div>
    </div>
</div>