<?php
require_once 'bd_products.php'; // Подключение к базе данных

$query = "SELECT * FROM feedback ORDER BY completed ASC, id DESC";
$result = $conn->query($query);

$feedbacks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
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
                    <h1 class="h2">Вопросы клиентов:</h1>
                </div>

                <div class="row">
                <!-- Таблица с обращениями клиентов -->
                    <div class="col-md-12 mb-3">
                        <div class="card p-3">
                            <h5 class="card-title">Обращения клиентов</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-dark table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Имя</th>
                                            <th>Телефон</th>
                                            <th>Email</th>
                                            <th>Вопрос</th>
                                            <th>Выполнено</th>
                                            <th>Заметка</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($feedbacks as $feedback): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($feedback['id']) ?></td>
                                                <td><?= htmlspecialchars($feedback['name']) ?></td>
                                                <td><?= htmlspecialchars($feedback['phone']) ?></td>
                                                <td><?= htmlspecialchars($feedback['email']) ?></td>
                                                <td><?= htmlspecialchars($feedback['question']) ?></td>
                                                <td>
                                                    <input type="checkbox" class="form-check-input" <?= $feedback['completed'] ? 'checked' : '' ?> onclick="toggleCompleted(<?= $feedback['id'] ?>, this.checked)">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" value="<?= htmlspecialchars($feedback['note']) ?>" onblur="updateNote(<?= $feedback['id'] ?>, this.value)">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>

    <!-- Подключение Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleCompleted(id, completed) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_feedback.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + id + '&completed=' + completed);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    location.reload();
                }
            };
        }

        function updateNote(id, note) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'update_feedback.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('id=' + id + '&note=' + encodeURIComponent(note));
        }
    </script>
</body>
</html>
