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
            <h5 class="card-title">Общая сумма с заказов</h5>
            <p class="fs-4"><?php echo number_format($total_income, 2, ',', ' '); ?>₽</p>
            <?php
            $completed_income = 0;
            $sql_completed = "SELECT cart FROM making_an_order WHERE completed = 1";
            $result_completed = $conn->query($sql_completed);

            if ($result_completed->num_rows > 0) {
                while ($row_completed = $result_completed->fetch_assoc()) {
                    $cart_items = json_decode($row_completed['cart'], true);
                    
                    if (json_last_error() === JSON_ERROR_NONE && is_array($cart_items)) {
                        foreach ($cart_items as $item) {
                            $completed_income += $item['price'] * $item['quantity'];
                        }
                    }
                }
            }
            ?>
            <p class="fs-6">Сумма с выполненных заказов: <?php echo number_format($completed_income, 2, ',', ' '); ?>₽</p>
        </div>
    </div>
    <!-- Карточка 2 -->
    <div class="col-md-4 mb-3">
        <div class="card p-3">
            <h5 class="card-title">Количество товаров, размещенных в каталоге</h5>
            <p class="fs-4">
            <?php
            $max_order_id = 0;
            $sql_max_id = "SELECT MAX(id) as max_id FROM products2";
            $result_max_id = $conn->query($sql_max_id);

            if ($result_max_id->num_rows > 0) {
                $row_max_id = $result_max_id->fetch_assoc();
                $max_order_id = $row_max_id['max_id'];
            }
            echo $max_order_id;
            ?></p>
            <br>
        </div>
    </div>
    <!-- Карточка 3 -->
    <div class="col-md-4 mb-3">
        <div class="card p-3">
            <h5 class="card-title">Всего заказов</h5>
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
            <p class="fs-6">
            <?php
            $sql_completed_count = "SELECT COUNT(*) as completed_count FROM making_an_order WHERE completed = 1";
            $result_completed_count = $conn->query($sql_completed_count);

            if ($result_completed_count->num_rows > 0) {
                $row_completed_count = $result_completed_count->fetch_assoc();
                echo "Количество выполненных заказов: " . $row_completed_count['completed_count'];
            }
            ?>
            </p>
        </div>
    </div>
</div>