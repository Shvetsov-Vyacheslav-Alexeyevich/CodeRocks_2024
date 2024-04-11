<?
  session_start();
  require_once("functions.php");
  require_once("db_model.php");

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
      $errors = [];
      
      // Таблица продукта
      $product_photo = $_FILES['picture'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_vendor = $_SESSION['user']['vendor_id'];
      $product_category = $_POST['product_category'];
      $product_description = $_POST['product_description'];
      // Товар скрыт или нет
      $product_access = (isset($_POST['open_access'])) ? 1 : 0;

      // Таблица характеристик продукта
      $product_weight = $_POST['product_weight'];
      $product_length = $_POST['product_length'];
      $product_width = $_POST['product_width'];
      $product_height = $_POST['product_height'];

      var_dump(json_decode($_POST['stocks']));

      //----------------------
      $product_storage_warehouse = $_POST['storage_warehouse'];
      $product_quantity = $_POST['product_quantity'];
        
      if (!empty($product_name) && !empty($product_price) && !empty($product_weight) && !empty($product_length) && !empty($product_width) && !empty($product_height) && !empty($product_category) && !empty($product_description))
      {
        //--------------------------------------------------------------------------------------------------------//
        // Проверка на фото
        if (empty($_FILES)) { $errors[] = 'Вы не добавили ни одной фотографии товара.'; }

        // Проверка на название
        if (mb_strlen($product_name) > 100) { $errors[] = 'Название должно быть менше или равно 100 символам.'; }

        // Проверка на цену
        if (!is_numeric($product_price)) { $errors[] = 'Цена указывается только в числовом формате.'; }
        if ($product_price <= 0) { $errors[] = 'Цена должна быть больше 0.'; }
        if ($product_price >= 100000) { $errors[] = 'Цена должна быть меньше 100 тысяч.'; }

        // Проверка на категорию
        if ($product_category == 0) { $errors[] = 'Вы не выбрали категорию продукта.';}

        // Проверка на вес
        if (!is_numeric($product_weight)) { $errors[] = 'Вес указывается только в числовом формате.'; }
        if ($product_weight <= 0) { $errors[] = 'Вес должен быть больше 0.'; }
        if ($product_weight > 1000) { $errors[] = 'Вес должен быть не больше 1 тонны.'; }

        // Проверка на длину
        if (!is_numeric($product_length)) { $errors[] = 'Длина указывается только в числовом формате.'; }
        if ($product_length <= 0) { $errors[] = 'Длина должна быть больше 0.'; }

        // Проверка на ширину
        if (!is_numeric($product_width)) { $errors[] = 'Ширина указывается только в числовом формате.'; }
        if ($product_width <= 0) { $errors[] = 'Ширина должна быть больше 0.'; }

        // Проверка на высоту
        if (!is_numeric($product_height)) { $errors[] = 'Высота указывается только в числовом формате.'; }
        if ($product_height <= 0) { $errors[] = 'Ширина должна быть больше 0.'; }

        // Проверка на описание
        if (mb_strlen($product_description) > 1024) { $errors[] = 'Описание продукта не должно быть больше 1024 символов.'; }
        //--------------------------------------------------------------------------------------------------------//
        
        if (empty($errors))
        {
          $arr = [];
          $db = new MysqlModel;

          // Добавление продукта
          $arr = $db->query("
            INSERT INTO PRODUCTS(
              name,
              description,
              price,
              category_id,
              vendor_id,
              is_hidden
            )
            VALUES (
              '$product_name',
              '$product_description',
               $product_price,
               $product_category,
               $product_vendor,
               $product_access
            )
          ");

          // Поиск добавленного продукта в БД
          $arr = $db->goResultOnce("
            SELECT
              *
            FROM
              PRODUCTS
            WHERE
              name = '$product_name' AND
              description = '$product_description' AND
              price = $product_price AND
              category_id = $product_category AND
              vendor_id = $product_vendor AND
              is_hidden = $product_access
          ");

          $product_id = $arr['id'];
          
          // Добавление характеристик продукта
          $arr = $db->query("
            INSERT INTO PRODUCT_CHARACTERISTICS (
              product_id,
              weight,
              length,
              width,
              height
            )
            VALUES (
              $product_id,
              $product_weight,
              $product_length,
              $product_width,
              $product_height
            )
          ");

          $result = add_photos($_FILES['picture'], $product_id);

          if ($result !== true)
          {
            $arr = $db->query("
              DELETE
              FROM
                PRODUCTS
              WHERE
                id = $product_id
            ");
          }

          echo 'Ваш товар был успешно добавлен в каталог товаров.';

          // Проверки добавления на склад в определённом кол-ве
          if ($product_storage_warehouse != 0 && $product_quantity > 0)
          {
            $arr = $db->query("
              INSERT INTO PRODUCTS_COUNT (
                count,
                product_id,
                store_id
              )
              VALUES (
                $product_quantity,
                $product_id,
                $product_storage_warehouse
              )
            ");
          }
        }
      } else { $errors[] = 'Не все поля заполнены.'; }

      echo json_encode(["status" => true, "response" => $_POST]);
    }
  }
?>