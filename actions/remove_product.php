<?php
    session_start();

    $config = require '../config/config.php';

    $id = $_POST['id'];
    $categoryId = $_POST['category_id'];
    $user_id = $_SESSION['auth']['id'];
    $mysql = $config['mysql'];
    $query = $mysql->prepare("
SELECT * FROM basket WHERE product_id = :product_id
AND user_id = :user_id
");

    $query->execute([
        ':product_id' => $id,
        ':user_id'    => $user_id,
    ]);
    $product = $query->fetch();

    if ($product['quantity'] > 1) {
        $quantity = $product['quantity'] - 1;
        $query = $mysql->prepare("
    UPDATE basket SET quantity = :quantity
    WHERE id = :id
    ");
        $query->execute([
            ':quantity' => $quantity,
            ':id'       => $product['id'],
        ]);
    } else {
        $query = $mysql->prepare("
    DELETE FROM basket WHERE id = :id
    ");

        $query->execute([
            ':id' => $product['id'],
        ]);
    }

    header("Location: ../category.php?id=$categoryId");