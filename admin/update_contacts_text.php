<?php
include '../carousel_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $text = $_POST['text'];

    $stmt = $conn->prepare("UPDATE contacts_text SET text = ? WHERE id = ?");
    $stmt->bind_param("si", $text, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: contacts_text.php?status=success');
    exit;
}
?>