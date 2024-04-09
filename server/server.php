<?
  session_start();
  require_once("functions.php");

  if (!empty($_POST))
  {
>>>>>>> b9d74db7a4d526cbaba4a42e1b41bd5675cb7518
    if ($_POST["form_type"] == "registration")
    {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $repeat_password = $_POST['repeat_password'];
      $is_vendor = $_POST['is_vendor'];

      if (!$is_vendor)
        $array = [$_POST['firstname'], $_POST['name'], $_POST['surname']];
      else
        $array = [$_POST['company_name']];

      $result = registration($email, $password, $repeat_password, $is_vendor, $array);

      if (is_string($result))
        echo json_encode(["status" => false]);
      else
        echo json_encode(["status" => true]);

      exit;
    }
    else if ($_POST["form_type"] == "login")
    {
      if (!empty($_POST['email']) and !empty($_POST['password']))
      {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $result = authorization($email, $password);
        if (!empty($result))
        {
          $_SESSION['user'] = found_user($email);
          echo json_encode(["status" => true]);
          exit;
        }
        else
          echo json_encode(["status" => false]);
      }
    }
    else if ($_POST["form_type"] == "recovery_get")
      echo json_encode(["status" => true]);
    else if ($_POST["form_type"] == "recovery_change")
      echo json_encode(["status" => true, "body" => $_POST]);
  }
?>