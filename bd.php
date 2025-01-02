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


    // Запрос к таблице товаров
    $sql = "SELECT * FROM products2";
    $result = $conn->query($sql);

    $products = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images = json_decode($row['images'], true);
            $sizes = json_decode($row['sizes'], true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                $images = []; // Задаем пустой массив, если JSON некорректен
                $sizes = [];
            }

            $products[] = [
                'name' => $row['name'],
                'price' => (float)$row['price'],
                'description' => $row['description'],
                'images' => $images,
                'sizes' => $sizes,
            ];
        }

    }
    // Возвращаем данные в формате JSON
    header('Content-Type: application/json');
    echo json_encode($products, JSON_UNESCAPED_UNICODE);

    // Закрываем соединение
    $conn->close();
?>

