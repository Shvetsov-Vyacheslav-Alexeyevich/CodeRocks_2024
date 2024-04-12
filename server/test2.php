<?
    session_start();
    require_once("functions.php");
    $db = new MysqlModel();

    if (!empty($_FILES))
    {
        $sus = load_avatar($_FILES['picture'], $_SESSION['user']['id']);

        if (!empty($sus) && $sus != "wrong_extension")
        {
            $_SESSION['user']['photo_path'] = $sus;
        }

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
            <input name="picture" type="file" accept="image/png, image/jpeg">
            <input name="sus" type="text">
            <input type="submit">
        </form>
        <img height="200" width="200" src="<?= (!empty($_SESSION['user']['photo_path'])) ? "/data/users/{$_SESSION['user']['id']}/{$_SESSION['user']['photo_path']}" : "/sources/images/avatar_no_img.png" ?>">
        <hr>
        <a href="/server/test2.php">Сброс</a>
        <pre>
            Сессия:
            <? var_dump($_SESSION) ?>
            <hr>
            <?
            var_dump($_FILES)
            ?>
        </pre>
    </body>
</html>