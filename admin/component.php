<?php
// Подключение к базе данных
include '../carousel_bd.php';

// Получение данных для обложек
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

// Получение данных для карусели товаров
$sql = "SELECT * FROM carouseproduct";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $promoItems = [];
    while ($row = $result->fetch_assoc()) {
        $promoItems[] = $row;
    }
} else {
    $promoItems = [];
}

// Получение данных для промо секции
$sql = "SELECT * FROM promosection";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $promoSectionItems = [];
    while ($row = $result->fetch_assoc()) {
        $promoSectionItems[] = $row;
    }
} else {
    $promoSectionItems = [];
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
            background-color: rgb(131, 166, 224);
            color: #fff;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
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
                                        <li><a class="dropdown-item" href="#promoSection">Карусель товаров</a></li>
                                        <li><a class="dropdown-item" href="#promoSectionItems">Промо товары</a></li>
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
                            <table class="table table-dark table-bordered table-hover mt-3">
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
                                            <?php if (isset($item['video']) && !empty($item['video'])): ?>
                                                <video width="100" controls>
                                                    <source src="../image/<?= htmlspecialchars($item['video']) ?>" type="video/mp4">
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
                                                    data-video="<?= htmlspecialchars($item['video']) ?>">Изменить</button>
                                        </td>
                                        <td>
                                            <button class="btn btn-delete btn-sm" onclick="deleteItem(<?= $item['id'] ?>)">Удалить</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- карусель товаров -->
                        <div id="promoSection" class="rounded-block">
                            <h3>Карусель товаров</h3>
                            <table class="table table-dark table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Название</th>
                                        <th>Описание</th>
                                        <th>Цена</th>
                                        <th>Картинка</th>
                                        <th>Изменить</th>
                                        <th>Удалить</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($promoItems as $item): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['name']) ?></td>
                                            <td><?= htmlspecialchars($item['description']) ?></td>
                                            <td><?= htmlspecialchars($item['price']) ?></td>
                                            <td>
                                                <?php if (isset($item['image']) && !empty($item['image'])): ?>
                                                    <img src="../<?= htmlspecialchars($item['image']) ?>" width="100" alt="Картинка">
                                                <?php else: ?>
                                                    Нет картинки
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editPromoModal" 
                                                        data-id="<?= $item['id'] ?>" 
                                                        data-name="<?= htmlspecialchars($item['name']) ?>" 
                                                        data-description="<?= htmlspecialchars($item['description']) ?>" 
                                                        data-price="<?= htmlspecialchars($item['price']) ?>" 
                                                        data-image="<?= htmlspecialchars($item['image']) ?>">Изменить</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-delete btn-sm" onclick="deletePromoItem(<?= $item['id'] ?>)">Удалить</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- Блок с таблицей промо товаров -->
                        <div id="promoSectionItems" class="rounded-block">
                            <h3>Промо товары</h3>
                            <table class="table table-dark table-bordered table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th>Скидка</th>
                                        <th>Категория</th>
                                        <th>Картинка</th>
                                        <th>Изменить</th>
                                        <th>Удалить</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($promoSectionItems as $item): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($item['discount']) ?></td>
                                            <td><?= htmlspecialchars($item['category']) ?></td>
                                            <td>
                                                <?php if (isset($item['image']) && !empty($item['image'])): ?>
                                                    <img src="../<?= htmlspecialchars($item['image']) ?>" width="100" alt="Картинка">
                                                <?php else: ?>
                                                    Нет картинки
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-edit btn-sm" data-bs-toggle="modal" data-bs-target="#editPromoSectionModal" 
                                                        data-id="<?= $item['id'] ?>" 
                                                        data-discount="<?= htmlspecialchars($item['discount']) ?>" 
                                                        data-category="<?= htmlspecialchars($item['category']) ?>" 
                                                        data-image="<?= htmlspecialchars($item['image']) ?>">Изменить</button>
                                            </td>
                                            <td>
                                                <button class="btn btn-delete btn-sm" onclick="deletePromoSectionItem(<?= $item['id'] ?>)">Удалить</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Каталог -->
                        <div id="catalogSection" class="rounded-block">
                            <h3>Каталог</h3>
                            <div class="table-responsive">
                                <table class="table table-dark table-bordered table-hover mt-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Описание</th>
                                            <th>Цена</th>
                                            <th>Картинки</th>
                                            <th>Размеры</th>
                                            <th>Категория</th>
                                            <th>Изменить</th>
                                            <th>Удалить</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include 'bd_products.php';
                                        $result = $conn->query("SELECT * FROM products2");
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$row['id']}</td>";
                                            echo "<td>{$row['name']}</td>";
                                            echo "<td>{$row['description']}</td>";
                                            echo "<td>{$row['price']}</td>";
                                            echo "<td>";
                                            if (!empty($row['images'])) {
                                                $images = json_decode($row['images'], true);
                                                foreach ($images as $image) {
                                                    echo "<img src='../image/{$image}' alt='Картинка' width='50' class='me-2'>";
                                                }
                                            } else {
                                                echo "Нет картинок";
                                            }
                                            echo "</td>";
                                            echo "<td>";
                                            if (!empty($row['sizes'])) {
                                                $sizes = json_decode($row['sizes'], true);
                                                foreach ($sizes as $size) {
                                                    echo "{$size['value']} ";
                                                }
                                            } else {
                                                echo "Нет размеров";
                                            }
                                            echo "</td>";
                                            echo "<td>{$row['category']}</td>";
                                            echo "<td><button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editProductModal' 
                                                    data-id='{$row['id']}'
                                                    data-name='{$row['name']}'
                                                    data-description='{$row['description']}'
                                                    data-price='{$row['price']}'
                                                    data-sizes='{$row['sizes']}'
                                                    data-category='{$row['category']}'
                                                    data-images='{$row['images']}'>Изменить</button></td>";
                                            echo "<td><button class='btn btn-danger btn-sm' onclick='deleteProduct({$row['id']})'>Удалить</button></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Добавить новый товар</button>
                        </div>

                        <!-- Модальное окно для редактирования товара -->
                        <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editProductModalLabel" style="color: black;">Редактировать товар</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form id="editProductForm" method="post" action="update_products2.php" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="id" id="editProductId">
                                            <div class="mb-3">
                                                <label for="editProductName" class="form-label" style="color: black;">Название</label>
                                                <input type="text" class="form-control" id="editProductName" name="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductDescription" class="form-label" style="color: black;">Описание</label>
                                                <textarea class="form-control" id="editProductDescription" name="description" rows="3" required></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductPrice" class="form-label" style="color: black;">Цена</label>
                                                <input type="number" class="form-control" id="editProductPrice" name="price" step="0.01" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductImages" class="form-label" style="color: black;">Картинки</label>
                                                <input type="file" class="form-control" id="editProductImages" name="images[]" multiple>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductSizes" class="form-label" style="color: black;">Размеры</label>
                                                <input type="text" class="form-control" id="editProductSizes" name="sizes" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="editProductCategory" class="form-label" style="color: black;">Категория</label>
                                                <select class="form-select" id="editProductCategory" name="category" required>
                                                    <option value="девочки">Девочки</option>
                                                    <option value="мальчики">Мальчики</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                <!-- Модальное окно для редактирования -->
                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel" style="color: black;">Редактировать запись</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editForm" method="post" action="update_carousel.php" enctype="multipart/form-data">
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
                                        <label for="editVideo" class="form-label" style="color: black;">Видео</label>
                                        <input type="file" class="form-control" id="editVideo" name="video">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Модальное окно для редактирования карусели товаров -->
                <div class="modal fade" id="editPromoModal" tabindex="-1" aria-labelledby="editPromoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPromoModalLabel" style="color: black;">Редактировать запись</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editPromoForm" method="post" action="update_promo.php" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="editPromoId">
                                    <div class="mb-3">
                                        <label for="editPromoName" class="form-label" style="color: black;">Название</label>
                                        <input type="text" class="form-control" id="editPromoName" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromoDescription" class="form-label" style="color: black;">Описание</label>
                                        <textarea class="form-control" id="editPromoDescription" name="description"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromoPrice" class="form-label" style="color: black;">Цена</label>
                                        <input type="text" class="form-control" id="editPromoPrice" name="price">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromoImage" class="form-label" style="color: black;">Картинка</label>
                                        <input type="file" class="form-control" id="editPromoImage" name="image">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Модальное окно для редактирования промо товаров -->
                <div class="modal fade" id="editPromoSectionModal" tabindex="-1" aria-labelledby="editPromoSectionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editPromoSectionModalLabel" style="color: black;">Редактировать запись</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="editPromoSectionForm" method="post" action="update_promo_section.php" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="id" id="editPromoSectionId">
                                    <div class="mb-3">
                                        <label for="editPromoSectionDiscount" class="form-label" style="color: black;">Скидка</label>
                                        <input type="text" class="form-control" id="editPromoSectionDiscount" name="discount">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromoSectionCategory" class="form-label" style="color: black;">Категория</label>
                                        <input type="text" class="form-control" id="editPromoSectionCategory" name="category">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editPromoSectionImage" class="form-label" style="color: black;">Картинка</label>
                                        <input type="file" class="form-control" id="editPromoSectionImage" name="image">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Модальное окно для добавления нового товара -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel" style="color: black;">Добавить новый товар</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addProductForm" method="post" action="add_product.php" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="productName" class="form-label" style="color: black;">Название</label>
                                        <input type="text" class="form-control" id="productName" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productDescription" class="form-label" style="color: black;">Описание</label>
                                        <textarea class="form-control" id="productDescription" name="description" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productPrice" class="form-label" style="color: black;">Цена</label>
                                        <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productImages" class="form-label" style="color: black;">Картинки</label>
                                        <input type="file" class="form-control" id="productImages" name="images[]" multiple>
                                    </div>
                                    <div class="mb-3">
                                        <label for="productSizes" class="form-label" style="color: black;">Размеры</label>
                                        <input type="text" class="form-control" id="productSizes" name="sizes">
                                    </div>
                                    <div class="mb-3">
                                        <label for="productCategory" class="form-label" style="color: black;">Категория</label>
                                        <select class="form-control" id="productCategory" name="category">
                                            <option value="девочки">Девочки</option>
                                            <option value="мальчики">Мальчики</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Добавить</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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

        const editPromoModal = document.getElementById('editPromoModal');
        editPromoModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const price = button.getAttribute('data-price');
            const image = button.getAttribute('data-image');

            document.getElementById('editPromoId').value = id;
            document.getElementById('editPromoName').value = name;
            document.getElementById('editPromoDescription').value = description;
            document.getElementById('editPromoPrice').value = price;
            document.getElementById('editPromoImage').value = image;
        });

        const editPromoSectionModal = document.getElementById('editPromoSectionModal');
        editPromoSectionModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const discount = button.getAttribute('data-discount');
            const category = button.getAttribute('data-category');
            const image = button.getAttribute('data-image');

            document.getElementById('editPromoSectionId').value = id;
            document.getElementById('editPromoSectionDiscount').value = discount;
            document.getElementById('editPromoSectionCategory').value = category;
            document.getElementById('editPromoSectionImage').value = image;
        });
        
            // Заполнение данных для редактирования
        const editProductModal = document.getElementById('editProductModal');
        editProductModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');
            const price = button.getAttribute('data-price');
            const sizes = button.getAttribute('data-sizes');
            const category = button.getAttribute('data-category');
            const images = button.getAttribute('data-images');

            document.getElementById('editProductId').value = id;
            document.getElementById('editProductName').value = name;
            document.getElementById('editProductDescription').value = description;
            document.getElementById('editProductPrice').value = price;
            document.getElementById('editProductSizes').value = sizes;
            document.getElementById('editProductCategory').value = category;
            document.getElementById('editProductImages').value = images;

        });


        function deleteItem(id) {
            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                window.location.href = `delete_promo.php?id=${id}`;
            }
        }

        function deletePromoItem(id) {
            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                window.location.href = `delete_promo.php?id=${id}`;
            }
        }

        function deletePromoSectionItem(id) {
            if (confirm('Вы уверены, что хотите удалить эту запись?')) {
                window.location.href = `delete_promo.php?id=${id}`;
            }
        }
        // Удаление товара
        function deleteProduct(id) {
            if (confirm('Вы уверены, что хотите удалить этот товар?')) {
                window.location.href = `delete_products.php?id=${id}`;
            }
        }

    </script>
</body>
</html>


<script>
    
</script>
