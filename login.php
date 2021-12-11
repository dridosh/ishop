<?php
    session_start();
    $config = require 'config/config.php';
    $mysql = $config['mysql'];
    $res = $mysql->query('SELECT * FROM cities');

?>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">

        <title>Регистрация</title>
    </head>
    <body>
        <div class='container mt-5'>

            <?php

                if (isset($_SESSION['register'])) {
                    if ($_SESSION['register']['error'] === false) {
                        echo "
                        <div class='alert alert-success text-center' role='alert'>
                            Вы успешно зарегистрировались
                        </div>
                        ";
                    }
                    unset($_SESSION['register']);
                } else if ($_SESSION['login']['error']) {
                    echo "
                <div class='alert alert-warning text-center' role='alert'>
                    {$_SESSION['login']['error']}
                </div>
                ";
                    unset($_SESSION['login']['error']);
                }

                require_once 'header.php';

            ?>

            <form method="POST" class='mt-5' action="do_login.php">
                <input name='login' autocomplete="off" required class='form-control mb-2' placeholder="Логин">
                <input name='password' required type="password" class='form-control mb-2' placeholder="Пароль">
                <button class='btn btn-success w-100' type="submit">ВОЙТИ</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>
</html>