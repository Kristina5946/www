<?php
// Подключение к базе данных
include '../carousel_bd.php';

$sql = "SELECT * FROM carouselExample";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $carouselItems = [];
    while ($row = $result->fetch_assoc()) {
        $carouselItems[] = $row;
    }
} else {
    $carouselItems = [];
}

$conn->close();
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
            <!-- Навигационная панель -->
           
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Изменить контент на сайте:</h1>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">ProSport</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <!-- Выпадающее меню для секции "Главная" -->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="mainDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Главная
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="mainDropdown">
                                        <li><a class="dropdown-item" href="#carouselSection">Обложки</a></li>
                                        <li><a class="dropdown-item" href="#promoSection">Промо товары</a></li>
                                        <li><a class="dropdown-item" href="#footerSection">Футер</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#catalogSection">Каталог</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#contactsSection">Контакты</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <div class="container-fluid">
                    <style>
                        body {
                            background-color: #2a2a3c;
                            color: #fff;
                        }
                        .main-content {
                            padding: 20px;
                        }
                        .rounded-block {
                            background-color: #383b50;
                            border-radius: 10px;
                            padding: 20px;
                            margin-top: 20px;
                        }
                        .table thead th {
                            color: #fff;
                        }
                        .table tbody td {
                            color: #c7c7d0;
                        }
                        .btn-edit {
                            background-color:rgb(131, 166, 224);
                            color: #fff;
                        }
                        .btn-delete {
                            background-color: #dc3545;
                            color: #fff;
                        }
                    </style>
                    
                        <!-- Блок с таблицей -->
                        <div id="carouselSection" class="rounded-block">
                            <h3>Обложки</h3>
                            <table class="table table-dark table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Видео</th>
                                        <th>Изменить</th>
                                        <th>Удалить</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($carouselItems as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['title']) ?></td>
                                        <td><?= htmlspecialchars($item['description']) ?></td>
                                        <td>
                                            <?php if (isset($item['video_url']) && !empty($item['video_url'])): ?>
                                                <video width="100" controls>
                                                    <source src="../<?= htmlspecialchars($item['video_url']) ?>" type="video/mp4">
                                                    Ваш браузер не поддерживает видео.
                                                </video>
                                            <?php else: ?>
                                                Нет видео
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" 
                                                    data-id="<?= $item['id'] ?>" 
                                                    data-title="<?= htmlspecialchars($item['title']) ?>" 
                                                    data-description="<?= htmlspecialchars($item['description']) ?>" 
                                                    data-video="../<?= htmlspecialchars($item['video_url']) ?>">Изменить</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-delete btn-sm" onclick="deleteItem(<?= $item['id'] ?>)">Удалить</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <button class="btn btn-secondary mt-3">Отключить блок</button>
                        </div>
                        <!-- Промо товары -->
                        <div id="promoSection" class="rounded-block">
                            <h3>Промо товары</h3>
                            <p>Контент для раздела "Промо товары".</p>
                        </div>

                        <!-- Футер -->
                        <div id="footerSection" class="rounded-block">
                            <h3>Футер</h3>
                            <p>Контент для футера.</p>
                        </div>

                        <!-- Каталог -->
                        <div id="catalogSection" class="rounded-block">
                            <h3>Каталог</h3>
                            <p>Контент для каталога.</p>
                        </div>

                        <!-- Контакты -->
                        <div id="contactsSection" class="rounded-block">
                            <h3>Контакты</h3>
                            <p>Контент для контактов.</p>
                        </div>
                    </div>
                    </main>
                </div>
                
                <!-- Модальное окно для редактирования -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel" style="color: black;">Редактировать запись</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editForm" method="post" action="../carousel_bd.php">
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="editId">
                                    <div class="mb-3">
                                        <label for="editTitle" class="form-label" style="color: black;">Название</label>
                                        <input type="text" class="form-control" id="editTitle" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editDescription" class="form-label" style="color: black;">Описание</label>
                                        <textarea class="form-control" id="editDescription" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editVideo" class="form-label" style="color: black;">Видео URL</label>
                                        <input type="text" class="form-control" id="editVideo" name="video_url">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        const editModal = document.getElementById('editModal');
                        editModal.addEventListener('show.bs.modal', event => {
                            const button = event.relatedTarget;
                            const id = button.getAttribute('data-id');
                            const title = button.getAttribute('data-title');
                            const description = button.getAttribute('data-description');
                            const video = button.getAttribute('data-video');

                            document.getElementById('editId').value = id;
                            document.getElementById('editTitle').value = title;
                            document.getElementById('editDescription').value = description;
                            document.getElementById('editVideo').value = video;
                        });

                        function deleteItem(id) {
                            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                                window.location.href = `delete_carousel.php?id=${id}`;
                            }
                        }
                        
                          
                    </script>
                </div>
        </div>
    </div>

    
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
