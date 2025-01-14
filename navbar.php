<nav class="navbar navbar-expand-lg" style="background-color: #F3ECF8;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="image/logo.png" alt="Логотип" class="logo">
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
                            <img src="image/поисковик.png" alt="Поиск" class="icon">
                        </button>
                    </form>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-cart" data-bs-toggle="modal" data-bs-target="#cart-modal">
                        <img src="image/корзина.png" alt="Корзина" class="icon">
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
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label>Проверка корзины товаров</label>
                                    <ul id="orderItemsList"></ul>
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