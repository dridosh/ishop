<?php

    $id = $_GET['id'];

    $query = 'DELETE FROM products WHERE id = :id';
    $data = [
        ':id' => $id,
    ];

    $config = require '../../config/config.php';
    $exec = $config['exec'];

    $exec($query, $data);
    header('Location: ../products.php');