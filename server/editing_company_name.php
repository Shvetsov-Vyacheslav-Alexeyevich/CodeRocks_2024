<?
    require_once("db_model.php");
    
    $company = [];
    $db = new MysqlModel;

    $company = $db->goResultOnce("
        SELECT
            *
        FROM
            USER_VENDORS
        WHERE
            id = $_GET[id]
    ");

    $errors = [];
    $company_name = $company['company_name'];
    
    // --------------------------------------
    var_dump( $_POST ); echo'<br>';
    var_dump( $_GET ); echo'<br>';
    var_dump( $company ); echo'<br>';
    var_dump( $company['id'] ); echo'<br>';
    // --------------------------------------

    if (!empty($_POST))
    {
        if (!empty($company_name))
        {
            if (mb_strlen($company_name) > 100) { $errors[] = 'Название компании должно быть меньше или равно 100 символам.'; }

            if (empty($errors))
            {
                $company_name = $_POST['company_name'];

                $arr = [];
                $db = new MysqlModel;

                $arr = $db->query("
                    UPDATE
                        USER_VENDORS
                    SET
                        company_name = '$company_name'
                    WHERE
                        id = $_GET[id]
                ");

                echo 'Название компании было изменено.';
            }
        } else { $errors[] = 'Поле названия не заполнено.'; }
    }
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Редактировать название компании</title>
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
            <input type="text" name="company_name" placeholder="Название">
            <input type="submit">
        </form>
        <hr>
        <pre>
            <? var_dump($_POST)?>
        </pre>
    </body>
</html>