<?php

    session_start();
    $name = $_POST['name'];
    $description = $_POST['description'];
    $vendor_code = $_POST['vendor_code'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $temp_name = $file['tmp_name'];
    $types = explode('/', $file['type']);

    if ($category_id === null) {
        $_SESSION['noCategory'] = true;
        header('Location: ../../admin/products.php');
    } elseif ($file['size'] > 3000000) {
        $_SESSION['errorProductSize'] = true;
        header('Location: ../../admin/products.php');
    } elseif ($types[0] !== 'image') {
        $_SESSION['errorProductUpload'] = true;
        header('Location: ../../admin/products.php');
    }


    $config = require '../../config/config.php';
    $mysql = $config['mysql'];

    $data = explode('.', $file_name);
    $ext = $data[count($data) - 1];

    $shortname = 'products/' . time() . rand(0, 10000000) . '.' . $ext;
    $fullname = '../../uploads/' . $shortname;
    move_uploaded_file($temp_name, $fullname);

    $query = "INSERT INTO products (name, description, category_id, vendor_code, price, picture) VALUES (:name, :description, :category_id, :vendor_code, :price, :picture)";
    $res = $mysql->prepare($query);
    $res->execute([
        ':name'        => $name,
        ':description' => $description,
        ':category_id' => $category_id,
        ':vendor_code' => $vendor_code,
        ':price'       => $price,
        ':picture'     => $shortname,
    ]);

    header('Location: ../products.php');