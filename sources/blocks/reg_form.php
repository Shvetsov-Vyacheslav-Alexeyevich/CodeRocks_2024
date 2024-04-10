<form id="form_registration" class="form_wrapper" action="/server/server.php" method="POST">
  <div class="inner">
    <a class="link_undo" href="/index.php">
      <svg width="28" height="12" viewBox="0 0 28 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M14 1.33333C10.4733 1.33333 7.26 2.64667 4.8 4.8L0 0V12H12L7.18 7.18C9.02667 5.62667 11.3933 4.66667 14 4.66667C18.7267 4.66667 22.7267 7.74 24.1267 12L27.28 10.96C25.4467 5.37333 20.2 1.33333 14 1.33333Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Регистрация</h1>
    <div class="line"></div>
    <div class="radio_zone">
      <div class="variant_1 active">Покупатель</div>
      <label class="switch">
        <input id="user_type" class="switch_input" type="checkbox" name="reg_type">
        <span class="switch_slider"></span>
      </label>
      <div class="variant_2">Производитель</div>
    </div>
    <div class="line"></div>
    <div class="inputs">
      <div class="double">
        <input id="second_name" type="text" name="firstname" placeholder="Фамилия" required>
        <input id="first_name" type="text" name="name" placeholder="Имя" required>
      </div>
      <input id="third_name" type="text" name="surname" placeholder="Отчество" required>
      <input id="email" type="email" name="email" placeholder="E-mail" required>
      <div class="double">
        <input id="password" type="password" name="password" placeholder="Пароль" required>
        <input id="next_password" type="password" name="repeat_password" placeholder="Повтор пароля" required>
      </div>
    </div>
    <button class="submit" type="submit">Зарегистрироваться</button>
    <a href="/pages/authorization.php?form=log" class="text_link">У вас уже есть аккаунт?</a>
  </div>
</form>