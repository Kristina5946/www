<?php
require_once 'bd_products.php'; // Подключение к базе данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    if (isset($_POST['completed'])) {
        $completed = $_POST['completed'] === 'true' ? 1 : 0;
        $query = "UPDATE feedback SET completed = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ii', $completed, $id);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['note'])) {
        $note = $_POST['note'];
        $query = "UPDATE feedback SET note = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('si', $note, $id);
        $stmt->execute();
        $stmt->close();
    }
}
?>