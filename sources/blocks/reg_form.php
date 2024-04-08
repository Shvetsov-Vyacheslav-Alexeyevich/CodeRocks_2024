<form id="reg_form" class="form_window" action="<?php $_SERVER["DOCUMENT_ROOT"]?>server/server.php" method="POST">
  <div class="inner_container">
    <div class="inner">
      <button class="form_close">
        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
        </svg>
      </button>
      <h3 class="form_heading">Регистрация</h3>
      <div class="radio_block">
        <div class="var">Покупатель</div>
        <label class="switch">
          <input id="user_type" class="switch_input" type="checkbox" name="user_type">
          <span class="switch_slider"></span>
        </label> 
        <div class="var">Производитель</div>
      </div>
      <div class="inputs">
        <div class="double">
          <input id="second_name" type="text" name="second_name" placeholder="Фамилия" required>
          <input id="first_name" type="text" name="first_name" placeholder="Имя" required>
        </div>
        <input id="third_name" type="text" name="third_name" placeholder="Отчество" required>
        <input id="email" type="text" name="email" placeholder="E-mail" required>
        <div class="double">
          <input id="password" type="password" name="password" placeholder="Пароль" required>
          <input id="first_name" type="password" name="first_name" placeholder="Повтор пароля" required>
        </div>
      </div>
      <button class="submit" type="submit">Зарегистрироваться</button>
      <a class="additional_link">У вас уже есть аккаунт?</a>
    </div>
  </div>
</form>