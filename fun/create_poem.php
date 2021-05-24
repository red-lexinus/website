<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
$author_id = filter_var(trim($_POST['author_id']), FILTER_SANITIZE_STRING);
$poem_name = filter_var(trim($_POST['poem_name']), FILTER_SANITIZE_STRING);
$poem_txt = filter_var(trim($_POST['poem_txt']), FILTER_SANITIZE_STRING);


if ($poem_txt == '') {
    header('Location: /website/error.php');
    exit();
}


$mysqli = new mysqli($host, $user, $password, $name);
$mysqli->query("INSERT INTO `poems` (`poem_id`, `author_id`, `name`, `txt`) VALUES (NULL, '$author_id', '$poem_name', '$poem_txt');");

header('Location: /website/admin.php');
$mysqli->close();
?>