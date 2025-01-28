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
        <img src="image/${product.images[0]}" class="card-img-top" alt="${product.name}"> <!-- Используем первое изображение для предпросмотра -->
        <div class="card-body">
        <h5 class="card-title">${product.name}</h5>
        <p class="card-text">${product.price}₽</p>
        <button class="btn btn-primary mt-2" onclick="addToCart('${product.name}', ${product.price}, 'image/${product.images[0]}')">Добавить в корзину</button>
        <p class="card-text"><br></p>
        <span class="view-details" onclick="showProductModal('${product.name}', ${product.price}, '${product.description}', ${JSON.stringify(product.images)}, ${JSON.stringify(product.sizes)}); event.stopPropagation();">
            👁 Подробнее
            <button class="btn btn-outline-secondary" onclick="toggleFavorite(this)">
            <img src="image/избр2.png" alt="Избранное" style="width: 20px; height: 20px;">
        </button>
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
    document.querySelector(".cover").style.backgroundImage = "url('image/фон_для_девочек.jpg')";
    loadCatalog('девочки');
    }

function showBoysCatalog() {
    document.getElementById("category-name").innerText = "единоборства";
    document.querySelector(".cover").style.backgroundImage = "url('image/фон_для_мальчиков.jpg')";
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
          <img src="image/${image}" class="d-block w-100" alt="${name}">
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
              addToCart(name, price, `image/${images[0]}`, sizeValue); // Используем выбранный размер
          } else {
              alert("Пожалуйста, выберите размер перед добавлением в корзину.");
          }
      } else {
          // Если нет размеров, добавляем без размера
          addToCart(name, price, `image/${images[0]}`, null); // Товар доступен без размера
      }
  };
    const modalFooter = document.querySelector("#productModal .modal-footer");
    modalFooter.innerHTML = ''; // Очистить предыдущие кнопки
    modalFooter.appendChild(addToCartButton);

    const addToFavoritesButton = document.createElement("button");
    addToFavoritesButton.className = "btn btn-outline-secondary mt-2";
    addToFavoritesButton.innerText = "Добавить в избранное";
    addToFavoritesButton.onclick = () => {
        const sizeValue = selectedSize ? selectedSize.innerText : null; // Получаем выбранный размер
        const product = {
            name: name,
            price: price,
            image: `image/${images[0]}`,
            description: description,
            selectedSize: sizeValue, // Сохраняем выбранный размер
            sizes: sizes, // Сохраняем весь массив размеров
            checked: false
        };
        
        const productIndex = window.favorites.findIndex(fav => 
            fav.name === product.name && 
            fav.price === product.price && 
            fav.image === product.image && 
            fav.selectedSize === product.selectedSize
        );

        if (productIndex === -1) {
            window.favorites.push(product);
            alert(`Товар '${name}' добавлен в избранное.`);
        } else {
            alert(`Товар '${name}' уже в избранном.`);
        }
        localStorage.setItem('favorites', JSON.stringify(window.favorites));
        updateFavoritesUI();
    };
    modalFooter.appendChild(addToFavoritesButton);

    new bootstrap.Modal(document.getElementById('productModal')).show();
  }
 
  // Инициализация каталога девочек по умолчанию
  document.addEventListener("DOMContentLoaded", () => showGirlsCatalog());


  // Обработчик нажатия на кнопку "Оформить заказ" в модальном окне корзины
document.querySelector('#checkoutButton').addEventListener('click', () => {
    const orderItemsList = document.getElementById('orderItemsList');
    orderItemsList.innerHTML = ''; // Очистить список товаров

    // Перебираем корзину и добавляем все товары в заказ
    window.cart.forEach(product => {
        const item = document.createElement('li');
        item.textContent = `${product.name} (x${product.quantity}) - ${product.price * product.quantity}₽`;
        orderItemsList.appendChild(item);
    });

    // Открываем модальное окно оформления заказа
    const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
    orderModal.show();
});

// Обработчик нажатия на кнопку "Оформить заказ" в модальном окне оформления заказа
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
            window.cart = []; // Очищаем корзину после успешного оформления заказа

            // Сохраняем обновленную корзину в localStorage
            localStorage.setItem('cart', JSON.stringify(window.cart)); 
            updateCartUI(); // Обновляем отображение корзины после удаления

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

// Инициализация глобальных переменных
window.favorites = JSON.parse(localStorage.getItem('favorites')) || [];
window.cart = JSON.parse(localStorage.getItem('cart')) || [];

// Функция добавления/удаления из избранного
function toggleFavorite(button) {
    const card = button.closest('.card');
    const name = card.querySelector('.card-title').textContent;
    const price = parseFloat(card.querySelector('.card-text').textContent.replace('₽', '').trim());
    const image = card.querySelector('img').src;

    const sizes = card.dataset.sizes ? JSON.parse(card.dataset.sizes) : []; // Получаем размеры из data-атрибутов
    const selectedSize = card.querySelector('.size-selected') 
        ? card.querySelector('.size-selected').textContent 
        : null; // Получаем выбранный размер, если он есть

    const imgElement = button.querySelector('img');

    // Проверяем, есть ли уже такой товар в избранном
    const productIndex = window.favorites.findIndex(product => 
        product.name === name &&
        product.price === price &&
        product.image === image &&
        product.selectedSize === selectedSize
    );

    if (productIndex === -1) {
        // Добавляем новый товар в избранное
        const product = { 
            name, 
            price, 
            image, 
            description: 'Описание отсутствует', 
            sizes, // Сохраняем доступные размеры
            selectedSize, // Сохраняем выбранный размер
            checked: false 
        };
        window.favorites.push(product);
        imgElement.src = "image/избр1.png"; // Иконка "выбрано"
    } else {
        // Удаляем товар из избранного
        window.favorites.splice(productIndex, 1);
        imgElement.src = "image/избр2.png"; // Иконка "не выбрано"
    }

    localStorage.setItem('favorites', JSON.stringify(window.favorites));
    updateFavoritesUI();
}

function updateFavoritesUI() {
    const favoritesModalBody = document.querySelector('#favoritesModal .modal-body');
    favoritesModalBody.innerHTML = ""; // Очистить текущий контент

    if (window.favorites.length === 0) {
        favoritesModalBody.innerHTML = '<p>Избранное пусто. Добавьте товары в избранное.</p>';
        return;
    }

    window.favorites.forEach((product, index) => {
        const itemContainer = document.createElement('div');
        itemContainer.className = "d-flex align-items-center mb-2";

        const img = document.createElement('img');
        img.src = product.image;
        img.alt = product.name;
        img.style.width = "100px";
        img.style.marginRight = "10px";

        // Открытие модального окна при двойном клике на изображение
        img.ondblclick = () => {
            showProductModal(
                product.name,
                product.price,
                product.description || "Описание отсутствует",
                product.images || [product.image],
                product.sizes || []
            );
        };

        const check = document.createElement('input');
        check.className = "form-check-input";
        check.type = "checkbox";
        check.id = `favorite-item-${index}`;
        check.checked = product.checked;
        check.onchange = () => {
            product.checked = check.checked;
            localStorage.setItem('favorites', JSON.stringify(window.favorites));
        };

        const label = document.createElement('label');
        label.className = "form-check-label";
        label.htmlFor = `favorite-item-${index}`;
        label.textContent = `${product.name} - ${product.price}₽`;

        const removeButton = document.createElement('button');
        removeButton.className = "btn btn-danger btn-sm";
        removeButton.onclick = () => removeFromFavorites(index);
        removeButton.textContent = "🗑️";

        itemContainer.appendChild(img);
        itemContainer.appendChild(check);
        itemContainer.appendChild(label);
        itemContainer.appendChild(removeButton);
        favoritesModalBody.appendChild(itemContainer);
    });

    addSelectedFavoritesToCart(); // Добавляем выделенные товары из избранного в корзину
}
function updateFavoritesUI2() {
    const favoritesModalBody = document.querySelector('#favoritesModal .modal-body');
    favoritesModalBody.innerHTML = ""; // Очистить текущий контент

    if (window.favorites.length === 0) {
        favoritesModalBody.innerHTML = '<p>Избранное пусто. Добавьте товары в избранное.</p>';
        return;
    }

    window.favorites.forEach((product, index) => {
        const itemContainer = document.createElement('div');
        itemContainer.className = "d-flex align-items-center mb-2";

        const img = document.createElement('img');
        img.src = product.image;
        img.alt = product.name;
        img.style.width = "100px";
        img.style.marginRight = "10px";

        // Открытие модального окна при двойном клике на изображение
        img.ondblclick = () => {
            showProductModal(
                product.name,
                product.price,
                product.description || "Описание отсутствует",
                product.images || [product.image],
                product.sizes || []
            );
        };

        const check = document.createElement('input');
        check.className = "form-check-input";
        check.type = "checkbox";
        check.id = `favorite-item-${index}`;
        check.checked = product.checked;
        check.onchange = () => {
            product.checked = check.checked;
            localStorage.setItem('favorites', JSON.stringify(window.favorites));
        };

        const label = document.createElement('label');
        label.className = "form-check-label";
        label.htmlFor = `favorite-item-${index}`;
        label.textContent = `${product.name} - ${product.price}₽`;

        const removeButton = document.createElement('button');
        removeButton.className = "btn btn-danger btn-sm";
        removeButton.onclick = () => removeFromFavorites(index);
        removeButton.textContent = "🗑️";

        itemContainer.appendChild(img);
        itemContainer.appendChild(check);
        itemContainer.appendChild(label);
        itemContainer.appendChild(removeButton);
        favoritesModalBody.appendChild(itemContainer);
    });
}
// Функция для добавления выделенных товаров из избранного в корзину
function addSelectedFavoritesToCart() {
    window.favorites.forEach((product, index) => {
        if (product.checked) {
            // Проверяем, есть ли уже такой товар в корзине
            const productIndex = window.cart.findIndex(cartProduct => 
                cartProduct.name === product.name && 
                cartProduct.size === product.selectedSize &&
                cartProduct.image === product.image
            );

            if (productIndex === -1) {
                // Добавляем новый товар в корзину
                const cartProduct = { 
                    name: product.name, 
                    price: parseFloat(product.price), 
                    image: product.image, 
                    size: product.selectedSize, 
                    quantity: 1 
                };
                window.cart.push(cartProduct);
            } else {
                // Увеличиваем количество, если товар уже есть в корзине
                window.cart[productIndex].quantity++;
            }

            // Сохраняем в массив "добавленных" и сбрасываем галочку
            product.checked = false;
            window.favorites[index] = product; // Обновляем массив избранного
        }
    });

    // Сохраняем обновлённые данные в localStorage
    localStorage.setItem('cart', JSON.stringify(window.cart));
    localStorage.setItem('favorites', JSON.stringify(window.favorites)); // Сохраняем состояние избранного

    // Обновляем интерфейс
    updateCartUI();
    updateFavoritesUI2();
}

// Удаление товара из избранного
function removeFromFavorites(index) {
    window.favorites.splice(index, 1);
    localStorage.setItem('favorites', JSON.stringify(window.favorites));
    updateFavoritesUI();
}

// Функция сброса состояния чекбоксов после закрытия модального окна
function resetFavoritesCheckedState() {
    window.favorites.forEach(product => {
        product.checked = false;
    });
    localStorage.setItem('favorites', JSON.stringify(window.favorites));
}

// Функция добавления товара в корзину
function addToCart(name, price, image, size) {
    const productIndex = window.cart.findIndex(product => product.name === name && product.size === size && product.image === image);
    if (productIndex === -1) {
        const product = { name, price: parseFloat(price), image, size, quantity: 1 };
        window.cart.push(product);
        alert(`Товар '${name}' добавлен в корзину.`);
    } else {
        window.cart[productIndex].quantity++;
        alert(`Количество товара '${name}' обновлено до ${window.cart[productIndex].quantity}.`);
    }
    localStorage.setItem('cart', JSON.stringify(window.cart));
    updateCartUI();
}

// Функция обновления интерфейса корзины
function updateCartUI() {
    const cartModalBody = document.querySelector('#cart-modal .modal-body');
    cartModalBody.innerHTML = ""; // Очистить текущий контент

    if (window.cart.length === 0) {
        cartModalBody.innerHTML = '<p>Корзина пуста. Добавьте товары для оформления заказа.</p>';
        return;
    }

    window.cart.forEach((product, index) => {
        const itemContainer = document.createElement('div');
        itemContainer.className = "d-flex align-items-center mb-2";

        const img = document.createElement('img');
        img.src = product.image;
        img.alt = product.name;
        img.style.width = "100px";
        img.style.marginRight = "10px";

        const quantityInput = document.createElement('input');
        quantityInput.type = 'number';
        quantityInput.style.width = "60px";
        quantityInput.value = product.quantity;
        quantityInput.min = '1';
        quantityInput.className = 'form-control form-control-sm';
        quantityInput.onchange = () => {
            const newQuantity = parseInt(quantityInput.value, 10);
            if (newQuantity > 0) {
                product.quantity = newQuantity;
                localStorage.setItem('cart', JSON.stringify(window.cart));
                updateTotal();
            } else {
                quantityInput.value = product.quantity; // Вернуть предыдущее значение
            }
        };

        const label = document.createElement('label');
        label.className = "form-check-label";
        label.textContent = `${product.name} - ${product.price}₽ (Размер: ${product.size})`;

        const removeButton = document.createElement('button');
        removeButton.className = "btn btn-danger btn-sm";
        removeButton.onclick = () => removeFromCart(index);
        removeButton.textContent = "🗑️";

        itemContainer.appendChild(img);
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

// Функция удаления товара из корзины
function removeFromCart(index) {
    window.cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(window.cart));
    updateCartUI();
}

// Функция пересчета итоговой суммы в корзине
function updateTotal() {
    const total = window.cart.reduce((sum, product) => sum + (product.price * product.quantity), 0);
    document.getElementById('total').textContent = `${total.toFixed(2)}₽`;
}

// Событие при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    // Восстанавливаем состояние корзины и избранного из localStorage
    const savedFavorites = JSON.parse(localStorage.getItem('favorites')) || [];
    const savedCart = JSON.parse(localStorage.getItem('cart')) || [];

    window.favorites = savedFavorites;
    window.cart = savedCart;

    // Обновляем интерфейс
    updateCartUI();
    updateFavoritesUI();

    });
