<?php
$host = 'localhost';
$user = 'root';
$password = 'mysql';
$database = 'index_bd';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>