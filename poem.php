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
    $poem_id = filter_var(trim($_GET['id']), FILTER_SANITIZE_STRING) + 0;
    $running = True;
    $mysqli = new mysqli($host, $user, $password, $name);
    $mysqli->query("SET NAMES 'utf8'");
    $poem = $mysqli->query("SELECT * FROM poems WHERE poems.poem_id=$poem_id");
    $poem = $poem->fetch_assoc();
    $author_id = $poem["author_id"];
    $author = $mysqli->query("SELECT * FROM author WHERE author.author_id=$author_id");
    $author = $author->fetch_assoc();
    $author_name = $author['full_name'];
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
                            <h1><?php echo $poem['name'] ?></h1>
                            <a href="poet.php?id=<?php echo $author_id ?>&search=""><?php echo $author_name ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="poets">
        <div class="poet">
            <div class="card" style="background-color:  #b9dfe9; border-radius: 20px;">
                <div class="card-body">
                    <h3 style="white-space:pre-wrap;justify-content: center;color: rgb(0, 47, 255);"><?php echo $poem['txt'] ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <?php $mysqli->close() ?>
    </div>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
</script>
</body>
</html>