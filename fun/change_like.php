<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
$poem_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING);

$user_id = $_COOKIE['id'];
if ($user_id == ''){
    header('Location: /website/error.php');
    exit();
}
$user_id  = $user_id  + 0;
$mysqli = new mysqli($host, $user, $password, $name);
$likes_poems = $mysqli->query("SELECT * FROM favorite_poems WHERE poem_id=$poem_id && user_id = $user_id");
$likes_poems = $likes_poems->fetch_assoc();
if (count($likes_poems) == 0){
    $mysqli->query("INSERT INTO `favorite_poems` (`id`, `poem_id`, `user_id`) VALUES (NULL, $poem_id, $user_id);");
}
else{
    $mysqli->query("DELETE FROM favorite_poems WHERE poem_id=$poem_id && user_id = $user_id");
}

$mysqli = new mysqli($host, $user, $password, $name);
$href = 'Location: /website/poem.php?id='. $poem_id .'&search=';
header($href);
//$res = $mysqli->query("SELECT * FROM users WHERE login='$login' AND password='$pass'");
//
//$user = $res->fetch_assoc();
//
//
//if (count($user) == 0) {
//    header('Location: /website/error.php');
//    exit();
//}
//
//setcookie('id', $user['id'], time() + 3600 * 24 * 7, '/');
//setcookie('user', $user['root'], time() + 3600 * 24 * 7, '/');
//header('Location: /website/');
$mysqli->close();
?>