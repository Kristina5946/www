<?php
include 'carousel_bd.php'; // Подключение к базе данных

$sql = "SELECT * FROM carouseproduct";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
} else {
    echo "Нет данных для отображения.";
    exit;
}

$conn->close();
?>
<div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach (array_chunk($products, 3) as $index => $productChunk): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <div class="product-cards d-flex justify-content-center">
                        <?php foreach ($productChunk as $product): ?>
                            <div class="product-card">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>" class="product-card-img" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                <div class="product-card-body">
                                    <h5 class="product-card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="product-card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p class="product-card-price">Цена: <?php echo htmlspecialchars($product['price']); ?></p>
                                    <a href="catalog.php" class="btn btn-primary">Посмотреть</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
</div>