<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
if (isset($_GET['search'])) {
    $poem = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING) + 0;
    $mysqli = new mysqli($host, $user, $password, $name);
    $mysqli->query("DELETE FROM poems WHERE poem_id = '$poem'");
    $mysqli->close();
}
header('Location: /website/poems.php');
?>
