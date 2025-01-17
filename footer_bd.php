
<?php

include 'carousel_bd.php'; // Подключение к базе данных

$sql = "SELECT * FROM footer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $section = $result->fetch_assoc();
} else {
    echo "Нет данных для отображения.";
    exit;
}

$conn->close();
?>
