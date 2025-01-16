<?php
include 'bd_products.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    }

    $images_json = json_encode($images);

    $stmt = $conn->prepare("INSERT INTO products2 (name, description, price, images, sizes, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $name, $description, $price, $images_json, $sizes, $category);
    $stmt->execute();
    $stmt->close();

    header('Location: component.php?status=success');
    exit;
}
?>