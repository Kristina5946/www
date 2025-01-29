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
      <?php include 'navbar.php'; ?>
    </header>
    <!-- Обложка -->
    <div class="cover">
      <div class="cover-content text-center">
        <h1>Товары для <span id="category-name">гимнастики</span></h1>
        
      </div>
    </div>
    <!-- Заголовок -->
    <div class="container mt-4">
      <h1 class="text-center">Каталог товаров</h1>
      <!-- Форма поиска -->
      <form id="search-form" class="search-form d-flex justify-content-center mb-4" action="catalog.php" method="GET">
          <input id="search-query" type="text" class="form-control me-2 search-input" name="query" placeholder="Поиск..." aria-label="Поиск">
          <button type="submit" class="btn btn-outline-secondary">Найти</button>
      </form>

      <!-- Скрипт переключения -->
      <script>
        function loadScript(scriptSrc) {
            // Удаляем старые скрипты
            document.querySelectorAll('script[data-dynamic="true"]').forEach(script => script.remove());

            // Загружаем новый скрипт
            const script = document.createElement('script');
            script.src = scriptSrc;
            script.setAttribute('data-dynamic', 'true');
            document.body.appendChild(script);
        }

        // Загрузка скриптов при различных действиях
        document.getElementById('search-form').addEventListener('submit', (event) => {
            event.preventDefault(); // Отмена стандартного действия формы
            const query = document.getElementById('search-query').value.trim();
            if (query) {
                loadScript('catalog.js'); // Загружаем скрипт для поиска
                // Выполняем поиск
                searchCatalog(query);
            } else {
                alert('Введите поисковый запрос!');
            }
        });

        // Инициализация каталога по умолчанию
        loadScript('catalog2.js'); // Загружаем стандартный скрипт для просмотра каталога
    </script>

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
    <!-- Модальное окно избранного -->
    <div class="modal fade" id="favoritesModal" tabindex="-1" aria-labelledby="favoritesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="favoritesModalLabel">Избранное</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <div class="modal-body">
                    <p>Избранное пусто. Добавьте товары в избранное.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
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
    <!-- Модальное окно -->
    <div class="modal fade" id="uniqueProductModal" tabindex="-1" aria-labelledby="uniqueProductModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="uniqueProductModalLabel">Название товара</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
          </div>
          <div class="modal-body">
            <div id="uniqueCarouselExample" class="carousel slide" data-bs-ride="false">
              <div class="carousel-inner" id="uniqueProductImages"></div>
            </div>
            <p id="uniqueProductDescription">Подробное описание товара...</p>
            <p class="fw-bold">Цена: <span id="uniqueProductPrice">1500₽</span></p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
    
    
    <!-- Нижняя часть страницы (подвал) -->
    <div class="footer">
        <?php 
        include 'footer_bd.php';
        echo $section['text'];
         ?>
    </div>

    
    <!-- Добавление иконки ватсапа для свзи изменить номер!!!!! -->
    <a href="https://wa.me/89061727947" class="whatsapp-icon" target="_blank">
        <img src="image/whatsapp-icon.png" alt="WhatsApp" />
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    
</body>
</html>
