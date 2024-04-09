<form id="form_login" class="form_wrapper" action="/server/server.php" method="POST">
  <div class="inner">
    <a class="link_undo" href="/index.php">
      <svg width="28" height="12" viewBox="0 0 28 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M14 1.33333C10.4733 1.33333 7.26 2.64667 4.8 4.8L0 0V12H12L7.18 7.18C9.02667 5.62667 11.3933 4.66667 14 4.66667C18.7267 4.66667 22.7267 7.74 24.1267 12L27.28 10.96C25.4467 5.37333 20.2 1.33333 14 1.33333Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Авторизация</h1>
    <a href="/pages/authorization.php?form=reg" class="text_link">нет аккаунта?</a>
    <div class="line"></div>
    <div class="inputs">
      <input id="login" type="email" name="login" placeholder="Логин" required>
      <input id="password" type="password" name="password" placeholder="Пароль" required>
    </div>
    <button class="submit" type="submit">Войти</button>
    <a href="/pages/recovery.php" class="text_link">Забыли пароль?</a>
  </div>
</form>