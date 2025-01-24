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

  // Инициализация каталога девочек по умолчанию
document.addEventListener("DOMContentLoaded", () => showGirlsCatalog());