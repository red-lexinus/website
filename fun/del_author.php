<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
if (isset($_GET['search'])) {
    $author_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING) + 0;
    $mysqli = new mysqli($host, $user, $password, $name);
    $mysqli->query("DELETE FROM author WHERE author_id = '$author_id'");
    $mysqli->query("DELETE FROM poems WHERE author_id = '$author_id'");
    $mysqli->close();
}
header('Location: /new/my/poets.php');
?>
