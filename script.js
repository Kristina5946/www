// Инициализация переменных для каталога
let girlsCatalog = []; // Здесь должен быть массив объектов для товаров девочек
let boysCatalog = []; // Здесь должен быть массив объектов для товаров мальчиков

// Функция для загрузки продуктов из базы данных
fetch('bd.php')
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

let cart = [];

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

    // Отображаем карточку товара
    productCard.innerHTML = `
      <div class="card h-100" style="cursor: pointer;">
        <img src="${product.images[0] || 'default.jpg'}" class="card-img-top" alt="${product.name}">
        <div class="card-body">
          <h5 class="card-title">${product.name}</h5>
          <p class="card-text">${product.price}₽</p>
          <button class="btn btn-primary mt-2" onclick="addToCart('${product.name}', ${product.price}, '${product.images[0] || 'default.jpg'}')">Добавить в корзину</button>
          <p class="card-text">${product.description}</p>
          <span class="view-details" onclick="showProductModal('${product.name}', ${product.price}, '${product.description}', ${JSON.stringify(product.images)}, ${JSON.stringify(product.sizes)}); event.stopPropagation();">
            👁 Подробнее
          </span>
        </div>
      </div>
    `;

    catalogContainer.appendChild(productCard);
  });
}

// Функции для переключения обложки и каталога
function showGirlsCatalog() {
  document.getElementById("category-name").innerText = "гимнастики";
  document.querySelector(".cover").style.backgroundImage = "url('фон для девочек.jpg')";
  showCatalog(girlsCatalog);
}

function showBoysCatalog() {
  document.getElementById("category-name").innerText = "единоборства";
  document.querySelector(".cover").style.backgroundImage = "url('фон для мальчиков.jpg')";
  showCatalog(boysCatalog);
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
    const productIndex = cart.findIndex(product => product.name === name && product.size === size);
    if (productIndex === -1) {
        // Если товара нет в корзине, добавляем его
        const product = { name, price, image, size, checked: false, quantity: 1 };
        cart.push(product);
        alert(`Товар '${name}' добавлен в корзину.`);
    } else {
        // Если товар уже есть, увеличиваем количество
        cart[productIndex].quantity++;
        alert(`Количество товара '${name}' обновлено до ${cart[productIndex].quantity}.`);
    }
    
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCart();
}
// При загрузке страницы, восстанавливаем корзину из localStorage
document.addEventListener("DOMContentLoaded", () => {
    const storedCart = localStorage.getItem('cart');
    if (storedCart) {
        cart = JSON.parse(storedCart);
        updateCart();
    }
});
function removeFromCart(index) {
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart)); // Сохраняем изменения
    updateCart();
}

// Функция для обновления корзины
function updateCart() {
    const cartModalBody = document.querySelector('#cart-modal .modal-body');
    cartModalBody.innerHTML = ""; // Очистить текущий контент

    if (cart.length === 0) {
        cartModalBody.innerHTML = `<p>Корзина пуста. Добавьте товары для оформления заказа.</p>`;
        return;
    }

    cart.forEach((product, index) => {
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
                localStorage.setItem('cart', JSON.stringify(cart)); // Сохраняем изменения
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
    cart.forEach((product, index) => {
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
    const selectedProducts = cart.filter((product, index) => {
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
    const selectedProducts = cart.filter((product, index) => {
        const checkbox = document.getElementById(`cart-item-${index}`);
        return checkbox.checked; // Оставляем только отмеченные товары
    });

    selectedProducts.forEach(product => {
        const item = document.createElement('li');
        item.textContent = `${product.name} (x${product.quantity}) - ${product.price * product.quantity}₽`;
        orderItemsList.appendChild(item);
    });
    // Удаление оформленных товаров из корзины
    cart = cart.filter((product, index) => {
        const checkbox = document.getElementById(`cart-item-${index}`);
        return !checkbox.checked; // Сохраняем только неотмеченные товары
    });

    // Сохраняем обновленную корзину в localStorage
    localStorage.setItem('cart', JSON.stringify(cart)); 
    updateCart(); // Обновляем отображение корзины после удаления

    // Сообщение об успешном заказе
    alert('Заказ отправлен!');
    
    // Закрытие модального окна оформления заказа
    const orderModal = bootstrap.Modal.getInstance(document.getElementById('orderModal'));
    if (orderModal) {
        orderModal.hide();
    }
});