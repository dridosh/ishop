<?php
    session_start();

    $categoryName = $_POST['name'];
    $description = $_POST['description'];
    $file = $_FILES['file'];
    $name = $file['name'];
    $temp_name = $file['tmp_name'];

    $types = explode('/', $file['type']);
    if ($types[0] !== 'image') {
        $_SESSION['errorCategoryUpload'] = true;
        header('Location: ../../admin/categories.php');
    }




    $config = require '../../config/config.php';
    $mysql = $config['mysql'];

    $data = explode('.', $name);
    $ext = $data[count($data) - 1];

    $pictureName = 'categories/' . time() . rand(0, 1000000) . '.' . $ext;
    $fullName = '../../uploads/' . $pictureName;
    move_uploaded_file($temp_name, $fullName);


    $res = $mysql->prepare("INSERT INTO `fullstack`.`categories` ( `name`, `description`, `picture`) VALUES (:name, :description, :picture)");


    $res->execute([
        ':name'        => $categoryName,
        ':description' => $description,
        ':picture'     => $pictureName,
    ]);

    header('Location: ../categories.php');