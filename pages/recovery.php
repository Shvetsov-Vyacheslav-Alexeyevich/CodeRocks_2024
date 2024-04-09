<?php
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/header.php");
  if (!empty($_GET) and !empty($_GET["user_id"]) and !empty($_GET["user_password"])) {
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/recovery_change_form.php");
  } else {
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/recovery_form.php");
  }
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/footer.php");
?>