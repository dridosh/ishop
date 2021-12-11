<?php
    session_start();

    $id = $_POST['id_new'];
    $new_name = $_POST['name_new'];
    $new_description = $_POST['description_new'];
    $file = $_FILES['file'];

    $config = require '../../config/config.php';
    $mysql = $config['mysql'];

    if (
        $new_name === $_SESSION['categories']['name'] &
        $new_description === $_SESSION['categories']['description'] &
        empty($file['tmp_name']) &
        empty($file['name'])
    ) {
        $_SESSION['errorCategoryEdit'] = true;
        header('Location: ../../admin/categories.php');

    } elseif (!empty($file['tmp_name']) & !empty($file['name'])) {
        $file_name = $file['name'];
        $temp_name = $file['tmp_name'];
        $types = explode('/', $file['type']);

        if ($file['size'] > 3145728) {
            $_SESSION['errorCategorySize'] = true;
            header('Location: ../../admin/categories.php');
        } elseif ($types[0] !== 'image') {
            $_SESSION['errorCategoryUpload'] = true;
            header('Location: ../../admin/categories.php');
        }

        $data = explode('.', $file_name);
        $ext = $data[count($data) - 1];

        $shortname = 'categories/' . time() . rand(0, 10000000) . '.' . $ext;
        $fullname = '../../uploads/' . $shortname;
        move_uploaded_file($temp_name, $fullname);

        $query = $mysql->prepare("UPDATE categories SET name = :new_name, description = :description, picture = :picture WHERE id = :id");
        $query->execute([
            ':new_name'    => $new_name,
            ':description' => $new_description,
            ':picture'     => $shortname,
            ':id'          => $id,
        ]);
        $_SESSION['editСategoriesPict'] = true;
        header('Location: ../../admin/categories.php');
    } else {
        $query = $mysql->prepare("UPDATE categories SET name = :new_name, description = :description WHERE id = :id");
        $query->execute([
            ':new_name'    => $new_name,
            ':description' => $new_description,
            ':id'          => $id,
        ]);

        $_SESSION['editСategory'] = true;
        header('Location: ../../admin/categories.php');
    }