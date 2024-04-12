<?
    session_start();
    require_once("functions.php");
    $db = new MysqlModel();

    if (!empty($_FILES))
    {
        $sus = add_photos($_FILES['picture'], 13);

        header("Refresh: 0");
        exit;
    }

    $product_id = 0;

    if (!empty($_GET['id']))
    {
        $product_id = $_GET['id'];

        $product_info = $db->goResultOnce("
            SELECT
                pr.*,
                v.company_name,
                pcat.name AS category_name,
                pchar.weight,
                pchar.length,
                pchar.width,
                pchar.height
            FROM
                PRODUCTS pr,
                USER_VENDORS v,
                PRODUCT_CATEGORIES pcat,
                PRODUCT_CHARACTERISTICS pchar
            WHERE
                pr.id = $product_id AND
                pr.vendor_id = v.id AND
                pcat.id = pr.category_id AND
                pr.id = pchar.product_id
        ");

        $product_photos = $db->goResult("
            SELECT
                *
            FROM
                PRODUCT_PHOTOS
            WHERE
                product_id = $product_id
        ");

        $product_reviews = $db->goResult("
            SELECT
                r.*,
                uc.firstname,
                uc.name,
                uc.surname,
                u.photo_path
            FROM
                REVIEWS r,
                USER_CLIENTS uc,
                USERS u
            WHERE
                product_id = $product_id AND
                r.client_id = uc.id AND
                uc.user_id = u.id
        ");

        $avg_rate = 0.0;
        $count_review = 0;

        foreach ($product_reviews as $review)
        {
            $avg_rate += $review['rate'];
            $count_review++;
        }

        if ($count_review)
            $avg_rate /= $count_review;

        if (!empty($_SESSION['user']))
        {
            $is_client = false;

            if (array_key_exists('client_id', $_SESSION['user']))
            {
                $is_client = true;
                $client_id = $_SESSION['user']['client_id'];

                $was_review = $db->goResult("
                    SELECT
                        *
                    FROM
                        REVIEWS
                    WHERE
                        product_id = $product_id AND
                        client_id = $client_id
                ");
        
                if (empty($was_review))
                    $was_review = true;
                else
                    $was_review = false;
            }
        }
    }

    if (!empty($_POST))
    {
        if (!empty($_POST['rate']) && isset($_POST['review']))
        {
            $rate = $_POST['rate'];
            $review = $_POST['review'];
            $client_id = $_SESSION['user']['client_id'];

            if (empty($review))
            {
                $query = $db->query("
                    INSERT INTO REVIEWS(
                        product_id,
                        client_id,
                        rate
                    )
                    VALUES(
                        $product_id,
                        $client_id,
                        $rate
                    )
                ");
            }
            else
            {
                $query = $db->query("
                    INSERT INTO REVIEWS(
                        product_id,
                        client_id,
                        review,
                        rate
                    )
                    VALUES(
                        $product_id,
                        $client_id,
                        '$review',
                        $rate
                    )
                ");
            }

            header("Refresh: 0");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form enctype="multipart/form-data" method="POST" action="">
            <input name="MAX_FILE_SIZE" type="hidden" value="10485760">
            <input name="picture[]" type="file" accept="image/png, image/jpeg" multiple>
            <input name="sus" type="text">
            <input type="submit">
        </form>
        <hr>
        <div style="display: flex; gap: 10px">
            <? if (!empty($product_photos)): ?>
                <? foreach ($product_photos as $photo): ?>
                    <div class="image" style="height: 250px; width: 250px; background: url(<?= "/data/products/{$product_id}/{$photo['photo_path']}" ?>) no-repeat center; background-size: cover"></div>
                <? endforeach ?>
            <? else: ?>
                <div class="image" style="height: 250px; width: 250px; background: url(/sources/images/photo.png) no-repeat center;"></div>
            <? endif ?>
        </div>
        <h3><?= $product_info['name'] ?></h3>
        <p>Категория: <?= $product_info['category_name'] ?></p>
        <p>Производитель: <?= $product_info['company_name'] ?></p>
        <p>Цена: <?= $product_info['price'] ?> руб.</p>
        <p>Вес: <?= $product_info['weight'] ?> кг</p>
        <p>Длина: <?= $product_info['length'] ?> мм</p>
        <p>Ширина: <?= $product_info['width'] ?> мм</p>
        <p>Высота: <?= $product_info['height'] ?> мм</p>
        <p>
            Описание:
            <br>
            <?= $product_info['description'] ?>
        </p>
        <br>
        <? if ($count_review): ?>
            <p>
                Средняя оценка: <?= $avg_rate ?>
                <br>
                На основании: <?= $count_review ?> отзывов
            </p>
        <? else: ?>
            <p>Слишком мало оценок для оценки рейтинга.</p>
        <? endif ?>
        <hr>
        <?
        if (!empty($_SESSION['user'])):
            if ($is_client):
                if ($was_review):
        ?>
                    <form method="POST" action="" style="display: flex; flex-direction: column; width: 300px">
                        <h3>Оставить отзыв</h3>
                        <p>
                            Ваша оценка:
                            <input type="number" min="1" max="5" step="1" name="rate">
                        </p>
                        <p>
                            Ваш отзыв (необязательно):
                            <textarea name="review"></textarea>
                        </p>
                        <input type="submit">
                    </form>
                <? else: ?>
                    <p>Вы уже оставили отзыв. Оставить можно только один.</p>
                <? endif ?>
            <? else: ?>
                <p>Вы не можете оставить свой отзыв в качестве компании.</p>
            <? endif ?>
        <? else: ?>
            <p>Вы сможете оставить свой отзыв после авторизации.</p>
        <? endif ?>
        <hr>
        <h3>Отзывы к товару id=<?= $product_id ?></h3>

        <? if (!empty($product_reviews)): ?>

            <? foreach ($product_reviews as $review): ?>

                <p>От: <?= "$review[firstname] $review[name] $review[surname]" ?></p>
                <p>Оценка: <b><?= $review['rate'] ?></b></p>
                
                <? if (!empty($review['review'])): ?>
                    <p><?= $review['review'] ?></p>
                <? endif ?>

                <hr>

            <? endforeach ?>

        <? else: ?>

            <p>
                Пока отзывов нет :(
                <br>
                Будьте первым, кто оставит свой отзыв!
            </p>

        <? endif ?>

        <hr>
        <pre>
            Сессия:
            <? var_dump($_SESSION) ?>
            <hr>
            <?
            
            ?>
        </pre>
    </body>
</html>