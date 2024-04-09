<?
  session_start();

  if (!empty($_POST))
  {
    if (!empty($_POST['exit']))
    {
      $_SESSION = [];
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
    <title>Тест</title>
  </head>
  <body>
    <pre>
      $_SESSION:
      <? var_dump($_SESSION) ?>
    </pre>
    <form method="POST" action="">
      <input type="hidden" name="exit" value="true">
      <input type="submit" value="Выйти из аккаунта">
    </form>
    <hr>
    <a href="/pages/authorization.php">Регистрация/авторизация</a>
  </body>
</html>
