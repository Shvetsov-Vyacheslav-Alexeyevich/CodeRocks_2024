<?
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/header.php");
  require_once($_SERVER['DOCUMENT_ROOT'] . "/server/db_model.php");

  if (!empty($_GET['token']))
  {
    $db = new MysqlModel;
    $query = $db->goResultOnce("SELECT * FROM USERS WHERE reset_token='{$_GET['token']}'");

    if (empty($query))
    {
      header('Location: /');
      exit;
    }
  }

  if (!empty($_GET["token"]))
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/recovery_change_form.php");
  else
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/recovery_form.php");

  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/footer.php");
?>