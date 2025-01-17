// Обновленная функция загрузки каталога

function searchCatalog(query) {
    fetch(`bd.php?query=${query}`)
        .then(response => response.json())
        .then(data => {
            showCatalog(data);
        })
        .catch(error => {
            console.error('Ошибка при поиске:', error);
            const catalogContainer = document.getElementById('catalog');
            catalogContainer.innerHTML = `<p>Ошибка загрузки данных: ${error.message}</p>`;
        });
}

// Функция для обработки поиска
function handleSearch(event) {
    event.preventDefault(); // Отмена перезагрузки страницы
    const query = document.getElementById('search-query').value.trim();
    if (query === '') {
        alert('Введите поисковый запрос.'); // Уведомление, если поле пустое
        return;
    }
    loadCatalog('', query); // Загружаем каталог с поисковым запросом
}

// Функция для отображения каталога
function showCatalog(catalog) {
    const catalogContainer = document.getElementById("catalog");
    catalogContainer.innerHTML = ""; // Очищаем предыдущий контент

    if (catalog.length === 0) {
        catalogContainer.innerHTML = `<p>Товары не найдены.</p>`; // Если ничего не найдено
        return;
    }

    catalog.forEach(product => {
        const productCard = document.createElement("div");
        productCard.className = "col";

        productCard.innerHTML = `
            <div class="card h-100" style="cursor: pointer;">
                <img src="image/${product.images[0]}" class="card-img-top" alt="${product.name}">
                <div class="card-body">
                    <h5 class="card-title">${product.name}</h5>
                    <p class="card-text">${product.price}₽</p>
                    <button class="btn btn-primary mt-2" onclick="addToCart('${product.name}', ${product.price}, 'image/${product.images[0]}')">Добавить в корзину</button>
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
      const productIndex = window.cart.findIndex(product => product.name === name && product.size === size && product.image === image);
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


