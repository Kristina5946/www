<?php
$host = 'localhost';
$user = 'root';
$password = 'mysql';
$database = 'shop_database';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>