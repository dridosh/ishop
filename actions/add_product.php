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

    if ($product) {
        $quantity = $product['quantity'] + 1;
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
    INSERT INTO basket (product_id, quantity, user_id)
    VALUES (:product_id, :quantity, :user_id)
    ");

        $query->execute([
            ':product_id' => $id,
            ':quantity'   => 1,
            ':user_id'    => $user_id,
        ]);
    }

    header("Location: ../category.php?id=$categoryId");