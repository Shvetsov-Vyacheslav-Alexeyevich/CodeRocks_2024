<?
    require_once("db_model.php");

    if (empty($_GET))
    {
        $products = [];
        $db = new MysqlModel;

        $products = $db->goResult("
            SELECT
                *
            FROM
                PRODUCTS
        ");
    }
    else
    {
        $product = [];
        $db = new MysqlModel;

        // Добавить продавца который выкладывает товар заместо 1;
        $product = $db->goResultOnce("
            SELECT
                *
            FROM
                PRODUCTS
            WHERE
                id = $_GET[id]
        ");

        $product_characteristics = $db->goResultOnce("
            SELECT
                *
            FROM
                PRODUCT_CHARACTERISTICS
            WHERE
                product_id = $_GET[id]
        ");

        $errors = [];
        $product_id = $product['id'];
        $product_photo = $product['photo_path'];
        $product_name = $product['name'];
        $product_price = $product['price'];
        $product_category = $product['category_id'];
        $product_description = $product['description'];
        $product_access = $product['is_hidden'];

        ///----------------------------------------------
        $product_weight = $product_characteristics['weight'];
        $product_length = $product_characteristics['length'];
        $product_width = $product_characteristics['width'];
        $product_height = $product_characteristics['height'];
        ///----------------------------------------------

        var_dump( $product );
        var_dump( $product_characteristics );

    }

    if (!empty($_POST))
    {
        if (!empty($product_name) && !empty($product_price) && !empty($product_weight) && !empty($product_length) && !empty($product_width) && !empty($product_height) && !empty($product_category) && !empty($product_description))
        {
            // ----> Проверки
            if (empty($product_photo)) { $errors[] = 'Вы не добавили ни одной фотографии товара.'; }

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
                //$product_id = $_POST['id'];
                $product_photo = $_POST['product_photo'];
                $product_name = $_POST['product_name'];
                $product_price = $_POST['product_price'];
                $product_category = $_POST['product_category'];
                $product_description = $_POST['product_description'];
                $product_access = $_POST['open_access'];

                ///----------------------------------------------
                $product_weight = $_POST['product_weight'];
                $product_length = $_POST['product_length'];
                $product_width = $_POST['product_width'];
                $product_height = $_POST['product_height'];
                ///----------------------------------------------
                $arr = [];
                $db = new MysqlModel;

                // Добавить продавца который выкладывает товар заместо 1;
                // Добавить продавца который выкладывает товар заместо 1;
                // Добавить продавца который выкладывает товар заместо 1;
                $arr = $db->query("
                    UPDATE
                        PRODUCTS
                    SET
                        name = '$product_name',
                        description = '$product_description',
                        price = $product_price,
                        photo_path = '$product_photo',
                        category_id = $product_category,
                        vendor_id = 1,
                        is_hidden = $product_access
                    WHERE
                        id = $product_id
                ");
                
                $arr = $db->query("
                    UPDATE
                        PRODUCT_CHARACTERISTICS
                    SET
                        weight =  $product_weight,
                        length = $product_length,
                        width = $product_width,
                        height = $product_height
                    WHERE
                        product_id = $product_id
                ");

                echo 'Ваш товар был успешно изменён.';
                header("Refresh: 0");
                exit;
            }
        } else { $errors[] = 'Не все поля заполнены.'; }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Редактировать товар</title>
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
        <? if (!empty($_GET['id'])): ?>
            <form method="POST" action="" style="display: flex; flex-direction: column; width: 300px">
                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                <input type="file" name="product_photo" accept=".png, .jpeg" multiple>

                <input type="text" name="product_name" placeholder="Название" value="<?= $product['name'] ?>">
                <input type="number" min="0" max="99999" name="product_price" placeholder="Стоимость" value="<?= $product['price'] ?>">

                <input type="number" min="0" step="0.001" max="1000" name="product_weight" placeholder="Масса (кг)" value="<?= $product_characteristics['weight'] ?>">

                <input type="number" min="0" name="product_length" placeholder="Длина (мм)" value="<?= $product_characteristics['length'] ?>">
                <input type="number" min="0" name="product_width" placeholder="Ширина (мм)" value="<?= $product_characteristics['width'] ?>">
                <input type="number" min="0" name="product_height" placeholder="Высота (мм)" value="<?= $product_characteristics['height'] ?>">

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
                    <option value="<?= $category['id'] ?>" <? ($category['id'] == $product['category_id']) ? "checked" : "" ?>><?= $category['name'] ?></option>
                    <? endforeach ?>
                </select>

                <textarea name="product_description" placeholder="Описание"><?= $product['description'] ?></textarea>

                <input type="submit">

                <div>
                    <input type="radio" name="open_access" value="0" checked> Открыть доступ
                    <input type="radio" name="open_access" value="1"> Скрыть доступ
                </div>
            </form>
        <? endif ?>
        <hr>
        <pre>
            <? var_dump($_POST)?>
        </pre>
    </body>
</html>