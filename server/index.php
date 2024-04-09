<?
    session_start();
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <a href="registration.php">Регистрация</a>
        <a href="login.php">Авторизация</a>
        <hr>
        <pre>
            <? var_dump($_SESSION) ?>
        </pre>
    </body>
</html>