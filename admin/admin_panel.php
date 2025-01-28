<?php
session_start();
// Проверка времени последней активности
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    // Если прошло более 10 минут (600 секунд) с момента последней активности
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>
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
                    <h1 class="h2">Добро пожаловать в Админ-панель!</h1>
                </div>

                <?php require_once 'anal.php'; ?>
                <style>
                    .screenshot-container {
                        display: flex;
                        justify-content: center;
                        border-radius: 15px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.22);
                        overflow: hidden;
                        margin-top: 20px;
                    }
                    .screenshot-container img {
                        width: 100%;
                        transition: transform 0.5s ease-in-out;
                    }
                    .screenshot-container:hover img {
                        transform: scale(1.06);
                    }
                    .overlay {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        background-color: rgba(11, 11, 29, 0.86); /* Темно-синий с прозрачностью */
                        transition: opacity 0.5s ease-in-out;
                        opacity: 1;
                    }
                   
                </style>

                <div class="screenshot-container">
                    <img src="../image/Измени возможности сайта.png" alt="Скриншот сайта">
                    <div class="overlay"></div>
                </div>
            </main>
        </div>
    </div>   
    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
