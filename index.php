
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
                            <form class="d-flex search-form" role="search">
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
                                  <div class="invalid-feedback">
                                    Пожалуйста, заполните поле Фамилии.
                                    </div>
                                </div>
                                <div class="mb-3">
                                  <label for="name" class="form-label">Имя</label>
                                  <input type="text" class="form-control" id="name" required>
                                  <div class="invalid-feedback">
                                    Пожалуйста, заполните поле имени.
                                </div>
                                </div>
                                <div class="mb-3">
                                  <label for="patronymic" class="form-label">Отчество</label>
                                  <input type="text" class="form-control" id="patronymic" required>
                                </div>
                                <div class="mb-3">
                                  <label for="phone" class="form-label">Телефон</label>
                                  <input type="tel" class="form-control" id="phone" required>
                                  <div class="invalid-feedback">
                                    Пожалуйста, заполните поле телефона.
                                </div>
                                </div>
                                <div class="mb-3">
                                  <label for="email" class="form-label">Email</label>
                                  <input type="email" class="form-control" id="email" required>
                                  <div class="invalid-feedback">
                                    Пожалуйста, введите действительный адрес электронной почты.
                                </div>
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
    
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
        
            <div class="carousel-item active">
                <div class="bg-video-container">
                    <div class="bg-image1"></div>
                    <div class="content text-center text-white">
                        <h1 class="animate-text1">Товары для гимнастики</h1>
                        <p class="animate-text2">Добро пожаловать в наш магазин, специализирующуюся на продаже спортивных товаров и одежды для детей! Мы предлагаем широкий ассортимент качественных купальников, аксессуаров и спортивного инвентаря, чтобы поддержать активный образ жизни ваших детей.</p>
                    </div>
                    <div class="video-container">
                        <video playsinline autoplay loop muted class="bg-video d-block w-100">
                            <source src="Видео Детская спортивная одежда.mp4" type="video/mp4">
                            Ваш браузер не поддерживает видео.
                        </video>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="bg-video-container">
                    <div class="bg-image2"></div>
                    <div class="content text-center text-white">
                        <h1 class="animate-text1">Всё для единоборства</h1>
                        <p class="animate-text2">Ищете надежное и удобное решение для тренировок в единоборствах для вашего ребенка? Наша коллекция одежды для единоборств идеально подходит для юных спортсменов, стремящихся развивать свои навыки.</p>
                    </div>
                    <div class="video-container">
                        <video playsinline autoplay loop muted class="bg-video d-block w-100">
                            <source src="видео для бокса.mp4" type="video/mp4">
                            Ваш браузер не поддерживает видео.
                        </video>
                    </div>
                </div>
            </div>
            
        </div>

        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only"></span>
        </a>
    </div>
    
    
    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="product-cards d-flex justify-content-center">
                    <div class="product-card">
                        <img src="product1.jpg" class="product-card-img" alt="Купальник">
                        <div class="product-card-body">
                            <h5 class="product-card-title">Купальник</h5>
                            <p class="product-card-text">Красивый купальник со стразами на выступление</p>
                            <p class="product-card-price">Цена: 1500 руб.</p>
                            <a href="catalog.html" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <img src="product2.jpg" class="product-card-img" alt="Купальник">
                        <div class="product-card-body">
                            <h5 class="product-card-title">Купальник</h5>
                            <p class="product-card-text">Красивый купальник со стразами на выступление</p>
                            <p class="product-card-price">Цена: 1700 руб.</p>
                            <a href="#" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <img src="product3.jpg" class="product-card-img" alt="Купальник">
                        <div class="product-card-body">
                            <h5 class="product-card-title">Купальник</h5>
                            <p class="product-card-text">Красивый купальник со стразами на выступление</p>
                            <p class="product-card-price">Цена: 1600 руб.</p>
                            <a href="catalog.html" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="product-cards d-flex justify-content-center">
                    <div class="product-card">
                        <img src="product3.jpg" class="product-card-img" alt="Купальник">
                        <div class="product-card-body">
                            <h5 class="product-card-title">Купальник</h5>
                            <p class="product-card-text">Красивый купальник со стразами на выступление</p>
                            <p class="product-card-price">Цена: 1800 руб.</p>
                            <a href="catalog.html" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <img src="product2.jpg" class="product-card-img" alt="Купальник">
                        <div class="product-card-body">
                            <h5 class="product-card-title">Купальник</h5>
                            <p class="product-card-text">Красивый купальник со стразами на выступление</p>
                            <p class="product-card-price">Цена: 1900 руб.</p>
                            <a href="catalog.html" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                    <div class="product-card">
                        <img src="product1.jpg" class="product-card-img" alt="Купальник">
                        <div class="product-card-body">
                            <h5 class="product-card-title">Купальник</h5>
                            <p class="product-card-text">Красивый купальник со стразами на выступление</p>
                            <p class="product-card-price">Цена: 2000 руб.</p>
                            <a href="catalog.html" class="btn btn-primary">Посмотреть</a>
                        </div>
                    </div>
                    
                </div>
            </div>
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
    <!-- Ссылка на каталог -->
    <div class="catalog-link">
        <a href="catalog.html" class="btn btn-secondary">Перейти в каталог</a>
    </div>


    <section id="aa-promo">
      <div class="container">
        <div class="row">
          <!-- Большой блок промо -->
          <div class="col-md-5 no-padding">
            <div class="aa-promo-left">
              <div class="aa-promo-banner">
                <img src="promo1.jpg" alt="img">
                <div class="aa-prom-content">
                  <span>Скидка 75%</span>
                  <h4><a href="#">Для гимнастики</a></h4>
                </div>
              </div>
            </div>
          </div>
          <!-- Маленькие блоки промо -->
          <div class="col-md-7 no-padding">
            <div class="row">
              <div class="col-sm-6">
                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="promo2.jpg" alt="img">
                    <div class="aa-prom-content">
                      <span>Эксклюзивный товар</span>
                      <h4><a href="#">Для единоборства</a></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="promo3.jpg" alt="img">
                    <div class="aa-prom-content">
                      <span>Скидка</span>
                      <h4><a href="#">На купальники</a></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="promo4.jpg" alt="img">
                    <div class="aa-prom-content">
                      <span>Новые поступления</span>
                      <h4><a href="#">Для детей</a></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="aa-single-promo-right">
                  <div class="aa-promo-banner">
                    <img src="promo5.jpg" alt="img">
                    <div class="aa-prom-content">
                      <span>Скидка 25%</span>
                      <h4><a href="#">Для танцев</a></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


        <!-- Секция "Почему именно мы?" -->
    <section class="background-section">
        <div class="text-container">
            <h4 class="section-title">1.Высококачественные ткани:<br>- Мы используем только прочные, эластичные и быстро сохнущие материалы для купальников, обеспечивая комфорт и свободу движений.<br>2.Декор со стразами:<br>- Наши купальники украшаются безопасными и яркими стразами, которые добавляют изысканности и индивидуальности.<br>- Стразы надежно закреплены, что гарантирует долговечность и устойчивость к износу даже при интенсивной активности.<br>3.Материалы для инвентаря:<br>- Мы предлагаем инвентарь, изготовленный из качественных, прочных материалов, подходящих для детского использования.<br>- Все товары проходят строгую проверку на безопасность и соответствие международным стандартам.<br>4.Эстетика и функциональность:<br>- Мы заботимся не только о качестве, но и о дизайне, создавая стильные и современные модели, которые понравятся детям и родителям.<br>- Каждый элемент продуман до мелочей для обеспечения максимального комфорта и функциональности.</h4>
        </div>
        <div class="additional-text-container">
            <p class="additional-text">Мы обеспечиваем качество и стиль на каждом этапе производства.</p>
        </div>
    </section>

    <!-- Форма поддержки -->
    <section class="order-form-section">
        <form class="order-form mx-auto" style="max-width: 600px;">
            <h4>Свяжитесь с нами</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Имя" required>
                </div>
                <div class="col-md-6">
                    <input type="tel" class="form-control" placeholder="Телефон" required>
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Опишите ваш вопрос..." required>
                </div>
            </div>
            <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="terms">
                <label class="form-check-label" for="terms">
                    Я прочитал(а) и соглашаюсь с правилами сайта <a href="#">правила и условия</a>
                </label>
            </div>
            <div class="text-center mt-4">
                <button type="submit" class="btn order-btn" disabled>Связаться</button>
            </div>
            <!-- Модальное окно для правил -->
            <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="termsModalLabel">Правила и условия</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                        </div>
                        <div class="modal-body">
                            Здесь будет текст правил и условий...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <script>
    // Обработчик для чекбокса "Согласие с условиями"
    document.getElementById('terms').addEventListener('change', function(event) {
        if (event.target.checked) {
            // Если чекбокс отмечен, показываем модальное окно
            const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
            termsModal.show();
        }
        // Обработчик для чекбокса "Согласие с условиями"
        const submitButton = document.querySelector('.order-btn');
        submitButton.disabled = !event.target.checked; // Активируем кнопку если чекбокс выбран

    });
    </script>

    
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

    <!-- Нижняя часть страницы (подвал) -->
    <div class="footer">
        © 2024 PROспорт34 | Тел: +7(988) 005-49-18 | <a href="https://vk.com/pro_sport_34">ВКонтакте</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
