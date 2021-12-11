<?php
    session_start();

    $product_id = $_GET['id'];
    $category_id = $_GET['id_cat'];
    $config = require 'config/config.php';
    $mysql = $config['mysql'];

    $query = $mysql->prepare("SELECT * FROM products WHERE id = :id");
    $query->execute([
        ':id' => $product_id,
    ]);
    $product = $query->fetch();


?>


<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css?<?= time() ?>">
        <title>iShop - <?= $product['name'] ?></title>
    </head>
    <body>
        <header></header>

        <div class="container mt-5">

            <h1><?= $product['name'] ?></h1>
            <h3><em><?= $product['description'] ?></em></h3>

            <?php
                echo
                "
                            <div class='card mb-5 category-picture-user-p' style='width:18rem;'>
                                    <div class='text-center'>
                                        <img src='../uploads/$product[picture]' class='card-img-top category-picture-user-p' title='{$product['name']}' alt='фото товара'>
                                    </div>
                                <div class='card-body'>
                                    <a href='category.php?id=$category_id'<button class='btn btn-success mt-1'>назад</button></a>
                                </div>
                            </div>";
            ?>
            <footer></footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                    crossorigin="anonymous"></script>
    </body>
</html>