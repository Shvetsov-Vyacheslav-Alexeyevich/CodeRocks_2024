<?php
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

  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/header.php");
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/products.php");
  require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/footer.php");
?>
