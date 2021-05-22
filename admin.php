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

<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
$author = '';
$mysqli = new mysqli($host, $user, $password, $name);
$mysqli->query("SET NAMES 'utf8'");
?>

<?php
$root = False;
if ($_COOKIE['user'] == '1') {
    $root = True;
}
?>
<?php if ($root): ?>
    <div class="poets">
        <h1 style="color: blue">Добавить поэта в нашу коллекцию</h1>
        <div class="poet">
            <div class="card">
                <div class="card-body" style="min-width: 100%">
                    <form action="fun/create_author.php" method="post" style="min-width: 100%">
                        <div class="mb-3">
                            <label for="name" class="form-label">ФИО Автора</label>
                            <input type="text" class="form-control" name="full_name">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Дополнительная информация</label>
                            <textarea type="text" class="form-control" name="info"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Дата рождения</label>
                            <input type="date" class="form-control" name="first_date">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Дата Смерти</label>
                            <input type="date" class="form-control" name="second_date">
                        </div>
                        <button type="submit" name='1' class="btn btn-primary">Создать</button>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <h1 style="color: blue">Добавить стих в нашу коллекцию</h1>
        <div class="poet">
            <div class="card">
                <div class="card-body" style="min-width: 100%">
                    <form action="fun/create_poem.php" method="post" style="min-width: 100%">
                        <div class="mb-3">
                            <label for="name" class="form-label">Автор творения </label>
                            <input class="form-control me-2" type="search" placeholder="Поиск поэта"
                                   aria-label="Поиск поэта"
                                   id='search'
                                   name="name">
                            <select class="form-select" aria-label="" name="author_id" id="author_id">
                                <?php
                                $authors = $mysqli->query("SELECT * FROM author");

                                while (($row = $authors->fetch_assoc()) != false) :
                                    $author_id = $row['author_id'];
                                    $full_name = $row['full_name'];
                                    ?>
                                    <option value=<?php echo $author_id ?>><?php echo $full_name ?></option>

                                <?php endwhile ?>
                                <?php $mysqli->close() ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Название стиха</label>
                            <input type="text" class="form-control" name="poem_name">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Текст стиха</label>
                            <textarea type="text" class="form-control" name="poem_txt"></textarea>
                        </div>
                        <button type="submit" name='2' class="btn btn-primary">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (!$root): ?>
    <div class="poet">
        <div class="card" style="background-color:  #b9dfe9; border-radius: 20px;">
            <div class="card-body">
                <h3 style="justify-content: center;color: rgb(0, 47, 255);">
                    Нет прав админа!!!!!!
                </h3>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    document.querySelector('#search').oninput = function () {
        let need_poet = this.value.trim();
        let poets = document.querySelectorAll('option')
        for (let i = 0; i < poets.length; ++i) {
            let poet = poets[i]
            let p = poet.innerText
            if (need_poet != '' && p.search(need_poet) == -1) {
                poet.classList.add('hide')
            } else {
                poet.classList.remove('hide')
            }
        }
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
</body>
</html>