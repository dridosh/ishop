<?php
    session_start();

    $id = $_POST['id'];
    $new_name = $_POST['new_name'];
    $new_description = $_POST['new_description'];
    $new_vendor_code = $_POST['new_vendor_code'];
    $new_price = $_POST['new_price'];
    $new_category_id = $_POST['category_id'];
    $file = $_FILES['file'];

    $config = require '../../config/config.php';
    $mysql = $config['mysql'];

    if (
        $new_name === $_SESSION['products']['name'] &
        $new_description === $_SESSION['products']['description'] &
        $new_vendor_code === $_SESSION['products']['vendor_code'] &
        $new_price === $_SESSION['products']['price'] &
        $new_category_id === $_SESSION['products']['category_id'] &
        empty($file['tmp_name']) &
        empty($file['name'])
    ) {
        $_SESSION['errorProductEdit'] = true;

    } elseif (!empty($file['tmp_name']) & !empty($file['name'])) {

        $file_name = $file['name'];
        $temp_name = $file['tmp_name'];

        $types = explode('/', $file['type']);

        if ($file['size'] > 3145728) {
            $_SESSION['errorProductSize'] = true;
            header('Location: ../../admin/products.php');
        } elseif ($types[0] !== 'image') {
            $_SESSION['errorProductUpload'] = true;
            header('Location: ../../admin/products.php');
        }

        $data = explode('.', $file_name);
        $ext = $data[count($data) - 1];

        $shortname = 'products/' . time() . rand(0, 10000000) . '.' . $ext;
        $fullname = '../../uploads/' . $shortname;
        move_uploaded_file($temp_name, $fullname);

        $query = $mysql->prepare("UPDATE products SET name = :new_name, description = :description, category_id = :category_id, vendor_code = :vendor_code, price = :price, picture = :picture WHERE id = :id");
        $query->execute([
            ':new_name'    => $new_name,
            ':description' => $new_description,
            ':category_id' => $new_category_id,
            ':vendor_code' => $new_vendor_code,
            ':price'       => $new_price,
            ':picture'     => $shortname,
            ':id'          => $id,
        ]);

        $_SESSION['editProducts'] = true;


    } else {

        $query = $mysql->prepare("UPDATE products SET name = :new_name, description = :description, category_id = :category_id, vendor_code = :vendor_code, price = :price WHERE id = :id");
        $query->execute([
            ':new_name'    => $new_name,
            ':description' => $new_description,
            ':category_id' => $new_category_id,
            ':vendor_code' => $new_vendor_code,
            ':price'       => $new_price,
            ':id'          => $id,
        ]);
        $_SESSION['editProducts'] = true;
    }

    header('Location: ../../admin/products.php');