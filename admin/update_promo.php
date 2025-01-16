<?php
include '../carousel_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_path = $_FILES['image']['tmp_name'];
        $image_name = basename($_FILES['image']['name']);
        $image_upload_path = '../image/' . $image_name;

        if (move_uploaded_file($image_tmp_path, $image_upload_path)) {
            $image_url = 'image/' . $image_name;
        }
    } else {
        // Если картинка не загружена, оставляем старое значение
        $stmt = $conn->prepare("SELECT image FROM carouseproduct WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($image_url);
        $stmt->fetch();
        $stmt->close();
    }

    $stmt = $conn->prepare("UPDATE carouseproduct SET name = ?, description = ?, price = ?, image = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $description, $price, $image_url, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: component.php');
    exit;
}
?>