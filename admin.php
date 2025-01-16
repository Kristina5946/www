<?php
session_start();
require_once 'ad_bd.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $sql = $conn->prepare("SELECT id, login FROM user WHERE login = :login AND password = :password");
    $sql->bindParam(':login', $login);
    $sql->bindParam(':password', $password);
    $sql->execute();
    $array = $sql->fetch(PDO::FETCH_ASSOC);

    if ($array && $array["id"] > 0) {
        $_SESSION['login'] = $array["login"];
        header('Location: admin/admin_panel.php'); // Переход в админку
        exit();
    } else {
        header('Location: login.php'); // Возврат на страницу входа
        exit();
    }
}
?>

