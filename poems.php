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
        <input class="form-control me-2" type="search" placeholder="Поиск стиха" aria-label="Поиск стиха" id='search' name="name">
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
                    <div>
                        <?php if ($_COOKIE['user'] == '1'): ?>
                            <a href="fun/del_poem.php?id=<?php echo $poem_id ?>&search=" class="btn btn-primary">Удалить
                                стих</a>
                        <?php endif; ?>
                        <a href="poem.php?id=<?php echo $poem_id ?>&search=" class="btn btn-primary">Перейти к стиху</a>
                    </div>
                </div>
            </div>
        </div>

    <?php endwhile ?>
    <?php $mysqli->close() ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
<script>
    document.querySelector('#search').oninput = function () {
        let need_poet = this.value.trim();
        let poets = document.querySelectorAll('.poet')
        for (let i = 0; i < poets.length; ++i) {
            let poet = poets[i]
            let card = poet.querySelector('.card')
            let cord_body = card.querySelector('.card-body')
            let  p = cord_body.querySelector('p').innerText
            if (need_poet != '' && p.search(need_poet) == -1){
                poet.classList.add('hide')
            }
            else {
                poet.classList.remove('hide')
            }
        }
    }
</script>
</body>
</html>