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
    <script>
      // Функция для загрузки продуктов из базы данных
      function loadCatalog(category) {
        fetch(`bd.php?category=${category}`)
          .then(response => {
            if (!response.ok) {
              throw new Error(`HTTP ошибка! Статус: ${response.status}`);
            }
            return response.json();
          })
          .then(data => {
            if (!Array.isArray(data)) {
              throw new Error('Полученные данные имеют некорректный формат.');
            }
            showCatalog(data);
          })
          .catch(error => {
            console.error('Ошибка загрузки данных:', error);
            const catalogContainer = document.getElementById("catalog");
            catalogContainer.innerHTML = `<p>Ошибка загрузки данных: ${error.message}</p>`;
          });
      }

      function showCatalog(catalog) {
        const catalogContainer = document.getElementById("catalog");
        catalogContainer.innerHTML = ""; // Очищаем предыдущий контент
        if (catalog.length === 0) {
          catalogContainer.innerHTML = `<p>Товар не найден.</p>`;
          return;
        }

        catalog.forEach(product => {
          const productCard = document.createElement("div");
          productCard.className = "col";

          productCard.innerHTML = `
            <div class="card h-100" style="cursor: pointer;">
              <img src="${product.images[0]}" class="card-img-top" alt="${product.name}"> <!-- Используем первое изображение для предпросмотра -->
              <div class="card-body">
                <h5 class="card-title">${product.name}</h5>
                <p class="card-text">${product.price}₽</p>
                <button class="btn btn-primary mt-2" onclick="addToCart('${product.name}', ${product.price}, '${product.images[0]}')">Добавить в корзину</button>
                <p class="card-text"><br></p>
                <span class="view-details" onclick="showProductModal('${product.name}', ${product.price}, '${product.description}', ${JSON.stringify(product.images)}, ${JSON.stringify(product.sizes)}); event.stopPropagation();">
                  👁 Подробнее
                </span>
              </div>
            </div>
          `;

          // Добавляем обработчик двойного клика на карточку
          productCard.addEventListener("dblclick", () => {
            showProductModal(product.name, product.price, product.description, product.images, product.sizes);
          });

          catalogContainer.appendChild(productCard);
        });
      }
      
      // Функции для переключения обложки и каталога
      function showGirlsCatalog() {
        document.getElementById("category-name").innerText = "гимнастики";
        document.querySelector(".cover").style.backgroundImage = "url('фон для девочек.jpg')";
        loadCatalog('девочки');
      }

      function showBoysCatalog() {
        document.getElementById("category-name").innerText = "единоборства";
        document.querySelector(".cover").style.backgroundImage = "url('фон для мальчиков.jpg')";
        loadCatalog('мальчики');
      }

      // Функция для показа модального окна с деталями товара

      function showProductModal(name, price, description, images, sizes) {
        document.getElementById("productModalLabel").innerText = name;
        document.getElementById("productPrice").innerText = `${price}₽`;
        document.getElementById("productDescription").innerText = description;

        const productImagesContainer = document.getElementById("productImages");
        productImagesContainer.innerHTML = ''; // Очистить предыдущие изображения

        // Добавляем изображения в карусель
        images.forEach((image, index) => {
          const isActive = index === 0 ? 'active' : ''; // Первая картинка активная
          productImagesContainer.innerHTML += `
            <div class="carousel-item ${isActive}">
              <img src="${image}" class="d-block w-100" alt="${name}">
            </div>
          `;
        });

        // Задаем размеры
        const sizeButtonsContainer = document.getElementById("sizeButtons");
        sizeButtonsContainer.innerHTML = ""; // Очищаем предыдущие размеры
        let selectedSize = null; // Хранит выбранный размер

        // Проверка на наличие доступных размеров
        if (sizes && sizes.length > 0) {
            sizes.forEach(size => {
                const button = document.createElement("button");
                button.innerText = size.value; // Название размера
                button.className = "btn btn-outline-primary me-2"; // Основные стили кнопки
                button.disabled = !size.available; // Блокируем, если недоступно

                // Меняем стиль, если недоступен
                if (!size.available) {
                    button.classList.add("disabled");
                } else {
                    // Добавляем обработчик события на кнопку
                    button.onclick = () => {
                        if (selectedSize) {
                            selectedSize.classList.remove("btn-primary");
                            selectedSize.classList.add("btn-outline-primary");
                        }
                        selectedSize = button;
                        button.classList.remove("btn-outline-primary");
                        button.classList.add("btn-primary");
                    };
                }

                sizeButtonsContainer.appendChild(button);
            });
        } else {
            // Если размеров нет, выводим сообщение
            sizeButtonsContainer.innerHTML = `<p class="text-danger">Безразмерный товар</p>`;
        }

        const addToCartButton = document.createElement("button");
        addToCartButton.className = "btn btn-primary mt-2";
        addToCartButton.innerText = "Добавить в корзину";

        addToCartButton.onclick = () => {
          // Если размеры есть, проверяем выбранный размер
          if (sizes && sizes.length > 0) {
              if (selectedSize) {
                  const sizeValue = selectedSize.innerText; // Получаем выбранный размер
                  addToCart(name, price, images[0], sizeValue); // Используем выбранный размер
              } else {
                  alert("Пожалуйста, выберите размер перед добавлением в корзину.");
              }
          } else {
              // Если нет размеров, добавляем без размера
              addToCart(name, price, images[0], null); // Товар доступен без размера
          }
      };
        const modalFooter = document.querySelector("#productModal .modal-footer");
        modalFooter.innerHTML = ''; // Очистить предыдущие кнопки
        modalFooter.appendChild(addToCartButton);

        new bootstrap.Modal(document.getElementById('productModal')).show();
      }
      // Функция для добавления товара в корзину

      
      function addToCart(name, price, image, size) {
          const productIndex = window.cart.findIndex(product => product.name === name && product.size === size);
          if (productIndex === -1) {
              // Если товара нет в корзине, добавляем его
              const product = { name, price, image, size, checked: false, quantity: 1 };
              window.cart.push(product);
              alert(`Товар '${name}' добавлен в корзину.`);
          } else {
              // Если товар уже есть, увеличиваем количество
              window.cart[productIndex].quantity++;
              alert(`Количество товара '${name}' обновлено до ${window.cart[productIndex].quantity}.`);
          }
          
          localStorage.setItem('cart', JSON.stringify(window.cart));
          updateCart();
      }
      // При загрузке страницы, восстанавливаем корзину из localStorage
      document.addEventListener("DOMContentLoaded", () => {
          const storedCart = localStorage.getItem('cart');
          if (storedCart) {
              window.cart = JSON.parse(storedCart);
          } else {
              window.cart = [];
          }
          updateCart();
          showGirlsCatalog();
      });
      function removeFromCart(index) {
          window.cart.splice(index, 1);
          localStorage.setItem('cart', JSON.stringify(window.cart)); // Сохраняем изменения
          updateCart();
      }

      // Функция для обновления корзины
      function updateCart() {
          const cartModalBody = document.querySelector('#cart-modal .modal-body');
          cartModalBody.innerHTML = ""; // Очистить текущий контент

          if (window.cart.length === 0) {
              cartModalBody.innerHTML = `<p>Корзина пуста. Добавьте товары для оформления заказа.</p>`;
              return;
          }

          window.cart.forEach((product, index) => {
              const itemContainer = document.createElement('div');
              itemContainer.className = "d-flex align-items-center mb-2";

              const img = document.createElement('img');
              img.src = product.image;
              img.alt = product.name;
              img.style.width = "200px";
              img.style.marginRight = "10px";

              const quantityInput = document.createElement('input');
              quantityInput.type = 'number';
              quantityInput.value = product.quantity;
              quantityInput.min = '1';
              quantityInput.style.width = '60px'; // Установка ширины счетчика
              quantityInput.className = 'form-control form-control-sm'; // Класс для уменьшенного размера

              const check = document.createElement('input');
              check.className = "form-check-input";
              check.type = "checkbox";
              check.id = `cart-item-${index}`;
              check.onchange = updateTotal;

              const label = document.createElement('label');
              label.className = "form-check-label";
              label.htmlFor = `cart-item-${index}`;
              label.textContent = `${product.name} - ${product.price}₽ (Размер: ${product.size})`;

              const removeButton = document.createElement('button');
              removeButton.className = "btn btn-danger btn-sm";
              removeButton.onclick = () => removeFromCart(index);
              removeButton.textContent = "🗑️";


              quantityInput.onchange = () => {
                  const newQuantity = parseInt(quantityInput.value);
                  if (newQuantity > 0) {
                      product.quantity = newQuantity;  // Обновляем количество продукта
                      localStorage.setItem('cart', JSON.stringify(window.cart)); // Сохраняем изменения
                      updateTotal(); // Пересчитываем итог
                  } else {
                      quantityInput.value = product.quantity; // Вернуть предыдущее значение если неправильно
                  }
              }

              itemContainer.appendChild(img);
              itemContainer.appendChild(check);
              itemContainer.appendChild(quantityInput);
              itemContainer.appendChild(label);
              itemContainer.appendChild(removeButton);
              cartModalBody.appendChild(itemContainer);
          });

          const totalContainer = document.createElement('p');
          totalContainer.innerHTML = `<strong>Итого:</strong> <span id="total">0₽</span>`;
          cartModalBody.appendChild(totalContainer);

          updateTotal();
      }


      function updateTotal() {
          let total = 0;
          window.cart.forEach((product, index) => {
              const checkbox = document.getElementById(`cart-item-${index}`);
              const quantityInput = document.querySelector(`input[type="number"][value="${product.quantity}"]`);
              
              if (checkbox.checked) {
                  total += product.price * product.quantity;
              }
          });
          document.getElementById('total').innerText = `${total}₽`;
      }

      // Инициализация каталога девочек по умолчанию
      document.addEventListener("DOMContentLoaded", () => showGirlsCatalog());


      // Обработчик нажатия на кнопку "Оформить заказ" в модальном окне корзины
      document.querySelector('#checkoutButton').addEventListener('click', () => {
          const orderItemsList = document.getElementById('orderItemsList');
          orderItemsList.innerHTML = ''; // Очистить список товаров

          // Перебираем корзину и добавляем только отмеченные товары в заказ
          const selectedProducts = window.cart.filter((product, index) => {
              const checkbox = document.getElementById(`cart-item-${index}`);
              return checkbox.checked; // Оставляем только отмеченные товары
          });

          selectedProducts.forEach(product => {
              const item = document.createElement('li');
              item.textContent = `${product.name} (x${product.quantity}) - ${product.price * product.quantity}₽`;
              orderItemsList.appendChild(item);
          });

          // Открываем модальное окно оформления заказа
          const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
          orderModal.show();
      });
      // Обработчик нажатия на кнопку "Оформить заказ" в модальном окне оформления заказа
      document.querySelector('#submitOrder').addEventListener('click', () => {
          const surname = document.getElementById('surname').value.trim();
          const name = document.getElementById('name').value.trim();
          const patronymic = document.getElementById('patronymic').value;
          const phone = document.getElementById('phone').value.trim();
          const email = document.getElementById('email').value.trim();
          const deliveryAddress = document.getElementById('deliveryAddress').value;
          const details = document.getElementById('details').value;


          event.preventDefault(); // Отменяем стандартное действие кнопки
          // Проверяем заполненность полей
          if (!surname || !name || !email || !phone) {
              if (!surname) {
                  document.getElementById('surname').classList.add('is-invalid');
              } else {
                  document.getElementById('surname').classList.remove('is-invalid');
              }

              if (!name) {
                  document.getElementById('name').classList.add('is-invalid');
              } else {
                  document.getElementById('name').classList.remove('is-invalid');
              }

              if (!email) {
                  document.getElementById('email').classList.add('is-invalid');
              } else {
                  document.getElementById('email').classList.remove('is-invalid');
              }

              if (!phone) {
                  document.getElementById('phone').classList.add('is-invalid');
              } else {
                  document.getElementById('phone').classList.remove('is-invalid');
              }

              return;
          }

          const orderItemsList = document.getElementById('orderItemsList');
          orderItemsList.innerHTML = ''; // Очистить список товаров
          // Здесь можно добавить код для отправки информации на сервер или по почте
          // Перебираем корзину и добавляем только отмеченные товары в заказ
          const selectedProducts = window.cart.filter((product, index) => {
              const checkbox = document.getElementById(`cart-item-${index}`);
              return checkbox.checked; // Оставляем только отмеченные товары
          });

          selectedProducts.forEach(product => {
              const item = document.createElement('li');
              item.textContent = `${product.name} (x${product.quantity}) - ${product.price * product.quantity}₽`;
              orderItemsList.appendChild(item);
          });
          // Удаление оформленных товаров из корзины
          window.cart = window.cart.filter((product, index) => {
              const checkbox = document.getElementById(`cart-item-${index}`);
              return !checkbox.checked; // Сохраняем только неотмеченные товары
          });

          // Сохраняем обновленную корзину в localStorage
          localStorage.setItem('cart', JSON.stringify(window.cart)); 
          updateCart(); // Обновляем отображение корзины после удаления

          // Сообщение об успешном заказе
          alert('Заказ отправлен!');
          
          // Закрытие модального окна оформления заказа
          const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
          if (orderModal) {
              orderModal.hide();
          }
      });

      // Функция для отправки данных формы на сервер
      document.querySelector('#submitOrder').addEventListener('click', (event) => {
    event.preventDefault(); // Отменяем стандартное действие кнопки

    const surname = document.getElementById('surname').value.trim();
    const name = document.getElementById('name').value.trim();
    const patronymic = document.getElementById('patronymic').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const email = document.getElementById('email').value.trim();
    const deliveryAddress = document.getElementById('deliveryAddress').value;
    const details = document.getElementById('details').value.trim();
    const cart = JSON.stringify(window.cart); // Преобразуем корзину в JSON-строку

    // Проверяем заполненность полей
    if (!surname || !name || !email || !phone) {
        if (!surname) {
            document.getElementById('surname').classList.add('is-invalid');
        } else {
            document.getElementById('surname').classList.remove('is-invalid');
        }

        if (!name) {
            document.getElementById('name').classList.add('is-invalid');
        } else {
            document.getElementById('name').classList.remove('is-invalid');
        }

        if (!email) {
            document.getElementById('email').classList.add('is-invalid');
        } else {
            document.getElementById('email').classList.remove('is-invalid');
        }

        if (!phone) {
            document.getElementById('phone').classList.add('is-invalid');
        } else {
            document.getElementById('phone').classList.remove('is-invalid');
        }

        return;
    }

    // Отправляем данные на сервер
    fetch('submit_order.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            last_name: surname,
            first_name: name,
            middle_name: patronymic,
            phone: phone,
            email: email,
            delivery_address: deliveryAddress,
            cart: cart,
            order_details: details,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert('Ошибка: ' + data.error);
        } else {
            alert(data.message); // Показываем сообщение об успешном оформлении заказа

            // Удаление оформленных товаров из корзины
            window.cart = window.cart.filter((product, index) => {
                const checkbox = document.getElementById(`cart-item-${index}`);
                return !checkbox.checked; // Сохраняем только неотмеченные товары
            });

            // Сохраняем обновленную корзину в localStorage
            localStorage.setItem('cart', JSON.stringify(window.cart)); 
            updateCart(); // Обновляем отображение корзины после удаления

            // Очищаем форму
            document.getElementById('surname').value = '';
            document.getElementById('name').value = '';
            document.getElementById('patronymic').value = '';
            document.getElementById('phone').value = '';
            document.getElementById('email').value = '';
            document.getElementById('deliveryAddress').value = '';
            document.getElementById('details').value = '';

            // Закрытие модального окна оформления заказа
            const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
            if (orderModal) {
                orderModal.hide();
            }
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
        alert('Произошла ошибка при оформлении заказа. Пожалуйста, попробуйте еще раз.');
    });
});

    </script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
