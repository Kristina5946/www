<?php
require_once '../carousel_bd.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $text = $_POST['text'];

    $query = "UPDATE footer SET text = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $text, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: component.php?status=updated');
    exit;
}
?>