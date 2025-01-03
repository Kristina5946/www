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
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$question = $_POST['question'];


// Подготавливаем и выполняем SQL-запрос
$sql = "INSERT INTO feedback (name, phone, email, question) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $name, $phone, $email, $question);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Ваше сообщение успешно отправлено!']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>