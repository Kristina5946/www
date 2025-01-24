<?php
include 'carousel_bd.php'; // Подключение к базе данных

$sql = "SELECT * FROM carouselExample";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $carouselItems = [];
    while ($row = $result->fetch_assoc()) {
        $carouselItems[] = $row;
    }
} else {
    echo "Нет данных для отображения.";
    exit;
}

$conn->close();
?>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
    
        <?php foreach ($carouselItems as $index => $item): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <div class="bg-video-container">
                    <div class="bg-image<?php echo $index + 1; ?>"></div>
                    <div class="content text-center text-white">
                        <h1 class="animate-text1"><?php echo htmlspecialchars($item['title']); ?></h1>
                        <p class="animate-text2"><?php echo htmlspecialchars($item['description']); ?></p>
                    </div>
                    <div class="video-container">
                        <video playsinline autoplay loop muted class="bg-video d-block w-100">
                            <source src="<?php echo htmlspecialchars($item['video']); ?>" type="video/mp4">
                            Ваш браузер не поддерживает видео.
                        </video>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
    </a>
</div>