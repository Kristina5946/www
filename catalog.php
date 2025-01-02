<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROспорт34</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Подключаем ваш CSS -->
</head>
<body>
    <header>
        
        <nav class="navbar navbar-expand-lg" style="background-color: #F3ECF8;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="logo.png" alt="Логотип" class="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Переключатель навигации">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="catalog.php">Каталог</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contacts.php">Контакты</a>
                        </li>
                        <li class="nav-item">
                            <form class="d-flex search-form" role="search" onsubmit="return searchProducts(event)">
                                <input class="form-control me-2 search-input" type="search" placeholder="Поиск" aria-label="Поиск">
                                <button class="btn custom-btn" type="submit">
                                    <img src="поисковик.png" alt="Поиск" class="icon">
                                </button>
                            </form>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-cart" data-bs-toggle="modal" data-bs-target="#cart-modal">
                                <img src="корзина.png" alt="Корзина" class="icon">
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        
        <div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cartModalLabel">Корзина</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <p>Корзина пуста. Добавьте товары для оформления заказа.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" id="checkoutButton" class="btn btn-primary">Оформить заказ</button>
                        <!-- Модальное окно для оформления заказа -->
                        <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="orderModalLabel">Оформление заказа</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="mb-3">
                                  <label for="surname" class="form-label">Фамилия</label>
                                  <input type="text" class="form-control" id="surname" required>
                                </div>
                                <div class="mb-3">
                                  <label for="name" class="form-label">Имя</label>
                                  <input type="text" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                  <label for="patronymic" class="form-label">Отчество</label>
                                  <input type="text" class="form-control" id="patronymic" required>
                                </div>
                                <div class="mb-3">
                                  <label for="phone" class="form-label">Телефон</label>
                                  <input type="tel" class="form-control" id="phone" required>
                                </div>
                                <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" required>
                                </div>
                                <div class="mb-3">
                                  <label for="deliveryAddress" class="form-label">Адрес доставки</label>
                                  <select class="form-select" id="deliveryAddress">
                                    <option selected disabled>Выберите адрес</option>
                                    <option>Адрес 1</option>
                                    <option>Адрес 2</option>
                                    <!-- Добавьте другие адреса -->
                                  </select>
                                </div>
                                <div class="mb-3">
                                  <label>Проверка корзины товаров</label>
                                  <ul id="orderItemsList"></ul> <!-- Список добавленных товаров -->
                                </div>
                                <div class="mb-3">
                                  <label for="details" class="form-label">Укажите размер, цвет и детали заказа</label>
                                  <textarea class="form-control" id="details"></textarea>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-primary" id="submitOrder">Оформить заказ</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Обложка -->
    <div class="cover">
      <div class="cover-content text-center">
        <h1>Товары для <span id="category-name">гимнастики</span></h1>
        <script src="script.js"></script>
      </div>
    </div>
    <!-- Заголовок -->
    <div class="container mt-4">
      <h1 class="text-center">Каталог товаров</h1>
      <form class="search-form d-flex justify-content-center mb-4">
        <input type="text" class="form-control me-2 search-input" placeholder="Поиск..." aria-label="Поиск">
        <button type="submit" class="btn btn-outline-secondary">Найти</button>
      </form>
      <div class="d-flex justify-content-center mb-4">
        <button class="btn btn-primary me-2" onclick="showGirlsCatalog()">Девочки</button>
        <button class="btn btn-primary" onclick="showBoysCatalog()">Мальчики</button>
      </div>
      
      <!-- Сетка товаров -->
      <div class="container my-5">
        <div id="catalog" class="row row-cols-1 row-cols-md-5 g-4">
          <!-- Товары будут загружаться сюда через JavaScript -->
        </div>
      </div>
    </div>  

    <!-- Модальное окно -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="productModalLabel">Название товара</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <div id="productImagesCarousel" class="carousel slide" data-bs-ride="false">
              <div class="carousel-inner" id="productImages"></div>
              <button class="carousel-control-prev" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Предыдущий</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#productImagesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Следующий</span>
              </button>
            </div>
            <div id="sizeOptions" class="mt-3">
              <h6>Выберите размер:</h6>
              <div id="sizeButtons" class="d-flex justify-content-start"></div>
            </div>
            <p id="productDescription">Подробное описание товара...</p>
            <p class="fw-bold">Цена: <span id="productPrice">1500₽</span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Нижняя часть страницы (подвал) -->
    <div class="footer">
        © 2024 PROспорт34 | Тел: +7(988) 005-49-18 | <a href="https://vk.com/pro_sport_34">ВКонтакте</a>
    </div>


    
    <!-- Добавление иконки ватсапа для свзи изменить номер!!!!! -->
    <a href="https://wa.me/89061727947" class="whatsapp-icon" target="_blank">
        <img src="whatsapp-icon.png" alt="WhatsApp" />
    </a>

    <style>
        .whatsapp-icon {
            position: fixed;
            bottom: 20px;
            left: 20px;
            z-index: 1000;
        }

        .whatsapp-icon img {
            width: 60px; /* Настройте размер иконки */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
