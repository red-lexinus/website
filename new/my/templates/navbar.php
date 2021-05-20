<?php
if (isset($_POST['signout'])) {
    setcookie('user', '', time() - 3600, '/');
    header('Location: /new/my/');
}
?>
<div class="header">
    <div class="box">
        <a href="index.php"><img src="img\logo.png" title="на главную страницу" alt=""/></a>
        <h1>Стихи оживляют душу</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <div class="row_block" id='a_header'>
                        <a class="a_header" href="poets.php">Поэты</a>
                        <a class="a_header" href="poems.php">Стихи</a>
                        <a class="a_header" href="index.php">О проекте</a>
                        <?php
                        if ($_COOKIE['user'] == 'admin'):?>
                            <a class="a_header" href="admin.php" tabindex="-1">Админ панель</a>
                        <?php endif; ?>
                        <?php
                        if ($_COOKIE['user'] == ''):?>
                            <a class="a_header" href="#" tabindex="-1" data-bs-toggle="modal" data-bs-target="#signmod">Войти</a>
                            <a class="a_header" href="#" tabindex="-1" data-bs-toggle="modal" data-bs-target="#regmod">Зарегестрироваться</a>
                        <?php endif; ?>
                        <?php
                        if (!($_COOKIE['user'] == '')):?>
                            <li class="nav-item">
                                <div style="margin-bottom : 10px;">
                                    <form action="" method="post">
                                        <input type="submit" class="btn btn-primary" name="signout"
                                               value="Выйти из акк">
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
</div>

<!-- Modal -->
<div class="modal fade" id="signmod" tabindex="-1" aria-labelledby="modlb" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modlb">Авторизация</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <div class="modal-body">
                <form action="check_fun/check_auth.php" method="post">
                    <div class="mb-3">
                        <label for="logauth" class="form-label">Login</label>
                        <input type="text" class="form-control" id="logauth" name="logauth" placeholder="Login">
                    </div>
                    <div class="mb-3">
                        <label for="passauth" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passauth" name="passauth" placeholder="Пароль">
                    </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-light" style="background: #4ce3cc" data-bs-dismiss="modal">
                    Закрыть
                </button>
                <button type="submit" name="do_login" class="btn" style="background: #4ce3cc">Войти</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="regmod" tabindex="-1" aria-labelledby="modlb" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modlb">Регестрация</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--      <form action="checks/check_reg.php" method="post">-->
                <form action="check_fun/check_reg.php" method="post">
                    <div class="mb-3">
                        <label for="namereg" class="form-label">Name</label>
                        <input type="text" class="form-control" id="namereg" name="namereg" placeholder="Имя">
                    </div>

                    <div class="mb-3">
                        <label for="logreg" class="form-label">Login</label>
                        <input type="text" class="form-control" id="logreg" name="logreg" placeholder="Login">
                    </div>
                    <div class="mb-3">
                        <label for="passreg" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passreg" name="passreg" placeholder="Пароль">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" style="background: #4ce3cc">
                    Закрыть
                </button>
                <button type="submit" name="do_reg" class="btn" style="background: #4ce3cc">Зарегестрироваться</button>
            </div>
            </form>
        </div>
    </div>
</div>

