<?php
require_once '../carousel_bd.php'; // Подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение значений из формы
    $login = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Хеширование пароля
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    // Вывод хешированного пароля для отладки
    echo "Хешированный пароль: " . $hashed_password . "<br>";

    // Запрос на обновление данных пользователя
    $query = "UPDATE user SET login = ?, password = ? WHERE id = ?"; 
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $user_id = 1;
        $stmt->bind_param("ssi", $login, $hashed_password, $user_id);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo "Данные успешно обновлены!";
        } else {
            echo "Не удалось обновить данные. Проверьте, что данные не изменились.";
        }
        $stmt->close();
    } else {
        echo "Ошибка в запросе: " . $conn->error;
    }
    
    $conn->close(); // Закрытие соединения
}
?>