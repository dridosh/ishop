<?php

    session_start();

    $config = require 'config/config.php';
    $mysql = $config['mysql'];
    $user = $_SESSION['auth'];

    $query = $mysql->prepare("SELECT sum(quantity) as quantity FROM basket
    where user_id = :id");
    $res = $query->execute([
        ':id' => $user['id'],
    ]);
    $products_quantity = $query->fetch();

    $admin = $user['is_admin'] ? '<li class="nav-item">  <a class="nav-link" href="admin/index.php">Админка</a> </li>' : '';


    $test = $user['id'] ? '<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
    ' . $user['name'] . '
</a>


<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
    <li><a class="dropdown-item" href="profile.php">Личный кабинет</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="logout.php">Выход</a></li>
</ul>
</li>' : '
<li class="nav-item"><a class="nav-link" href="login.php">Вход</a></li>
<li class="nav-item"><a class="nav-link" href="register.php">Регистрация</a></li>
';


?>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Главная</a>
                </li>
                <?= $admin ?>

            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="basket.php">
                        <i class="fas fa-shopping-cart"></i>
                        <?php
                            if ($products_quantity['quantity']) {
                                echo "($products_quantity[quantity])";
                            }
                        ?>
                    </a>
                </li>
                <?= $test ?>
            </ul>
        </div>
    </div>
</nav>