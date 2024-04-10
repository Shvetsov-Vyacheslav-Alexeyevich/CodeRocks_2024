<?
    session_start();
    require_once("db_model.php");
    require_once("functions.php");

    if (!empty($_POST))
    {
        $errors = [];
        $product_photo = $_FILES['picture'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_vendor = $_SESSION['user']['vendor_id'];

        $product_weight = $_POST['product_weight'];
        $product_length = $_POST['product_length'];
        $product_width = $_POST['product_width'];
        $product_height = $_POST['product_height'];

        $product_category = $_POST['product_category'];
        $product_description = $_POST['product_description'];
        $product_access = $_POST['open_access'];

        $product_storage_warehouse = $_POST['storage_warehouse'];
        $product_quantity = $_POST['product_quantity'];

        var_dump($product_storage_warehouse);
        
        if (!empty($product_name) && !empty($product_price) && !empty($product_weight) && !empty($product_length) && !empty($product_width) && !empty($product_height) && !empty($product_category) && !empty($product_description))
        {
            // ----> Проверки
            if (empty($_FILES)) { $errors[] = 'Вы не добавили ни одной фотографии товара.'; }

            if (mb_strlen($product_name) > 100) { $errors[] = 'Название должно быть менше или равно 100 символам.'; }

            if (!is_numeric($product_price)) { $errors[] = 'Цена указывается только в числовом формате.'; }
            if ($product_price <= 0) { $errors[] = 'Цена должна быть больше 0.'; }
            if ($product_price >= 100000) { $errors[] = 'Цена должна быть меньше 100 тысяч.'; }

            if (!is_numeric($product_weight)) { $errors[] = 'Вес указывается только в числовом формате.'; }
            if ($product_weight <= 0) { $errors[] = 'Вес должен быть больше 0.'; }
            if ($product_weight > 1000) { $errors[] = 'Вес должен быть не больше 1 тонны.'; }

            if (!is_numeric($product_length)) { $errors[] = 'Длина указывается только в числовом формате.'; }
            if ($product_length <= 0) { $errors[] = 'Длинна должна быть больше 0.'; }

            if (!is_numeric($product_width)) { $errors[] = 'Ширина указывается только в числовом формате.'; }
            if ($product_width <= 0) { $errors[] = 'Ширина должна быть больше 0.'; }

            if (!is_numeric($product_height)) { $errors[] = 'Высота указывается только в числовом формате.'; }
            if ($product_height <= 0) { $errors[] = 'Ширина должна быть больше 0.'; }

            if (mb_strlen($product_description) > 1024) { $errors[] = 'Описание продукта не должно быть больше 1024 символов.'; }
            // ---------------------------------

            if (empty($errors))
            {
                $arr = [];
                $db = new MysqlModel;

                // Добавить продавца который выкладывает товар заместо 1;
                // Добавить продавца который выкладывает товар заместо 1;
                // Добавить продавца который выкладывает товар заместо 1;
                $arr = $db->query("
                    INSERT INTO PRODUCTS(
                        name,
                        description,
                        price,
                        category_id,
                        vendor_id,
                        is_hidden
                    )
                    VALUES(
                        '$product_name',
                        '$product_description',
                         $product_price,
                         $product_category,
                         $product_vendor,
                         $product_access
                    )
                ");

                $arr = $db->goResultOnce("
                    SELECT
                        *
                    FROM
                        PRODUCTS
                    WHERE
                        name = '$product_name' AND
                        description = '$product_description' AND
                        price = $product_price AND
                        category_id = $product_category AND
                        vendor_id = $product_vendor AND
                        is_hidden = $product_access
                ");

                $product_id = $arr['id'];
                
                $arr = $db->query("
                    INSERT INTO PRODUCT_CHARACTERISTICS(
                        product_id,
                        weight,
                        length,
                        width,
                        height
                    )
                    VALUES(
                        $product_id,
                        $product_weight,
                        $product_length,
                        $product_width,
                        $product_height
                    )
                ");

<<<<<<< Updated upstream
                $result = add_photos($_FILES['picture'], $product_id);

                if ($result !== true)
                {
                    $arr = $db->query("
                        DELETE
                        FROM
                            PRODUCTS
                        WHERE
                            id = $product_id
                    ");
                }
                
                header("Refresh: 0");
                exit;
=======
                echo 'Ваш товар был успешно добавлен в каталог товаров.';

                // ----> Проверки склада
                if ($product_storage_warehouse != 'none' && $product_quantity > 0)
                {
                    $arr = $db->query("
                        INSERT INTO PRODUCTS_COUNT(
                            count,
                            product_id,
                            store_id
                        )
                        VALUES(
                            $product_quantity,
                            $product_id,
                            $product_storage_warehouse
                        )
                    ");
                }
                // ---------------------------------
>>>>>>> Stashed changes
            }
        } else { $errors[] = 'Не все поля заполнены.'; }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Создать товар</title>
    </head>
    <body>
        <? if (!empty($errors)): ?>
            <div style="color: red">
                <?
                foreach ($errors as $error)
                    echo $error . "<br>";
                ?>
            </div>
        <? endif ?>
        <form enctype="multipart/form-data" method="POST" action="" style="display: flex; flex-direction: column; width: 300px">
            <input name="MAX_FILE_SIZE" type="hidden" value="10485760">
            <input type="file" name="picture[]" accept="image/png, image/jpeg" multiple>

            <input type="text" name="product_name" placeholder="Название">
            <input type="number" min="0" max="99999" name="product_price" placeholder="Стоимость">

            <input type="number" min="0" step="0.001" max="1000" name="product_weight" placeholder="Масса (кг)">

            <input type="number" min="0" name="product_length" placeholder="Длина (мм)">
            <input type="number" min="0" name="product_width" placeholder="Ширина (мм)">
            <input type="number" min="0" name="product_height" placeholder="Высота (мм)">

            <select name="product_category">
                <?
                $categories = [];
                $db = new MysqlModel;

                $categories = $db->goResult("
                    SELECT
                        *
                    FROM
                        PRODUCT_CATEGORIES
                ");

                foreach ($categories as $category):
                ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                <? endforeach ?>
            </select>

            <textarea name="product_description" placeholder="Описание"></textarea>

            <input type="submit">

            <div>
                <input type="radio" name="open_access" value="0" checked> Открыть доступ
                <input type="radio" name="open_access" value="1"> Скрыть доступ
            </div>



            <div>
                <select name="storage_warehouse">
                    <option value="none" selected>Склад хранения</option>
                    <?
                    $warehouses = [];
                    $db = new MysqlModel;

                    $warehouses = $db->goResult("
                        SELECT
                            *
                        FROM
                            STORES
                    ");
                    
                    foreach ($warehouses as $stock):
                    ?>
                    <option value="<?= $stock['id'] ?>"><?= $stock['name'] ?></option>
                    <? endforeach ?>
                </select>
                <input type="number" min="1" name="product_quantity" placeholder="Количество">
            </div>
        </form>
        <hr>
        <pre>
            <? var_dump($_POST)?>
        </pre>
    </body>
</html>