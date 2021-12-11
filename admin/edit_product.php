<?php
    session_start();
    $config = require '../config/config.php';


    $id = $_POST['id'];
    $mysql = $config['mysql'];
    $query = $mysql->prepare("SELECT p.*, c.name as category FROM products p LEFT JOIN categories c ON c.id = p.category_id WHERE p.id = :id");
    $query->execute([':id' => $id]);
    $products = $query->fetch();

    $query = "SELECT * FROM categories WHERE id != :category_id";
    $res = $mysql->prepare($query);
    $res->execute([
        ':category_id' => $products['category_id'],
    ]);

    $_SESSION['products'] = $products;
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
        <title>Редактирование продукта</title>
    </head>
    <body>

        <div class='container mt-5'>
            <form enctype="multipart/form-data" action="edit_product.php" method="post">
                <input hidden name="id" value="<?= $id ?>">
                <input required class="form-control mb-2" name='new_name' placeholder="Введите новое имя продукта"
                       value="<?= $products['name'] ?>">
                <textarea required class="form-control mb-2" name='new_description' rows='3'
                          placeholder="Редактируйте описание продукта"><?= $products['description'] ?></textarea>
                <input required class="form-control mb-2" name='new_vendor_code' placeholder="Редактируйте код продавца"
                       value="<?= $products['vendor_code'] ?>">
                <input required class="form-control mb-2" name='new_price' placeholder="Редактируйте цену"
                       value="<?= $products['price'] ?>">
                <select name="category_id" class="form-control mb-2 w-50">
                    <?php
                        echo "<option value ='{$products['category_id']}'>    {$products['category']}</option>";
                        foreach ($res as $category) {
                            echo "<option value ='{$category['id']}'>{$category['name']}</option>";
                        }
                    ?>
                </select>
                <h2 class="w-50">Выберите новую картинку для продукта если нужно</h2>
                <input class="form-control mb-2 w-50" type="file" name="file">
                <button type="submit" class='btn btn-success w-100'>Сохранить изменения</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous"></script>
    </body>

</html>