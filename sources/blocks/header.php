<?
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
            } else {
          ?>
          <!-- Для всех других страниц -->
          <div class="wrapper">
            <div class="left">
              <a href="/index.php" class="logo block">
                <img src="/sources/images/logo.svg" alt="BLITZ">
              </a>
            </div>
            <div class="right">
              <? if (empty($_SESSION)): ?>
                <div class="icon">
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 10C12.7625 10 15 7.75625 15 5C15 2.2375 12.7625 0 10 0C7.2375 0 5 2.2375 5 5C5 7.75625 7.2375 10 10 10ZM10 12.5C6.66875 12.5 0 14.1687 0 17.5V20H20V17.5C20 14.1687 13.3313 12.5 10 12.5Z" fill="#F36767"/>
                  </svg>
                </div>
                <a class="block" href="/pages/authorization.php?form=log">Войти</a>
                <div class="line"></div>
                <a class="block" href="/pages/authorization.php?form=reg">Зарегистрироваться</a>
              <? else: ?>
                <div class="exit_submit">
                  <div class="icon">
                    <svg width="10" height="13" viewBox="0 0 10 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6.58385 2.4186C7.26708 2.4186 7.82609 1.87442 7.82609 1.2093C7.82609 0.544186 7.26708 0 6.58385 0C5.90062 0 5.34162 0.544186 5.34162 1.2093C5.34162 1.87442 5.90062 2.4186 6.58385 2.4186ZM4.34783 10.8233L4.93789 8.16279L6.27329 9.37209V13H7.51553V8.43488L6.24224 7.19535L6.61491 5.38139C7.42236 6.34884 8.63354 6.95349 10 6.95349V5.74419C8.85093 5.74419 7.85714 5.13953 7.29814 4.26279L6.70807 3.29535C6.49068 2.93256 6.08696 2.72093 5.65217 2.72093C5.49689 2.72093 5.34162 2.75116 5.18634 2.81163L1.92547 4.11163V6.95349H3.1677V4.92791L4.25466 4.50465L3.29193 9.37209L0.248447 8.79767L0 9.97674C0 9.97674 4.34783 10.793 4.34783 10.8233Z" fill="white"/>
                    </svg>
                  </div>
                  <form method="POST" action="">
                      <input type="hidden" name="exit" value="true">
                      <input type="submit" value="Выйти">
                  </form>
                </div>
                <div class="link_profile">
                    <!-- !!! сделать переход к профолио + фото из бд !!! -->
                    <a href="#" class="block" style="box-shadow: 0px 0px 4px 0px rgba(0, 0, 0, 0.25); border-radius: 4px; background: url(/sources/images/photo.png) no-repeat center/cover; width: 50px; height: 50px;">
                      <!-- <img src="sources/images/photo.png" width="50px" height="50px" alt="такой карины нету"> -->
                    </a>
                </div>
              <? endif ?>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </header>
    <main id="main">
      <div class="container">
        <div class="inner">
          <!-- Контент -->
          <div class="modal_wrapper"></div>