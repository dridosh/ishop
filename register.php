<?php
    session_start();
    $config = require 'config/config.php';
    $mysql = $config['mysql'];

    $query='SELECT * FROM cities';
    $cities = $mysql->query($query)->fetchAll();
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

                if ($_SESSION['register']['error']) {
                    $errors = $_SESSION['register']['errors'];
                    foreach ($errors as $error) {
                        echo "
                        <div class='alert alert-danger text-center' role='alert'>
                            $error
                        </div>
                        ";
                    }
                    unset($_SESSION['register']);
                }

                require_once 'header.php';



            ?>



            <form method="POST" class='mt-5' action="do_register.php">
                <input name='name' required class='form-control mb-2' placeholder="Имя">
                <input name='login' required class='form-control mb-2' placeholder="Логин">
                <input name='age' type="number" class='form-control mb-2' placeholder="Возраст">
                <input name='password' required type="password" class='form-control mb-2' placeholder="Пароль">
                <input name='repassword' required type="password" class='form-control mb-2'
                       placeholder="Повторите пароль">
                <select name='city_id' class='form-control mb-2'>
                    <?php
                        $nullValue = null;
                        echo "<option value='{$nullValue}' selected disabled>-- Выберите город --</option>";
                        foreach ($cities as $key => $row ) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        }

                    ?>
                </select>
                <button class='btn btn-success w-100' type="submit">Зарегистрироваться</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>
</html>