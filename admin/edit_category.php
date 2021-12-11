<?php
    session_start();

    $config = require '../config/config.php';
    $mysql = $config['mysql'];
    $id = $_POST['id'];
    $query = $mysql->prepare("SELECT * FROM categories WHERE id = :id");
    $query->execute([':id' => $id]);
    $categories = $query->fetch();
    $_SESSION['categories'] = $categories;

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
        <title>Категории</title>
    </head>
    <body>
        <div class='container mt-5'>
            <form enctype="multipart/form-data" action="actions/edit_category.php" method="post">

                <input hidden class="form-control mb-2" name='id_new' value="<?= $id ?>">
                <input required class="form-control mb-2" name='name_new' placeholder="измените имя категории"
                       value="<?= $categories['name'] ?>">
                <textarea required class="form-control mb-2" name='description_new' row='3'
                          placeholder="Измените описание категории"><?= $categories['description'] ?></textarea>
                <h2>Выберите новую картинку</h2>
                <input  class="form-control mb-2 w-50" type="file" name="file">
                <button type="submit" class='btn btn-success w-100'>Сохранить изменения</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>