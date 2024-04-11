<?
    session_start();
    require_once("functions.php");

    if (!empty($_FILES))
    {
        $sus = add_photos($_FILES['picture'], 13);

        header("Refresh: 0");
        exit;
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
        <pre>
            Сессия:
            <? var_dump($_SESSION) ?>
            <hr>
            <?
            var_dump(road_calculation("Кемерово", "Новокузнецк"));
            ?>
        </pre>
    </body>
</html>