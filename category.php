<?php
    session_start();

    $config = require 'config/config.php';
    $exec = $config['exec'];
    $mysql = $config['mysql'];
    $categoryId = $_GET['id'];

    $query = $mysql->prepare("SELECT * FROM categories WHERE id = :id");
    $query->execute([
        ':id' => $categoryId,
    ]);

    $category = $query->fetch();

    $user_id = $_SESSION['auth']['id'];

    $query = $mysql->prepare("
select p.*, b.quantity from products p
left join basket b on p.id = b.product_id and b.user_id = :user_id
where category_id = :category_id
");
    $query->execute([
        ':category_id' => $categoryId,
        ':user_id'     => $user_id,
    ]);
    $products = $query->fetchAll();


?>

<!doctype html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
              crossorigin="anonymous">
        <link rel="stylesheet" href="../css/style.css">
        <title>iShop - Товары в категории</title>
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

                echo "<h1 class='mt-5'>{$category['name']}</h1>";
                echo "<h3><em>{$category['description']}</em></h3>";
            ?>
            <div class="products">
                <?php

                    foreach ($products as $product) {
                        $buttonMinus = $product['quantity'] ?
                            "
                    <form class='display-inline' action='actions/remove_product.php' method='POST'>
                        <input name='id' hidden value='{$product['id']}'>
                        <input name='category_id' hidden value='$categoryId'>
                        <button class='btn btn-danger'>-</button>
                    </form>
                    " : '';

                        $buttonPlusText = $product['quantity'] ? '+' : 'Добавить в корзину';
                        $buttonPlus =
                            "
                    <form class='display-inline' action='actions/add_product.php' method='POST'>
                        <input name='id' hidden value='{$product['id']}'>
                        <input name='category_id' hidden value='$categoryId'>
                        <button class='btn btn-success'>$buttonPlusText</button>
                    </form>
                    ";

                        echo "
                    <div class='card mb-4' style='width: 18rem;'>
                        <div class='text-center'>
                            <a href='product.php?id={$product['id']}&id_cat=$categoryId'>
                                <img src='../uploads/{$product['picture']}' class='card-img-top product-picture' alt='...'>
                            </a>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>{$product['name']}</h5>
                            <p class='card-text'>{$product['description']}</p>
                            $buttonMinus
                            <span>{$product['quantity']}</span>
                            $buttonPlus
                        </div>
                    </div>
                    ";
                    }

                ?>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>
</html>