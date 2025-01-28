<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в админку</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
        *{
            font-family: "Oswald", sans-serif;
        }
            
        body {
            background-color:hsla(240, 22.10%, 15.10%, 0.91);
            opacity: 0;
            animation: fadeIn 1s ease-in forwards;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center mb-4">Вход в административную панель</h2>
        <form action="admin.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Логин</label>
                <input type="text" id="username" name="login" class="form-control" placeholder="Введите логин" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Введите пароль" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary w-100" style="background-color:rgba(22, 22, 47, 0.96);">Войти</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
