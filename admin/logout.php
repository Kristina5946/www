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
// Обновление времени последней активности
$_SESSION['last_activity'] = time();

session_unset();
session_destroy();
header("Location: ../login.php");
exit();
?>