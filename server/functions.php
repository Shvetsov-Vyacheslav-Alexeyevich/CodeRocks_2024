<?
    require_once("db_model.php");

    function preg_check($input, $type)
    {
        switch ($type)
        {
            case "email":
                $pattern = '/[^A-Za-z0-9\@\.\-\_]/';
                break;
            case "only_letters":
                $pattern = '/[^АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдеёжзийклмнопрстуфхцчшщъыьэюяA-Za-z\-]/';
                break;
            case "password";
                $pattern = '/[А-Яа-я]/';
                break;
        }

        return preg_match($pattern, $input);
    }

    function registration($email, $password, $repeat_password, $is_vendor, $array)
    {
        if (preg_check($email, "email") == 1)
            return 'cyrillic_email';

        if ($password != $repeat_password)
            return "does_not_repeat";

        if (preg_check($password, "password") == 1)
            return 'cyrillic';

        $userdata = found_user($email);

        if (!empty($userdata))
            return 'profile_is_exist';

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $arr = [];
        $db = new MysqlModel();
        $arr = $db->query("
            INSERT INTO USERS(
                email,
                password_hash,
                is_vendor
            )
            VALUES(
                '$email',
                '$password_hash',
                $is_vendor
            )
        ");

        $userdata = found_user($email);

        if ($is_vendor)
        {
            $arr = $db->query("
                INSERT INTO USER_VENDORS(
                    user_id,
                    company_name
                )
                VALUES(
                    $userdata[id],
                    '$array[0]'
                )
            ");
        }
        else
        {
            if (!empty($array[2]))
                $array[2] = "'$array[2]'";

            $arr = $db->query("
                INSERT INTO USER_CLIENTS(
                    user_id,
                    firstname,
                    name,
                    surname
                )
                VALUES(
                    $userdata[id],
                    '$array[0]',
                    '$array[1]',
                    $array[2]
                )
            ");
        }

        return true;
    }

    function found_user($email)
    {
        $arr = [];
        $db = new MysqlModel();
        $arr = $db->goResultOnce("
            SELECT
                *
            FROM
                USERS
            WHERE
                email = '$email'
        ");

        if (!empty($arr))
        {
            $userdata = [];

            if ((int) $arr['is_vendor'])
            {
                $userdata = $db->goResultOnce("
                    SELECT
                        id AS 'vendor_id',
                        company_name
                    FROM
                        USER_VENDORS
                    WHERE
                        user_id = $arr[id]
                ");
            }
            else
            {
                $userdata = $db->goResultOnce("
                    SELECT
                        id AS 'client_id',
                        firstname,
                        name,
                        surname
                    FROM
                        USER_CLIENTS
                    WHERE
                        user_id = $arr[id]
                ");
            }

            if (!empty($userdata))
                $arr = array_merge($arr, $userdata);
        }

        return $arr;
    }

    function authorization($email, $password)
    {
        $arr = found_user($email);

        if (!empty($arr))
        {
            $password_hash = $arr['password_hash'];
            $verify = password_verify($password, $password_hash);

            return ($verify) ? $arr : false;
        }
        else
            return false;
    }

    function add_photos($files, $product_id)
    {
        if (!empty($files['tmp_name']))
        {
            $photos = [];
            $db = new MysqlModel();
            $photos = $db->goResult("
                SELECT
                    *
                FROM
                    PRODUCT_PHOTOS
                WHERE
                    product_id = $product_id
            ");

            if (count($photos) + count($files['name']) > 10)
                return "limit_exceeded";

            for ($i = 0; $i < count($files['name']); $i++)
            {
                if ($files['type'][$i] == 'image/png' || $files['type'][$i] == 'image/jpeg')
                {
                    $server_path = $_SERVER['DOCUMENT_ROOT'];
                    
                    $path = "$server_path/data/$product_id/";
                    $name = basename($files['name'][$i]);

                    if (!is_dir($path))
                        mkdir($path);

                    $j = 1;
                    while (true)
                    {
                        if (file_exists($path . $name))
                            $name = $j . "_" . $name;
                        else
                            break;

                        $j++;
                    }

                    move_uploaded_file($files['tmp_name'][$i], $path . $name);

                    $add = $db->query("
                        INSERT INTO PRODUCT_PHOTOS(
                            product_id,
                            photo_path
                        )
                        VALUES(
                            $product_id,
                            '$name'
                        )
                    ");
                }
                else
                {
                    return "wrong_extension";
                }
            }

            return true;
        }
        else
        {
            return null;
        }
    }

    function find_paths($graph, $start, $end, $path = [])
    {
        $path = array_merge($path, [$start]); // Добавляем текущую точку к пути
            
        if ($start == $end)
        {
            return [$path]; // Если достигли конечной точки, возвращаем найденный путь
        }
            
        $paths = []; // Здесь будем хранить все найденные пути
            
        foreach ($graph[$start] as $key => $next)
        {
            if (!in_array($next, $path))
            {
                $new_paths = find_paths($graph, $next, $end, $path); // Рекурсивно ищем пути из следующей точки
                foreach ($new_paths as $new_path)
                {
                    $paths[] = $new_path; // Добавляем найденные пути к списку путей
                }
            }
        }
            
        return $paths; // Возвращаем все найденные пути
    }

    function road_calculation($start, $end)
    {
        $db = new MysqlModel();
        $result = $db->goResult("
            SELECT
                lr.*,
                l1.name as first_point,
                l2.name as second_point
            FROM
                LOCATION_ROADS lr,
                FIRST_POINT_ROADS fpr,
                SECOND_POINT_ROADS spr,
                LOCATIONS l1,
                LOCATIONS l2
            WHERE
                l1.id = fpr.location_id
                AND l2.id = spr.location_id
                AND lr.id = fpr.road_id
                AND lr.id = spr.road_id
        ");

        $graph = [];

        foreach ($result as $graph_elem)
        {
            $first_point = $graph_elem['first_point'];
            $second_point = $graph_elem['second_point'];

            if (!isset($graph[$first_point]))
                $graph[$first_point] = [];
            if (!isset($graph[$second_point]))
                $graph[$second_point] = [];

            foreach ($result as $temp)
            {
                if
                (
                    in_array($temp['first_point'], $graph[$first_point]) ||
                    in_array($temp['first_point'], $graph[$second_point]) ||
                    in_array($temp['second_point'], $graph[$first_point]) ||
                    in_array($temp['second_point'], $graph[$second_point])
                )
                    continue;

                if ($first_point == $temp['first_point'])
                    $graph[$first_point][] = $temp['second_point'];
                if ($first_point == $temp['second_point'])
                    $graph[$first_point][] = $temp['first_point'];
                if ($second_point == $temp['first_point'])
                    $graph[$second_point][] = $temp['second_point'];
                if ($second_point == $temp['second_point'])
                    $graph[$second_point][] = $temp['first_point'];
            }
        }
            
        // Поиск всех путей между начальной и конечной точками
        $paths = find_paths($graph, $start, $end);

        $temp = [];

        foreach ($paths as $key => $path)
        {
            for ($i = 1; $i < count($path); $i++)
            {
                $last_loc = $path[$i - 1];
                $loc = $path[$i];

                foreach ($result as $string)
                {
                    if (($string['first_point'] == $last_loc && $string['second_point'] == $loc) || ($string['first_point'] == $loc && $string['second_point'] == $last_loc))
                        $temp[$key][] = $string;
                }
            }
        }

        $routes = [];

        foreach ($temp as $key => $route)
        {
            $routes[$key]['time'] = 0;
            $routes[$key]['distance'] = 0;
            $routes[$key]['delivery_cost'] = 0;
            $routes[$key]['ids'] = [];

            foreach ($route as $road)
            {
                $routes[$key]['time'] += $road['time'];
                $routes[$key]['distance'] += $road['distance'];
                $routes[$key]['ids'][] = $road['id'];
            }

            // Формула стоимости доставки: (S / 2) + (t / 10), где S - расстояние, t - время
            $routes[$key]['delivery_cost'] = (int) round(($routes[$key]['distance'] / 2) + ($routes[$key]['time'] / 10));
        }

        return $routes;
    }
?>