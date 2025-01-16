<?php
include 'carousel_bd.php'; // Подключение к базе данных

$sql = "SELECT * FROM promosection";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $promotions = [];
    while ($row = $result->fetch_assoc()) {
        $promotions[] = $row;
    }
} else {
    echo "Нет данных для отображения.";
    exit;
}

$conn->close();
?>

<div class="container">
  <div class="row">
    <?php foreach ($promotions as $index => $promo): ?>
      <?php if ($index === 0): ?>
        <!-- Большой блок промо -->
        <div class="col-md-5 no-padding">
          <div class="aa-promo-left">
            <div class="aa-promo-banner">
              <img src="<?php echo htmlspecialchars($promo['image']); ?>" alt="img">
              <div class="aa-prom-content">
                <span><?php echo htmlspecialchars($promo['discount']); ?></span>
                <h4><a href="#"><?php echo htmlspecialchars($promo['category']); ?></a></h4>
              </div>
            </div>
          </div>
        </div>
      <?php else: ?>
        <!-- Маленькие блоки промо -->
        <?php if ($index === 1): ?>
          <div class="col-md-7 no-padding">
            <div class="row">
        <?php endif; ?>
              <div class="col-sm-6">
                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="<?php echo htmlspecialchars($promo['image']); ?>" alt="img">
                    <div class="aa-prom-content">
                      <span><?php echo htmlspecialchars($promo['discount']); ?></span>
                      <h4><a href="#"><?php echo htmlspecialchars($promo['category']); ?></a></h4>
                    </div>
                  </div>
                </div>
              </div>
        <?php if ($index === count($promotions) - 1): ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
</div>