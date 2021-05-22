<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
$full_name = filter_var(trim($_POST['full_name']), FILTER_SANITIZE_STRING);
$info = filter_var(trim($_POST['info']), FILTER_SANITIZE_STRING);
$data_1 = filter_var(trim($_POST['first_date']), FILTER_SANITIZE_STRING);
$data_2 = filter_var(trim($_POST['second_date']), FILTER_SANITIZE_STRING);


if ($full_name == '') {
    header('Location: /new/my/error.php');
    exit();
}

if ($data_1 + 1 == '1') $data_1 = NULL;
if ($data_2 + 1 == 1) $data_2 = NULL;

$mysqli = new mysqli($host, $user, $password, $name);
$mysqli->query("INSERT INTO `author` (`author_id`, `info`, `first_date`, `second_date`, `full_name`) VALUES (NULL, '$info', '$data_1', '$data_2', '$full_name' );");

header('Location: /new/my/admin.php');
$mysqli->close();
?>