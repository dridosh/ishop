<?php
    session_start();
    include 'autoloader.php';

    $config = require 'config/config.php';
    $mysql = $config['mysql'];
    $categories = $mysql->query("SELECT * FROM CATEGORIES");

?>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <title>iShop-интернет магазин</title>
        <style>
            a {
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class='container mt-5'>
            <?php

                require_once 'header.php';


                echo '<div class="categories mt-5">';
                foreach ($categories as $category) {
                    echo "
                    <div>
                        {$category['name']}
                        <a href='category.php?id={$category['id']}'>
                            <img class='category-picture' src='uploads/{$category['picture']}' alt='фото'>
                        </a>
                    </div>
                    ";
                }
                echo '</div>';
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>
</html>