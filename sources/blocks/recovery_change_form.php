<form id="form_recovery_change" class="form_wrapper" action="/server/server.php" method="POST">
  <div class="inner">
    <h1 class="form_heading">Восстановление</h1>
    <p class="text">Измените свой пароль.</p>
    <div class="line"></div>
    <div class="inputs">
      <? if (!empty($_GET['token'])): ?>
        <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
      <? endif ?>
      <input id="password" type="password" name="password" placeholder="Новый пароль" required>
      <input id="next_password" type="password" name="next_password" placeholder="Повтор пароля" required>
    </div>
    <button class="submit" type="submit">Отправить</button>
  </div>
</form>