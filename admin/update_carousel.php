<?php
include '../carousel_bd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $video_url = '';

    // Получаем текущее видео из базы данных
    $stmt = $conn->prepare("SELECT video FROM carouselExample WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($current_video);
    $stmt->fetch();
    $stmt->close();

    if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
        $video_tmp_path = $_FILES['video']['tmp_name'];
        $video_name = basename($_FILES['video']['name']);
        $video_upload_path = '../image/' . $video_name;

        if (move_uploaded_file($video_tmp_path, $video_upload_path)) {
            $video_url = 'image/' . $video_name;
        }
    } else {
        // Если новое видео не загружено, используем текущее видео
        $video_url = $current_video;
    }

    $stmt = $conn->prepare("UPDATE carouselExample SET title = ?, description = ?, video = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $video_url, $id);
    $stmt->execute();
    $stmt->close();

    header('Location: component.php');
    exit;
}
?>