<?
    require_once("db_model.php");
    
    $user = [];
    $db = new MysqlModel;

    $user = $db->goResultOnce("
        SELECT
            *
        FROM
            USER_CLIENTS
        WHERE
            id = $_GET[id]
    ");

    $errors = [];
    $user_firstname = $user['firstname'];
    $user_name = $user['name'];
    $user_surname = $user['surname'];
    
    // --------------------------------------
    var_dump( $_POST ); echo'<br>';
    var_dump( $_GET ); echo'<br>';
    var_dump( $user ); echo'<br>';
    var_dump( $user['id'] ); echo'<br>';
    // --------------------------------------

    if (!empty($_POST))
    {
        if (!empty($user_firstname) && !empty($user_name))
        {
            if (mb_strlen($user_firstname) > 50) { $errors[] = 'Имя пользователя должно быть меньше или равно 50 символам.'; }
            if (mb_strlen($user_name) > 50) { $errors[] = 'Имя пользователя должно быть меньше или равно 50 символам.'; }
            if (mb_strlen($user_surname) > 50) { $errors[] = 'Имя пользователя должно быть меньше или равно 50 символам.'; }

            if (empty($errors))
            {
                $user_firstname = $_POST['user_firstname'];
                $user_name = $_POST['user_name'];
                $user_surname = $_POST['user_surname'];

                $arr = [];
                $db = new MysqlModel;

                $arr = $db->query("
                    UPDATE
                        USER_CLIENTS
                    SET
                        firstname = '$user_firstname',
                        name = '$user_name',
                        surname = '$user_surname'
                    WHERE
                        id = $_GET[id]
                ");

                echo 'ФИО было успешно изменено.';
            }
        } else { $errors[] = 'Не все главные поля были заполнены.'; }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Редактировать ФИО пользователя</title>
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

        <form method="POST" action="" style="display: flex; flex-direction: column; width: 300px">
            <input type="text" name="user_firstname" placeholder="Фамилия">
            <input type="text" name="user_name" placeholder="Имя">
            <input type="text" name="user_surname" placeholder="Отчество">
            <input type="submit">
        </form>
        <hr>
        <pre>
            <? var_dump($_POST)?>
        </pre>
    </body>
</html>