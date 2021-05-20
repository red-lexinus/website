<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';

$login = filter_var(trim($_POST['logreg']), FILTER_SANITIZE_STRING);
$nameuser = filter_var(trim($_POST['namereg']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['passreg']), FILTER_SANITIZE_STRING);

if (mb_strlen($login) < 1 || mb_strlen($login) > 90) {
    echo "Uncorrect login length";
    exit();
}
if (mb_strlen($nameuser) < 1 || mb_strlen($nameuser) > 40) {
    echo "Uncorrect name length";
    exit();
}
if (mb_strlen($pass) < 1 || mb_strlen($pass) > 40) {
    echo "Uncorrect password length";
    exit();
}


$mysqli = new mysqli($host, $user, $password, $name);

$res = $mysqli->query("SELECT * FROM users WHERE login='$login' AND password='$pass'");

$user = $res->fetch_assoc();
if (count($user) != 0){
    echo "Данный логин уже используется";
    exit();

}
$mysqli->query("INSERT INTO `users` (`id`, `name`, `login`, `password`) VALUES (NULL, '$nameuser', '$login', '$pass');");

setcookie('user', $login, time() + 3600 * 24 * 7, '/');

header('Location: /new/my/');

$mysqli->close();
?>