<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <title>Начало в стихах</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous"/>
    <link rel="stylesheet" href="css/new_css.css">

</head>
<body>
<?php include('templates/navbar.php') ?>
<div class="search">
    <form class="d-flex" method="post">
        <input class="form-control me-2" type="search" placeholder="Поиск поэта" aria-label="Поиск поэта" id='name' name="name">
        <button class="btn btn-outline-success" name='search' id='search' type="submit">Поиск</button>
    </form>
</div>
<div class="poets">
    <?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $name = 'poet';
    $author = '';
    if (isset($_POST['search'])) {
        $author = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);;
    }
    $mysqli = new mysqli($host, $user, $password, $name);
    $mysqli->query("SET NAMES 'utf8'");
    $authors = $mysqli->query("SELECT * FROM poems");


    while (($row = $authors->fetch_assoc()) != false) :
        $poem_id = $row['poem_id'];
        $name = $row['name'];
        ?>
        <div class="poet">
            <div class="card">
                <div class="card-body">
                    <img src='img/poets/0.png'>
                    <p class="card-text"><?php echo $name ?></p>
                    <a href="poem.php?id=<?php echo $poem_id ?>&search=" class="btn btn-primary">Перейти к стиху</a>
                </div>
            </div>
        </div>

    <?php endwhile ?>
    <?php $mysqli->close() ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
</body>
</html>