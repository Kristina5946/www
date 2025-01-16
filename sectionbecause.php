<?php
include 'carousel_bd.php'; // Подключение к базе данных

$sql = "SELECT * FROM sectionbecause";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $section = $result->fetch_assoc();
} else {
    echo "Нет данных для отображения.";
    exit;
}

$conn->close();
?>

<div class="text-container">
    <h4 class="section-title"><?php echo nl2br(htmlspecialchars($section['text'])); ?></h4>
</div>
<div class="additional-text-container">
    <p class="additional-text"><?php echo htmlspecialchars($section['conclusion']); ?></p>
</div>