<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <!-- Подключение Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Иконки Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Боковая панель -->
            <?php require_once 'navbar.php'; ?>

            <!-- Основной контент -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Аналитика вашего сайта:</h1>
                </div>

                <div class="row">
                    <!-- Карточка 1 -->
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5 class="card-title">Доход</h5>
                            <p class="fs-4">4805р</p>
                            <small>+34 С прошлой недели</small>
                        </div>
                    </div>
                    <!-- Карточка 2 -->
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5 class="card-title">Всего клиентов</h5>
                            <p class="fs-4">8.4K</p>
                            <small>+12 С прошлой недели</small>
                        </div>
                    </div>
                    <!-- Карточка 3 -->
                    <div class="col-md-4 mb-3">
                        <div class="card p-3">
                            <h5 class="card-title">Новые заказы</h5>
                            <p class="fs-4">123</p>
                            <small>+15 С прошлой недели</small>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
