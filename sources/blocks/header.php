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
              <a href="/index.php" class="logo">
                <img src="/sources/images/logo.svg" alt="BLITZ">
              </a>
            </div>
            <div class="right">
              <div class="icon">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10 10C12.7625 10 15 7.75625 15 5C15 2.2375 12.7625 0 10 0C7.2375 0 5 2.2375 5 5C5 7.75625 7.2375 10 10 10ZM10 12.5C6.66875 12.5 0 14.1687 0 17.5V20H20V17.5C20 14.1687 13.3313 12.5 10 12.5Z" fill="#F36767"/>
                </svg>
              </div>
              <a class="block" href="/pages/authorization.php?form=log">Войти</a>
              <div class="line"></div>
              <a class="block" href="/pages/authorization.php?form=reg">Зарегистрироваться</a>
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