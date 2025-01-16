<?php
include 'bd_products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $sizes = $_POST['sizes'];
    $category = $_POST['category'];
    $images = [];

    if (isset($_FILES['images']) && $_FILES['images']['error'][0] === UPLOAD_ERR_OK) {
        foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
            $image_name = basename($_FILES['images']['name'][$key]);
            $image_upload_path = '../image/' . $image_name;
            if (!file_exists($image_upload_path)) {
                if (move_uploaded_file($tmp_name, $image_upload_path)) {
                    $images[] = $image_name;
                }
            } else {
                $images[] = $image_name;
            }
        }
    } else {
        // Если картинки не загружены, оставляем старое значение
        $stmt = $conn->prepare("SELECT images FROM products2 WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($images_json);
        $stmt->fetch();
        $stmt->close();
        $images = json_decode($images_json, true);
    }

    $images_json = json_encode($images);

    $stmt = $conn->prepare("UPDATE products2 SET name = ?, description = ?, price = ?, images = ?, sizes = ?, category = ? WHERE id = ?");
    $stmt->bind_param("ssdsssi", $name, $description, $price, $images_json, $sizes, $category, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: component.php?status=updated');
    exit;
}
?>