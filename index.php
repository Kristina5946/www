<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROспорт34</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Подключаем  CSS -->
</head>
<body>
    <header>
        <?php include 'navbar.php'; ?>
    </header>
    <?php include 'carouselExample.php'; ?>
    <?php include 'carouseProduct.php'; ?>
    <!-- Ссылка на каталог -->
    <div class="catalog-link">
        <a href="catalog.php" class="btn btn-secondary">Перейти в каталог</a>
    </div>

    <section id="aa-promo">
        <?php include 'promosection.php'; ?>
    </section>

        <!-- Секция "Почему именно мы?" -->
    <section class="background-section">
        <?php include 'sectionbecause.php'; ?>
    </section>

    <!-- Форма поддержки -->
    <?php include 'connection.php'; ?>

    <!-- Нижняя часть страницы (подвал) -->
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
