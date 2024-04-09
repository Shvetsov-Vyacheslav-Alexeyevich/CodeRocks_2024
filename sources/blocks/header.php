<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blitz - то, что вам сейчас нужно!</title>
    <link rel="stylesheet" type="text/css" href="/sources/styles/style.css">
  </head>
  <body>
    <header id="header">
      <div class="container">
        <div class="inner">
          <!-- Хедер -->
          <?php
            if (basename($_SERVER['PHP_SELF']) == "authorization.php" or basename($_SERVER['PHP_SELF']) == "recovery.php") {
          ?>
          <!-- Для authorization.php -->
              <a class="logo" href="/index.php">
                <img src="/sources/images/logo.svg" alt="BLITZ">
              </a>
          <?php
            }
          ?>
        </div>
      </div>
    </header>
    <main id="main">
      <div class="container">
        <div class="inner">
          <!-- Контент -->