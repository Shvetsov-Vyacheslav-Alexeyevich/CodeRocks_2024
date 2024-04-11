<?
  session_start();
  require_once("functions.php");

  if (!empty($_POST))
  {
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
    else if ($_POST["form_type"] == "filter_request") {
      // echo json_encode(["status" => true, "response" => $_POST]);
      if ($_POST["category"] == "1") {
        echo json_encode(["status" => true, "response" => ["2", "1", "4"]]);
      } else {
        echo json_encode(["status" => true, "response" => ["3", "2", "1", "7"]]);
      }
    }
    else if ($_POST["form_type"] == "check_paths") {
      echo json_encode(["status" => true, "response" => ["stock" => "Кемеровский склад, ул. Звёздная, 39", "path" => ["г. Кемерово, Кемеровский склад, ул. Звёздная, 39", "г. Белого", "п. Берёзовский", "г. Жопосранский, ул.Самарская, 21"], "cost_delivery" => "241", "cost_product" => "681", "total" => "3241"]]);
    }
    else if ($_POST["form_type"] == "new_order") {
      echo json_encode(["status" => true]);
    }
    else if ($_POST["form_type"] == "add_product") {
      echo json_encode(["status" => true, "response" => $_POST]);
    }
  }
?>