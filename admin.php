<?php
session_start();
require_once 'ad_bd.php'; // Подключение к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        // Получение значений из формы
        $login = trim($_POST['login']);
        $password = trim($_POST['password']);

        // Запрос на получение данных пользователя
        $query = "SELECT id, login, password FROM user WHERE login = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->execute([$login]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Проверка пароля
                if (password_verify($password, $user['password'])) {
                    $_SESSION['login'] = $user["login"];
                    header('Location: admin/admin_panel.php'); // Переход в админку
                    exit();
                } else {
                    header('Location: login.php'); // Возврат на страницу входа
                    exit();
                }
            } else {
                header('Location: login.php');
                echo "Пользователь не найден."; // Возврат на страницу входа
                exit();
                
            }
        } else {
            header('Location: login.php'); // Возврат на страницу входа
            echo "Ошибка в запросе: " . $conn->errorInfo()[2];
            exit();
        }
    } else {
        
        header('Location: login.php'); // Возврат на страницу входа
        echo "Пожалуйста, заполните все поля.";
        exit();
    }

    $conn = null; // Закрытие соединения
}
?>