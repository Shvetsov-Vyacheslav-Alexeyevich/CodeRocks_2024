<?php
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/header.php");
  if (!empty($_GET) and $_GET["form"] == "log") {
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/log_form.php");
  } else {
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/reg_form.php");
  }
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/footer.php");
?>