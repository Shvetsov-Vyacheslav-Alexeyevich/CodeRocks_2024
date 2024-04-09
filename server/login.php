<?
    session_start();
    require_once('functions.php');

    if (!empty($_POST['email']) and !empty($_POST['password']))
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $result = authorization($email, $password);
        if (!empty($result))
        {
            $_SESSION['user'] = found_user($email);
            header("Location: /");
            exit;
        }
        else
        {
            $error = "Неправильный логин или пароль";
        }
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Авторизация</title>
    </head>
    <body>
        <form method="POST" action="" style="display: flex; flex-direction: column; width: 300px">
            <input type="email" name="email" placeholder="Почта">
            <input type="password" name="password" placeholder="Пароль">
            <input type="submit">
        </form>
        <hr>
        <p>
            <?= (isset($result)) ? $result : "" ?>
        </p>
    </body>
</html>