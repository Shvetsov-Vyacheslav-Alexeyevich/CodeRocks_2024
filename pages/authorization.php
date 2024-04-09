<?php
  if (basename($_SERVER['PHP_SELF']) == "authorization.php" or basename($_SERVER['PHP_SELF']) == "recovery.php") {
?>
<!-- Для authorization.php -->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Blitz - то, что вам сейчас нужно!</title>
        <link rel="stylesheet" type="text/css" href="/sources/styles/style.css">
    </head>
    <a class="logo" href="/index.php">
      <img src="/sources/images/logo.svg" alt="BLITZ">
    </a>
<?php
  }
  if (!empty($_GET) and $_GET["form"] == "log") {
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/log_form.php");
  } else {
    require($_SERVER["DOCUMENT_ROOT"] . "/sources/blocks/reg_form.php");
  }
?>