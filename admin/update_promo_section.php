<?php
include '../carousel_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $discount = $_POST['discount'];
    $category = $_POST['category'];
    $image_url = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_path = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_upload_path = '../uploads/' . $image_name;

        if (move_uploaded_file($image_tmp_path, $image_upload_path)) {
            $image_url = 'uploads/' . $image_name;
        }
    } else {
        // Если картинка не загружена, оставляем старое значение
        $stmt = $conn->prepare("SELECT image FROM promosection WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($image_url);
        $stmt->fetch();
        $stmt->close();
    }

    $stmt = $conn->prepare("UPDATE promosection SET discount = ?, category = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $discount, $category, $image_url, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: component.php');
    exit;
}
?>