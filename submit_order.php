<?php
$host = 'localhost'; // Адрес сервера
$user = 'root'; // Пользователь
$password = 'mysql'; // Пароль (по умолчанию пустой)
$database = 'shop_database'; // Имя вашей базы данных

// Подключение
$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    http_response_code(500);
    die(json_encode(['error' => 'Ошибка подключения к базе данных']));
}

// Получаем данные из POST-запроса
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$delivery_address = $_POST['delivery_address'];
$cart = $_POST['cart'];
$order_details = $_POST['order_details'];

// Подготавливаем и выполняем SQL-запрос
$sql = "INSERT INTO making_an_order (last_name, first_name, middle_name, phone, email, delivery_address, cart, order_details) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $last_name, $first_name, $middle_name, $phone, $email, $delivery_address, $cart, $order_details);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Заказ успешно оформлен!']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>