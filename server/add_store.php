<?
    session_start();

    require_once("db_model.php");
    require_once("functions.php");

    $locations = [];
    $db = new MysqlModel();
    $locations = $db->goResult("
        SELECT
            *
        FROM
            LOCATIONS
    ");

    if (!empty($_POST))
    {
        if (!empty($_POST['name']) && !empty($_POST['location_id']))
        {
            if ($_SESSION['user']['is_vendor'])
            {
                $name = $_POST['name'];
                $location_id = $_POST['location_id'];
                $vendor_id = $_SESSION['user']['vendor_id'];
    
                $pickup_point = $db->query("
                    INSERT INTO STORES(
                        name,
                        location_id,
                        vendor_id
                    )
                    VALUES(
                        '$name',
                        $location_id,
                        $vendor_id
                    )
                ");

                header("Refresh: 0");
                exit;
            }
            else
                echo "Вы не продавец.";
        }
        else
            echo "Заполните все поля.";
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Добавить ПВЗ</title>
    </head>
    <body>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Введите название склада">
            <select name="location_id">
                <? foreach ($locations as $location): ?>
                    <option value="<?= $location['id'] ?>"><?= $location['name'] ?></option>
                <? endforeach ?>
            </select>
            <input type="submit">
        </form>
        <hr>
        Все ваши склады: <br>
        <?
        $pups = $db->goResult("
            SELECT
                *
            FROM
                STORES
            WHERE
                vendor_id = {$_SESSION['user']['vendor_id']}
        ");
        for ($i = 1; $i <= count($pups); $i++)
            echo $i . ") " . $pups[$i - 1]['name'] . "<br>";
        ?>
    </body>
</html>