<?
    require_once("functions.php");

    if (!empty($_POST))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeat_password = $_POST['repeat_password'];
        $is_vendor = $_POST['is_vendor'];

        if (!$is_vendor)
            $array = ["Жмышенко", "Михаил", "Альбертович"];
        else
            $array = ["ООО 'Рога и копыта'"];

        $result = registration($email, $password, $repeat_password, $is_vendor, $array);
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Регистрация</title>
    </head>
    <body>
        <form method="POST" action="" style="display: flex; flex-direction: column; width: 300px">
            <input type="email" name="email" placeholder="Почта">
            <input type="password" name="password" placeholder="Пароль">
            <input type="password" name="repeat_password" placeholder="Повторите пароль">
            <div>
                <input type="radio" name="is_vendor" value="0" checked> Покупатель
                <input type="radio" name="is_vendor" value="1"> Продавец
            </div>
            <input type="submit">
        </form>
        <hr>
        <p>
            <?= (isset($result)) ? $result : "" ?>
        </p>
    </body>
</html>