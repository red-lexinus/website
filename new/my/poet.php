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
    <link href="css\css2.css" rel="stylesheet"/>

</head>
<body>
<?php include('templates/navbar.php') ?>
<?php
$host = 'localhost';
$user = 'root';
$password = '';
$name = 'poet';
$running = False;
if (isset($_GET['search'])) {
    $author_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING) + 0;
    $running = True;
    $mysqli = new mysqli($host, $user, $password, $name);
    $mysqli->query("SET NAMES 'utf8'");
    $authors = $mysqli->query("SELECT * FROM author WHERE author.author_id=$author_id");
    $row = $authors->fetch_assoc();
    $name_1 = $row['name'];
    $second_name = $row['second_name'];
    $last_name = $row['last_name'];
    $photo_id = $row['photo_id'];
    $data_1 = $row['first_date'];
    $info = $row['info'];
    $data_2 = $row['second_date'];
    $full_name = $name_1 . " " . $second_name . " " . $last_name;
    $full_data = "Жил с " . $data_1 . " по " . $data_2;
    $poems = $mysqli->query("SELECT * FROM poems WHERE poems.author_id=$author_id");
}
?>

<?php
if ($running):?>
    <div class="main">
        <div class="profile_card_board">
            <div class="profile_card_body">
                <div class="profile_col_block">
                    <div class="profile_row_block">
                        <div class="profile_col_block">
                            <h1><?php echo $full_name ?></h1>
                            <h5><?php echo $full_data ?></h5>
                            <p><?php echo $info ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="poets">
        <?php
        while (($row = $poems->fetch_assoc()) != false) :
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
        ?>
    </div>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
</body>
</html>