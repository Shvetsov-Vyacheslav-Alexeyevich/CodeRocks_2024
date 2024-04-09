<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blitz - то, что вам сейчас нужно!</title>
    <link rel="stylesheet" type="text/css" href="/sources/styles/style.css">
  </head>
  <body>
    
    <!-- header -->
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

            <div class="">
                <a href="index.php" class="logo"><img src="sources/images/logo.svg" width="112px" height="25px" alt="такой карины нету"></a>
            </div>

            <!-- для не авторизованного пользователя -->
            <div class="auth">
                <div class="login right">
                                                                                                                        <!-- !!! сделать к форме !!! -->
                    <img src="sources/images/login.svg" width="20px" height="20px" alt="такой карины нету" class="right"> <a href="#">Войти</a>
                </div>
                <div class="">
                    |
                </div>
                <div class="regisration left">
                    <!-- !!! сделать к форме !!! -->
                    <a href="#">Регистрация</a>
                </div>
            </div>

            <!-- для авторизованного пользователя -->
            <!-- <div class="out">
                <!-- !!! сделать к форме !!! ->
                <a href="#">
                    <div class="exit">
                        <img src="sources/images/exit.svg" width="10px" height="13px" alt="такой карины нету">Выйти
                    </div>
                </a>

                <div class="login left">
                    <!-- !!! сделать переход к профилю !!! ->
                    <a href="#"><img src="sources/images/профиль2.jpg" width="50px" height="50px" alt="такой карины нету" class="imgProfile"></a>
                </div>
            </div> -->

    </header>

    <!-- Контент -->
    <main id="main">
      <div class="container">
        <div class="inner">