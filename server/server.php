<?php
  if (!empty($_POST))
  {
    if ($_POST["form_type"] == "registration")
      echo json_encode(["status" => true]);
    else if ($_POST["form_type"] == "login")
      echo json_encode(["status" => true, "user_id" => "901", "user_password" => "qwerty12Q!"]);
    else if ($_POST["form_type"] == "recovery_get")
      echo json_encode(["status" => true]);
    else if ($_POST["form_type"] == "recovery_change")
      echo json_encode(["status" => true, "body" => $_POST]);
  }
?>