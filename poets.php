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
    <form class="d-flex" method="get">
        <input class="form-control me-2" type="search" placeholder="Поиск поэта" aria-label="Поиск поэта"
               id='search'
               name="name">
    </form>
</div>
<div class="poets" id="all_poets">
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
    $authors = $mysqli->query("SELECT * FROM author");


    while (($row = $authors->fetch_assoc()) != false) :
        $author_id = $row['author_id'];
        $full_name = $row['full_name'];
        $photo_id = $row['photo_id'];
        $data_1 = "Жил с " . $row['first_date'];
        $data_2 = " по " . $row['second_date'];
        if ($data_1 == "Жил с 0000-00-00") $data_1 = 'Жил с ?';
        if ($data_2 == " по 0000-00-00") $data_2 = ' по ?';


        $full_data = $data_1 . $data_2
        ?>
        <div class="poet">
            <div class="card">
                <div class="card-body">
                    <img src='img/poets/0.png'>
                    <p class="card-text"><?php echo $full_name ?><br><?php echo $full_data ?></p>
                    <div>
                        <?php if ($_COOKIE['user'] == '1'): ?>
                            <a href="fun/del_author.php?id=<?php echo $author_id ?>&search=" class="btn btn-primary">Удалить
                                автора</a>
                        <?php endif; ?>
                        <a href="poet.php?id=<?php echo $author_id ?>&search=" class="btn btn-primary">Перейти к
                            поэту</a>
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
            let p = cord_body.querySelector('p').innerText
            if (need_poet != '' && p.search(need_poet) == -1) {
                poet.classList.add('hide')
            } else {
                poet.classList.remove('hide')
            }
        }
    }
</script>
</body>
</html>

