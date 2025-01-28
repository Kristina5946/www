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
                    <h1 class="h2">Аналитика вашего сайта:</h1>
                </div>

                <?php require_once 'anal.php'; ?>
                <style>
                    body {
                        overflow-x: hidden;
                    }
                    h1, h2 {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    h1 {
                        font-size: 2.5rem;
                        font-weight: bold;
                    }
                    h2 {
                        font-size: 1.8rem;
                        color:rgb(246, 249, 251);
                    }
                    .card {
                        background-color:hsla(240, 22.10%, 15.10%, 0.80);
                        border: none;
                        margin-bottom: 20px;
                    }
                    .card-header {
                        background-color:hsla(240, 19.00%, 24.70%, 0.68);
                        color: #ffffff;
                    }
                    .card-body {
                        color: #e6f7ff;
                    }
                    .section {
                        padding: 20px;
                    }
                </style>
                <div class="container py-5">
                    <h1>Как повысить посещаемость сайта: 10 эффективных стратегий</h1>
                    <div class="section">
                        <div class="card">
                            <div class="card-header">
                                <h2>1. Оптимизация поисковых систем (SEO)</h2>
                            </div>
                            <div class="card-body">
                                <p>Оптимизация сайта под поисковые системы — это основа для привлечения органического трафика. Вот несколько ключевых аспектов SEO:</p>
                                <ul>
                                    <li><strong>Ключевые слова</strong>: Исследуйте и выбирайте правильные ключевые слова, относящиеся к вашей теме, и используйте их в заголовках, подзаголовках и тексте.</li>
                                    <li><strong>On-page SEO</strong>: Обеспечьте качественное заполнение тегов заголовков, метаописаний и alt-тегов для изображений.</li>
                                    <li><strong>Техническое SEO</strong>: Убедитесь, что ваш сайт быстро загружается, работает на мобильных устройствах и имеет удобную навигацию.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>2. Создание качественного контента</h2>
                            </div>
                            <div class="card-body">
                                <p>Контент — это король. Создайте уникальный и ценный контент, который интересен вашей целевой аудитории, не только на страницах сайта:</p>
                                <ul>
                                    <li>Публикуйте статьи, блоги, инфографику и видео.</li>
                                    <li>Рассказывайте истории и делитесь своим опытом.</li>
                                    <li>Публикуйте обзоры.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>3. Активное продвижение в социальных сетях</h2>
                            </div>
                            <div class="card-body">
                                <p>Социальные сети предоставляют отличные возможности для рекламы вашего контента:</p>
                                <ul>
                                    <li>Разработайте стратегию публикаций и делитесь своим контентом на различных платформах.</li>
                                    <li>Взаимодействуйте с вашей аудиторией: отвечайте на комментарии и проводите конкурсы.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>4. Email-маркетинг</h2>
                            </div>
                            <div class="card-body">
                                <p>Email-маркетинг — это мощный инструмент для привлечения аудитории на ваш сайт:</p>
                                <ul>
                                    <li>Создайте список подписчиков и регулярно отправляйте информационные рассылки с актуальными новостями, акциями и ссылками на новый контент.</li>
                                    <li>Настройте автоматизированные кампании, чтобы восполнить потерянные возможности.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>5. Гостевые посты на других сайтах</h2>
                            </div>
                            <div class="card-body">
                                <p>Публикация статей на других ресурсах может значительно увеличить трафик:</p>
                                <ul>
                                    <li>Ищите сайты с реальной аудиторией, соответствующей вашей нише.</li>
                                    <li>Пишите качественные посты и добавляйте ссылки на свой сайт.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>6. Платная реклама</h2>
                            </div>
                            <div class="card-body">
                                <p>Инвестиции в платную рекламу могут приносить быстрые результаты:</p>
                                <ul>
                                    <li>Используйте Google Ads для продвижения вашего сайта через контекстную рекламу.</li>
                                    <li>Рассмотрите платную рекламу в социальных сетях для более целевой аудитории.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>7. Кросс-промоция с другими сайтами</h2>
                            </div>
                            <div class="card-body">
                                <p>Сотрудничайте с другими веб-ресурсами для взаимного продвижения:</p>
                                <ul>
                                    <li>Обменивайтесь ссылками и рекламой с сайтами, которые не являются конкурентами, но имеют схожую целевую аудиторию.</li>
                                    <li>Проводите совместные мероприятия и акции.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>8. Использование видео-контента</h2>
                            </div>
                            <div class="card-body">
                                <p>Видео-контент становится все более популярным:</p>
                                <ul>
                                    <li>Создайте видео о своих товарах и разместите их на различных платформах с ссылками на ваш сайт.</li>
                                    <li>Встраивайте видео в статьи на вашем сайте для увеличения времени пребывания пользователей на странице.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>9. Анализ и работа с данными</h2>
                            </div>
                            <div class="card-body">
                                <p>Регулярный анализ трафика и поведения пользователей поможет вам оптимизировать работу:</p>
                                <ul>
                                    <li>Используйте инструменты аналитики, такие как Google Analytics, для отслеживания источников трафика и пользовательского поведения.</li>
                                    <li>Вносите изменения на основе собранных данных для повышения эффективности.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>10. Поддержка обратной связи и пользовательского опыта</h2>
                            </div>
                            <div class="card-body">
                                <p>Качество обслуживания пользователей имеет значение:</p>
                                <ul>
                                    <li>Слушайте свою аудиторию и учитывайте их отзывы.</li>
                                    <li>Улучшайте пользовательский интерфейс и устраняйте трудности навигации на сайте.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h2>Заключение</h2>
                            </div>
                            <div class="card-body">
                                <p>Повышение посещаемости сайта требует комплексного подхода и постоянных усилий. Используйте описанные выше стратегии, адаптируйте их к своей ситуации и наблюдайте за ростом вашего трафика. Постоянное совершенствование и адаптация к изменениям в ваших нишах и предпочтениях пользователей помогут вам оставаться на шаг впереди конкурентов.</p>
                                <p><strong>Успехов вам в ваших начинаниях!</strong></p>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>
    <?php $conn->close(); ?>
    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
