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
    <!-- Контейнер с фоновым изображением -->
    <div class="container-fluid bg-image d-flex align-items-center justify-content-center" style="background-image: url('фон для карточек.jpg'); height: 100vh;">
      <div class="container bg-overlay p-5 rounded-3 shadow-lg">
        <div class="row">
          <!-- Колонка контактов -->
          <div class="col-md-6 text-start text-dark">
            <h2>Контакты</h2>
            <p>📞 +7 (988) 005-49-18</p>
            <p>👉 @pro_sport_34</p>
            <p>👉 @pro_sport_34_boy</p>
            <p>📍 ул. 8-й воздушной армии, 28а, Волгоград</p>
            <div class="social-icons mt-3">
              <a href="#" class="me-3"><i class="fab fa-vk fa-2x"></i></a>
              <a href="#"><i class="fab fa-avito fa-2x"></i></a>
            </div>
          </div>
          
          <!-- Колонка пунктов выдачи -->
          <div class="col-md-6 text-start text-dark">
            <h2>Пункты выдачи</h2>
            <ul class="list-unstyled">
              <li>🔸 ул. Р.-Крестьянская, 3 - Ворошиловский район</li>
              <li>🔸 50 лет Октября, 20А - Красноармейский район</li>
              <li>🔸 ТЦ Космос - Кировский район</li>
              <li>🔸 Волжский б-р, Профсоюзов, 7Б</li>
            </ul>
          </div>
        </div>
        <!-- Карта -->
        <div class="row mt-4">
          <div class="col-12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2630.549688376835!2d44.503501076940246!3d48.752298208166!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x411aca592f1ca535%3A0x90ea6523d166b07a!2z0KLQvtGA0LPQvtCy0YvQuSDRhtC10L3RgtGAICJDaXRydXMi!5e0!3m2!1sru!2sru!4v1730804329075!5m2!1sru!2sru" width="900" height="450" style="border:1;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
      </div>
    </div>

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
    <a href="https://wa.me/89880054918" class="whatsapp-icon" target="_blank">
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
