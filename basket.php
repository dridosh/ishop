<?php
    session_start();
    $user = $_SESSION['auth'];


    $config = require 'config/config.php';
    $mysql = $config['mysql'];
    $query = $mysql->prepare("
        SELECT p.name, p.price, b.quantity FROM basket b
        join products p on p.id = b.product_id
        WHERE user_id = :user_id
    ");

    $query->execute([
        ':user_id' => $user['id'],
    ]);
    $products = $query->fetchAll();
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
        <title>Корзина</title>
    </head>
    <body>
        <div class="container mt-5">

            <?php
                require_once 'header.php';
            ?>

            <table class='table table-bordered mt-5'>
                <thead>
                    <tr>
                        <th>Имя</th>
                        <th>Количество</th>
                        <th>Цена</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($products as $product) {
                            echo
                            "
                        <tr>
                            <td>{$product['name']}</td>
                            <td>{$product['quantity']}</td>
                            <td>{$product['price']}</td>
                        </tr>
                        ";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>
</html>