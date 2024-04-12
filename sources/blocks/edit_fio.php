
  <!-- session_start();
  require_once($_SERVER['DOCUMENT_ROOT'] . "/server/db_model.php");

  var_dump($_POST);
  // var_dump($_SESSION['user']['client_id']);

  if(!empty($_POST))
  {
    var_dump($_POST);

    $errors = [];
    // $user_id = $_SESSION['user']['client_id'];
    $user_firstname = $_POST['user_firstname'];
    $user_name = $_POST['user_name'];
    $user_surname = $_POST['user_surname'];
  
    var_dump($user_id);
    var_dump($user_firstname);
    var_dump($user_name);
    var_dump($user_surname);
  
    if (!empty($user_firstname) && !(empty($user_name)))
    {
      // Проверка на длинну
      if (mb_strlen($user_firstname) > 50) { $errors[] = 'Ваша фамилия должна быть меньше или равна 50 символам.'; }
      if (mb_strlen($user_name) > 50) { $errors[] = 'Ваше имя должно быть меньше или равно 50 символам.'; }
      if (mb_strlen($user_firstname) > 50) { $errors[] = 'Ваше отчество должно быть меньше или равно 50 символам.'; }
  
      if (empty($errors))
      {
        $arr = [];
        $db = new MysqlModel;
  
        $arr = $db->query ("
          UPDATE
            USER_CLIENTS
          SET
            firstname = '$user_firstname',
            name = '$user_name',
            surname = '$user_surname'
          WHERE
            user_id = 1
        ");
        echo "Ваше ФИО обновлено";
      }
    }
  } -->

<form id="form_edit_fio" class="form_wrapper modal" action="" POST="POST" enctype="multipart/form-data">
  <div class="inner">
    <a class="link_undo" onclick="hideModalWrapper()">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path class="change" d="M12 1.21286L10.7871 0L6 4.78714L1.21286 0L0 1.21286L4.78714 6L0 10.7871L1.21286 12L6 7.21286L10.7871 12L12 10.7871L7.21286 6L12 1.21286Z" fill="#A5A5A5"/>
      </svg>
    </a>
    <h1 class="form_heading">Редактировать</h1>
    <div class="text_description">Изменить ФИО пользователя</div>
    <div class="inputs">
      <div class="line"></div>
			<div class="double">
				<div class="left">
					<input id="surname" class="" type="text" name="user_firstname" placeholder="Фамилия" required>
				</div>
				<div class="right">
					<input id="first_name" class="" type="text" name="user_name" placeholder="Имя" required>
				</div>
			</div>
      <input id="last_name" class="" type="text" name="user_surname" placeholder="Отчество" required>
      <button class="submit" type="submit">Отправить</button>
    </div>
</form>