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
    <!-- Контейнер с фоновым изображением -->
    <div class="container-fluid bg-image d-flex align-items-center justify-content-center" style="background-image: url('image/фон для карточек.jpg'); height: 100vh;">
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

    <?php include 'connection.php'; ?>

    <!-- Нижняя часть страницы (подвал) -->
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="catalog.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>
</html>
