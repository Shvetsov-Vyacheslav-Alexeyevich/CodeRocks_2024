<?
    session_start();
    require_once("functions.php");

    if (!empty($_FILES))
    {
        $sus = add_photos($_FILES['picture'], 13);

        header("Refresh: 0");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form enctype="multipart/form-data" method="POST" action="">
            <input name="MAX_FILE_SIZE" type="hidden" value="10485760">
            <input name="picture[]" type="file" accept="image/png, image/jpeg" multiple>
            <input name="sus" type="text">
            <input type="submit">
        </form>
        <pre>
            Сессия:
            <? var_dump($_SESSION) ?>
            <hr>
            <?
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

            function findPaths($graph, $start, $end, $path = [])
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
                        $newPaths = findPaths($graph, $next, $end, $path); // Рекурсивно ищем пути из следующей точки
                        foreach ($newPaths as $newPath)
                        {
                            $paths[] = $newPath; // Добавляем найденные пути к списку путей
                        }
                    }
                }
            
                return $paths; // Возвращаем все найденные пути
            }
            

            $graph = [];

            foreach ($result as $graph_elem)
            {
                $first_point = $graph_elem['first_point'];
                $second_point = $graph_elem['second_point'];

                if (!isset($graph[$first_point]))
                {
                    $graph[$first_point] = [];
                }

                if (!isset($graph[$second_point]))
                {
                    $graph[$second_point] = [];
                }

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

            // Пример графа, представляющего маршруты между городами
            // $graph = [
            //     'Новосибирск' => ['Кемерово'],
            //     'Кемерово' => ['Новосибирск', 'Мариинск', 'Ленинск-Кузнецкий'],
            //     'Мариинск' => ['Кемерово', 'Ленинск-Кузнецкий'],
            //     'Ленинск-Кузнецкий' => ['Кемерово', 'Мариинск', 'Полысаево'],
            //     'Полысаево' => ['Ленинск-Кузнецкий', 'Белово'],
            //     'Белово' => ['Полысаево', 'Киселёвск'],
            //     'Киселёвск' => ['Белово', 'Прокопьевск'],
            //     'Прокопьевск' => ['Киселёвск', 'Новокузнецк'],
            //     'Новокузнецк' => ['Прокопьевск', 'Междуреченск'],
            //     'Междуреченск' => ['Новокузнецк']
            // ];
            
            echo "<hr>";
            var_dump($graph);

            $start = 'Кемерово'; // Начальная точка
            $end = 'Белово'; // Конечная точка
            
            // Поиск всех путей между начальной и конечной точками
            $paths = findPaths($graph, $start, $end);

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

                foreach ($route as $road)
                {
                    $routes[$key]['time'] += $road['time'];
                    $routes[$key]['distance'] += $road['distance'];
                }
            }

            echo "<hr>";
            var_dump($routes);
            
            // Вывод найденных путей
            foreach ($paths as $path) {
                echo implode(' -> ', $path) . "\n";
            }
            ?>
        </pre>
    </body>
</html>