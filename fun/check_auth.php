<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
$login = filter_var(trim($_POST['logauth']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['passauth']), FILTER_SANITIZE_STRING);
$mysqli = new mysqli($host, $user, $password, $name);

$res = $mysqli->query("SELECT * FROM users WHERE login='$login' AND password='$pass'");

$user = $res->fetch_assoc();


if (count($user) == 0) {
    header('Location: /new/my/error.php?name=такого+пользователя+не+найдено');
    exit();
}


setcookie('user', $user['root'], time() + 3600 * 24 * 7, '/');
header('Location: /new/my/');
$mysqli->close();
?>