<?php
session_start();
// Проверка времени последней активности
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 600)) {
    // Если прошло более 10 минут (600 секунд) с момента последней активности
    session_unset();
    session_destroy();
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <!-- Подключение Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Иконки Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Боковая панель -->
            <?php require_once 'navbar.php'; ?>

            <!-- Основной контент -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2" style="color: white;">Документация к сайту и Админ-панели:</h1>
                </div>
                <style>
                    .hero-section  {
                        background-color: #0b2545; /* Цвет фона страницы */
                    }

                    .hero-section {
                        padding: 50px;
                        position: relative;
                        overflow: hidden;
                    }

                    .download-btn {
                        background-color: #00b8d4;
                        color: white;
                        transition: background-color 0.3s ease-in-out;
                        border-radius: 50px;
                    }

                    .download-btn:hover {
                        background-color: #008ba3;
                        border-radius: 50px;
                    }

                    .circle-animation {
                        position: absolute;
                        border-radius: 50%;
                        background: rgba(255, 255, 255, 0.1);
                        animation: moveCircles 6s linear infinite;
                    }

                    @keyframes moveCircles {
                        from {
                            transform: translateX(0) scale(1);
                        }
                        to {
                            transform: translateX(1000px) scale(1.6);
                        }
                    }

                    .fade-in {
                        opacity: 0;
                        transform: translateY(-20px);
                        animation: fadeIn 1s forwards ease-out;
                    }

                    @keyframes fadeIn {
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }
                </style>
                <div class="hero-section text-center">
                    <!-- Круги анимации -->
                    <div class="circle-animation" style="width: 200px; height: 200px; top: 10%; left: -50%;"></div>
                    <div class="circle-animation" style="width: 250px; height: 250px; top: 30%; left: -70%;"></div>
                    <div class="circle-animation" style="width: 300px; height: 300px; top: 50%; left: -60%;"></div>

                    <div class="container hero-section" style="height: 100vh; background-image: url('../image/фон_документации3.png'); background-size: contain; background-position: center; background-repeat: no-repeat; background-color: transparent;">
                        <!-- Кнопка скачать -->
                        <button class="btn download-btn mt-4 fade-in" style="position: absolute; left: 20%; bottom: 10%;">
                            <i class="bi bi-download me-2"></i> Скачать документацию
                        </button>
                    </div>
                </div>

                <script>
                    // Добавляем эффект плавного появления блоков
                    document.addEventListener("DOMContentLoaded", () => {
                        const fadeElements = document.querySelectorAll(".fade-in");
                        fadeElements.forEach((el, index) => {
                            setTimeout(() => {
                                el.style.animationDelay = `${index * 0.3}s`;
                            }, 0);
                        });
                    });

                    // Скачивание документации
                    document.querySelector(".download-btn").addEventListener("click", () => {
                        window.location.href = "Полная_документация_для_сайта.docx"; // Укажите путь к документу
                    });
                </script>

                <style>
                    body {
                        line-height: 1.6;
                        margin: 0;
                        padding: 0;
                        color: #333;
                    }
                    .container {
                        max-width: 900px;
                        margin: 20px auto;
                        padding: 20px;
                        background: #fff;
                        border-radius: 8px;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    }
                    h1, h2, h3 {
                        color: #333;
                        margin-bottom: 10px;
                    }
                    h1 {
                        font-size: 2rem;
                    }
                    h2 {
                        font-size: 1.5rem;
                        border-bottom: 2px solid #ddd;
                        padding-bottom: 5px;
                    }
                    h3 {
                        font-size: 1.2rem;
                    }
                    p {
                        margin: 10px 0;
                    }
                    ul {
                        margin: 10px 0 20px 20px;
                    }
                    li {
                        margin: 5px 0;
                    }
                    .code-block {
                        background:rgba(127, 129, 169, 0.57);
                        padding: 15px;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                        font-family: "Courier New", Courier, monospace;
                        overflow-x: auto;
                    }
                    .divider {
                        margin: 30px 0;
                        border-top: 2px solid #ddd;
                    }
                    .highlight {
                        font-weight: bold;
                        color: #444;
                    }
                </style>
                <div class="container">
                    <h1>Полная документация для сайта</h1>

                    <h2>Описание сайта</h2>
                    <p>Этот сайт предназначен для продажи товаров, предназначенных для спортивных занятий. Он состоит из нескольких ключевых секций, каждая из которых выполняет определённые функции. Данная документация поможет вам понять структуру сайта, его основные элементы и порядок работы с админ-панелью.</p>

                    <div class="divider"></div>

                    <h2>Общая структура сайта</h2>

                    <h3>1. <span class="highlight">Навигационная панель (Навбар)</span></h3>
                    <ul>
                        <li><strong>Корзина товаров:</strong> Позволяет пользователям просматривать и управлять добавленными товарами.</li>
                        <li><strong>Избранное:</strong> Дает возможность сохранять товары для последующего просмотра или покупки.</li>
                    </ul>

                    <h3>2. <span class="highlight">Главная страница</span></h3>
                    <ul>
                        <li><strong>Обложка с видео сопровождением:</strong> Короткое видео на обложке, которое привлекает внимание посетителей.</li>
                        <li><strong>Карусель популярных товаров:</strong> Включает товары с кнопками для перехода в каталог.</li>
                        <li><strong>Промосекция:</strong> Содержит описание товаров со скидками.</li>
                        <li><strong>Секция "Почему выбрать наш магазин?":</strong> Убедительные преимущества вашего магазина.</li>
                        <li><strong>Форма обратной связи:</strong> Позволяет пользователям отправлять вопросы или комментарии.</li>
                    </ul>

                    <h3>3. <span class="highlight">Каталог товаров</span></h3>
                    <ul>
                        <li><strong>Обложки для кнопок категорий:</strong> Упрощают переход между категориями товаров.</li>
                        <li><strong>Поисковик:</strong> Ускоряет поиск конкретных товаров.</li>
                        <li><strong>Список товаров:</strong> Основная зона отображения товаров.</li>
                    </ul>

                    <h3>4. <span class="highlight">Контакты</span></h3>
                    <ul>
                        <li><strong>Контактная информация:</strong> Данные для связи с магазином.</li>
                        <li><strong>Пункты выдачи:</strong> Информация о местах, где можно получить заказ.</li>
                        <li><strong>Местонахождение на карте:</strong> Показывает физический адрес магазина.</li>
                    </ul>

                    <h3>5. <span class="highlight">Футер</span></h3>
                    <ul>
                        <li>Ссылки на дополнительные страницы.</li>
                        <li>Основную информацию о сайте (например, политика конфиденциальности, условия использования).</li>
                    </ul>

                    <div class="divider"></div>

                    <div class="section">
                        <h2>Работа с админ-панелью</h2>

                        <h3>1. Главная страница</h3>

                        <h4>Обложка</h4>
                        <ul>
                            <li>Для изменения текста обложки нажмите кнопку "Изменить".</li>
                            <li>В открывшемся окне:
                                <ul>
                                    <li>Измените текст.</li>
                                    <li>Загрузите новое видео (требования: разрешение 720×1280, продолжительность до 5 секунд, формат .mp4).</li>
                                </ul>
                            </li>
                        </ul>

                        <h4>Карусель товаров</h4>
                        <ul>
                            <li>Выберите элемент таблицы и нажмите "Изменить".</li>
                            <li>Внесите изменения:
                                <ul>
                                    <li>Измените текст.</li>
                                    <li>Обновите изображение (требования: разрешение 1620×2160, форматы jpeg, jpg, png).</li>
                                </ul>
                            </li>
                        </ul>

                        <h4>Промосекция</h4>
                        <ul>
                            <li>Выберите элемент и нажмите "Изменить".</li>
                            <li>Измените текст или изображение (требования к изображениям):
                                <ul>
                                    <li>Для больших картинок — 450×600 (или пропорциональные размеры).</li>
                                    <li>Для маленьких картинок — 450×450 (или пропорциональные размеры).</li>
                                    <li>Обязательный тёмный полупрозрачный фон.</li>
                                    <li>Маленькие картинки должны иметь форму квадрата.</li>
                                </ul>
                            </li>
                        </ul>

                        <h3>2. Каталог товаров</h3>

                        <h4>Изменение товара</h4>
                        <ul>
                            <li>Выберите товар в таблице и нажмите "Изменить".</li>
                            <li>Обновите:
                                <ul>
                                    <li>Название.</li>
                                    <li>Описание.</li>
                                    <li>Цену (формат: два знака после запятой).</li>
                                    <li>Изображение (требования: 1620×2160, форматы jpeg, jpg, png).</li>
                                    <li>Размеры (если применимо):</li>
                                </ul>
                            </li>
                        </ul>
                        <div class="code-block">
                            <pre>[{"value":"S","available":true},{"value":"M","available":true},{"value":"L","available":false}]</pre>
                        </div>
                        <li>Размеры (value):
                            <ul>
                            <li>В качестве значений вы можете использовать:</li>
                            <li>Буквы (например, "S", "M", "L", "XL").</li>
                            <li>Числа (например, 38, 40, 42).</li>
                            <li>Каждое значение должно быть заключено в двойные кавычки. </li>
                            <li>Наличие (available):</li>
                            <li>Для обозначения наличия размера используйте:</li>
                            <li>true — если размер есть в наличии.</li>
                            <li>false — если размера нет в наличии.</li>
                            <li>Обязательно соблюдайте указанные синтаксические правила: наличие всех необходимых скобок, кавычек и запятых.</li>
                            <li>Неверный синтаксис может привести к ошибкам при обработке данных</li>
                            </ul>
                        </li>
                        <p>Если товар безразмерный, оставьте список пустым:</p>
                        <div class="code-block">
                            <pre>[]</pre>
                        </div>
                    </div>

                    <div class="section">
                        <h4>4. Контактная информация</h4>
                        <p>Текст редактируется между тегами <code>&lt;p&gt;</code> и <code>&lt;/p&gt;</code>.</p>
                        <div class="code-block">
                            <pre>&lt;p&gt;Ваша информация&lt;/p&gt;</pre>
                        </div>

                        <h4>Пункты выдачи</h4>
                        <p>Добавляйте новые пункты между тегами <code>&lt;li&gt;</code> и <code>&lt;/li&gt;</code>:</p>
                        <div class="code-block">
                            <pre>&lt;li&gt;Адрес пункта выдачи&lt;/li&gt;</pre>
                        </div>
                    </div>

                    <div class="section">
                        <h3>5. Футер</h3>
                        <p>Для редактирования текста выделите нужный текст, не нарушая HTML-структуру.</p>
                        <div class="code-block">
                            <pre>&lt;footer&gt;
                                    &lt;p&gt;Ваш текст&lt;/p&gt;
                                &lt;footer&gt;</pre>
                    </div>
                </div>
            </main>
                 
        </div>
    </div>

    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
