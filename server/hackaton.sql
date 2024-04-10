-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2024 г., 21:40
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hackaton`
--

-- --------------------------------------------------------

--
-- Структура таблицы `DELIVERY_TYPES`
--

CREATE TABLE `DELIVERY_TYPES` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` int NOT NULL COMMENT 'Название.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Типы доставки.';

-- --------------------------------------------------------

--
-- Структура таблицы `FIRST_POINT_ROADS`
--

CREATE TABLE `FIRST_POINT_ROADS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `location_id` int NOT NULL COMMENT 'Какая точка.',
  `road_id` int NOT NULL COMMENT 'Какому маршруту принадлежит.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Начальная точка в маршруте.';

-- --------------------------------------------------------

--
-- Структура таблицы `LOCATIONS`
--

CREATE TABLE `LOCATIONS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(50) NOT NULL COMMENT 'Название.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Города.';

--
-- Дамп данных таблицы `LOCATIONS`
--

INSERT INTO `LOCATIONS` (`id`, `name`) VALUES
(1, 'Кемерово'),
(2, 'Ленинск-Кузнецкий'),
(3, 'Новокузнецк'),
(4, 'Прокопьевск'),
(5, 'Междуреченск'),
(6, 'Белово'),
(7, 'Киселёвск'),
(8, 'Полысаево'),
(9, 'Мариинск'),
(10, 'Новосибирск');

-- --------------------------------------------------------

--
-- Структура таблицы `LOCATION_ROADS`
--

CREATE TABLE `LOCATION_ROADS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `cost` decimal(7,2) NOT NULL COMMENT 'Стоимость маршрута.',
  `time` int NOT NULL COMMENT 'Время маршрута в секундах.',
  `vendor_id` int NOT NULL COMMENT 'Кому принадлежит маршрут.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Маршруты.';

-- --------------------------------------------------------

--
-- Структура таблицы `ORDERS`
--

CREATE TABLE `ORDERS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `client_id` int NOT NULL COMMENT 'Кому принадлежит.',
  `point_id` int NOT NULL COMMENT 'Откуда будут забирать заказ.',
  `delivery_type_id` int NOT NULL COMMENT 'Тип доставки.',
  `status_id` int NOT NULL COMMENT 'Статус заказа.',
  `store_id` int NOT NULL COMMENT 'Откуда заказ поедет.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Заказы.';

-- --------------------------------------------------------

--
-- Структура таблицы `ORDER_PRODUCTS`
--

CREATE TABLE `ORDER_PRODUCTS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `order_id` int NOT NULL COMMENT 'К какому заказу привязан.',
  `product_id` int NOT NULL COMMENT 'Что за товар.',
  `count` int NOT NULL COMMENT 'Количество'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Заказанные товары.';

-- --------------------------------------------------------

--
-- Структура таблицы `ORDER_STATUSES`
--

CREATE TABLE `ORDER_STATUSES` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(50) NOT NULL COMMENT 'Название.',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата назначения статуса.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Статусы заказов.';

-- --------------------------------------------------------

--
-- Структура таблицы `PICKUP_POINTS`
--

CREATE TABLE `PICKUP_POINTS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(50) NOT NULL COMMENT 'Название ПВЗ.',
  `location_id` int NOT NULL COMMENT 'В каком городе.',
  `vendor_id` int NOT NULL COMMENT 'Кому принадлежит.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='ПВЗ.';

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCTS`
--

CREATE TABLE `PRODUCTS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(100) NOT NULL COMMENT 'Название.',
  `description` varchar(1024) NOT NULL COMMENT 'Описание.',
  `price` decimal(9,2) NOT NULL COMMENT 'Цена.',
  `photo_path` varchar(100) NOT NULL COMMENT 'Путь до фото товара.',
  `category_id` int NOT NULL COMMENT 'Категория.',
  `vendor_id` int NOT NULL COMMENT 'Кто продавец.',
  `is_hidden` tinyint(1) NOT NULL COMMENT 'Скрыто (1) или нет (0).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Товары.';

--
-- Дамп данных таблицы `PRODUCTS`
--

INSERT INTO `PRODUCTS` (`id`, `name`, `description`, `price`, `photo_path`, `category_id`, `vendor_id`, `is_hidden`) VALUES
(22, 'Жопаz', 'sususu', '3.00', '', 1, 1, 0),
(23, 'Марихуанна', 'Шикарная', '5.00', 'Screenshot_5.png', 12, 1, 1),
(24, 'Помидоры', 'Шикарная', '5.00', '', 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCTS_COUNT`
--

CREATE TABLE `PRODUCTS_COUNT` (
  `id` int NOT NULL COMMENT 'Айди.',
  `count` int NOT NULL COMMENT 'Количество.',
  `product_id` int NOT NULL COMMENT 'Какого товара.',
  `store_id` int NOT NULL COMMENT 'На каком складе.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Количество товара на складе.';

--
-- Дамп данных таблицы `PRODUCTS_COUNT`
--

INSERT INTO `PRODUCTS_COUNT` (`id`, `count`, `product_id`, `store_id`) VALUES
(1, 160, 24, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT_CATEGORIES`
--

CREATE TABLE `PRODUCT_CATEGORIES` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(100) NOT NULL COMMENT 'Название.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Категории товаров.';

--
-- Дамп данных таблицы `PRODUCT_CATEGORIES`
--

INSERT INTO `PRODUCT_CATEGORIES` (`id`, `name`) VALUES
(1, 'Верхняя одежда'),
(2, 'Одежда'),
(3, 'Обувь'),
(4, 'Аксессуары для одежды'),
(5, 'Сумки и рюкзаки'),
(6, 'Досуг и творчество'),
(7, 'Канцелярия'),
(8, 'Игрушки'),
(9, 'Книги'),
(10, 'Спорт'),
(11, 'Зоотовары'),
(12, 'Продукты'),
(13, 'Косметика'),
(14, 'Парфюмерия'),
(15, 'Уход за кожей'),
(16, 'Аксессуары'),
(17, 'Ювелирные изделия'),
(18, 'Электроника'),
(19, 'Бытовая техника'),
(20, 'Ремонт'),
(21, 'Мебель'),
(22, 'Освещение'),
(23, 'Аксессуары для дома'),
(24, 'Ванная'),
(25, 'Кухня'),
(26, 'Спальня'),
(27, 'Гостиная'),
(28, 'Детская');

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT_CHARACTERISTICS`
--

CREATE TABLE `PRODUCT_CHARACTERISTICS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `product_id` int NOT NULL COMMENT 'Какому товару принадлежит характеристика.',
  `weight` decimal(7,3) NOT NULL COMMENT 'Вес (кг)',
  `length` int NOT NULL COMMENT 'Длина (мм)',
  `width` int NOT NULL COMMENT 'Ширина (мм)',
  `height` int NOT NULL COMMENT 'Высота (мм)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Характеристики товара.';

--
-- Дамп данных таблицы `PRODUCT_CHARACTERISTICS`
--

INSERT INTO `PRODUCT_CHARACTERISTICS` (`id`, `product_id`, `weight`, `length`, `width`, `height`) VALUES
(2, 22, '0.001', 3, 1, 1),
(3, 23, '0.001', 1, 1, 1),
(4, 24, '0.001', 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT_ROUTES`
--

CREATE TABLE `PRODUCT_ROUTES` (
  `id` int NOT NULL COMMENT 'Айди.',
  `product_id` int NOT NULL COMMENT 'Какой товар.',
  `order_id` int NOT NULL COMMENT 'По какому заказу.',
  `location_id` int NOT NULL COMMENT 'Куда направляется.',
  `status_id` int NOT NULL COMMENT 'Статус маршрута.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Маршруты товаров.';

-- --------------------------------------------------------

--
-- Структура таблицы `PRODUCT_STATUSES`
--

CREATE TABLE `PRODUCT_STATUSES` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(50) NOT NULL COMMENT 'Название.',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата назначения статуса.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Статусы маршрутов товара.';

-- --------------------------------------------------------

--
-- Структура таблицы `SECOND_POINT_ROADS`
--

CREATE TABLE `SECOND_POINT_ROADS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `location_id` int NOT NULL COMMENT 'Какая точка.',
  `road_id` int NOT NULL COMMENT 'Какому маршруту принадлежит.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Конечная точка в маршруте.';

-- --------------------------------------------------------

--
-- Структура таблицы `STORES`
--

CREATE TABLE `STORES` (
  `id` int NOT NULL COMMENT 'Айди.',
  `name` varchar(50) NOT NULL COMMENT 'Название склада.',
  `location_id` int NOT NULL COMMENT 'В каком городе.',
  `vendor_id` int NOT NULL COMMENT 'Кому принадлежит.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Склады.';

--
-- Дамп данных таблицы `STORES`
--

INSERT INTO `STORES` (`id`, `name`, `location_id`, `vendor_id`) VALUES
(1, 'Кемеровский склад, ул. Ленина 45', 1, 2),
(2, 'Южный склад, ул. Звёздная 99', 8, 2),
(3, 'Пердаплюево склад, ул Какашкина 11', 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `USERS`
--

CREATE TABLE `USERS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `email` varchar(50) NOT NULL COMMENT 'Эл. почта.',
  `password_hash` varchar(60) NOT NULL COMMENT 'Пароль в виде хэша.',
  `photo_path` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Путь до аватара юзера.',
  `is_vendor` tinyint(1) NOT NULL COMMENT 'Продавец (1) или нет (0).'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Общая таблица пользователей.';

--
-- Дамп данных таблицы `USERS`
--

INSERT INTO `USERS` (`id`, `email`, `password_hash`, `photo_path`, `is_vendor`) VALUES
(1, 'chernykhin45@gmail.com', '$2y$10$VYpQVT8.LxA1LoZlO8eXEun1DSAbpJTkfQAgp50WZixFSLWTVwBj2', NULL, 0),
(2, 'molow@inbox.ru', '$2y$10$/bswI5F04zH3RFWaho7e0.d/kBAbTCNVzaFI9hYxC6CMYEgV3802.', NULL, 1),
(3, 'omg@mail.ru', '$2y$10$stT6sJxqaFCNKklLtuEKU.Iug9RazSOduXn6QYp6YFEjSIwBNs.l2', NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `USER_CLIENTS`
--

CREATE TABLE `USER_CLIENTS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `user_id` int NOT NULL COMMENT 'К какому юзеру привязан.',
  `firstname` varchar(50) NOT NULL COMMENT 'Фамилия.',
  `name` varchar(50) NOT NULL COMMENT 'Имя.',
  `surname` varchar(50) DEFAULT NULL COMMENT 'Отчество.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Покупатели.';

--
-- Дамп данных таблицы `USER_CLIENTS`
--

INSERT INTO `USER_CLIENTS` (`id`, `user_id`, `firstname`, `name`, `surname`) VALUES
(1, 1, 'Черных', 'Игорь', 'Олегович');

-- --------------------------------------------------------

--
-- Структура таблицы `USER_VENDORS`
--

CREATE TABLE `USER_VENDORS` (
  `id` int NOT NULL COMMENT 'Айди.',
  `user_id` int NOT NULL COMMENT 'К какому юзеру привязан.',
  `company_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Название компании.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Продавцы.';

--
-- Дамп данных таблицы `USER_VENDORS`
--

INSERT INTO `USER_VENDORS` (`id`, `user_id`, `company_name`) VALUES
(1, 2, 'ООО Попчанский'),
(2, 3, 'Сочная рыба с пивом');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `DELIVERY_TYPES`
--
ALTER TABLE `DELIVERY_TYPES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `FIRST_POINT_ROADS`
--
ALTER TABLE `FIRST_POINT_ROADS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `road_id` (`road_id`);

--
-- Индексы таблицы `LOCATIONS`
--
ALTER TABLE `LOCATIONS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `LOCATION_ROADS`
--
ALTER TABLE `LOCATION_ROADS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Индексы таблицы `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `point_id` (`point_id`),
  ADD KEY `delivery_type_id` (`delivery_type_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Индексы таблицы `ORDER_PRODUCTS`
--
ALTER TABLE `ORDER_PRODUCTS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `ORDER_STATUSES`
--
ALTER TABLE `ORDER_STATUSES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `PICKUP_POINTS`
--
ALTER TABLE `PICKUP_POINTS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Индексы таблицы `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Индексы таблицы `PRODUCTS_COUNT`
--
ALTER TABLE `PRODUCTS_COUNT`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Индексы таблицы `PRODUCT_CATEGORIES`
--
ALTER TABLE `PRODUCT_CATEGORIES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `PRODUCT_CHARACTERISTICS`
--
ALTER TABLE `PRODUCT_CHARACTERISTICS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `PRODUCT_ROUTES`
--
ALTER TABLE `PRODUCT_ROUTES`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `PRODUCT_STATUSES`
--
ALTER TABLE `PRODUCT_STATUSES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `SECOND_POINT_ROADS`
--
ALTER TABLE `SECOND_POINT_ROADS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `road_id` (`road_id`);

--
-- Индексы таблицы `STORES`
--
ALTER TABLE `STORES`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Индексы таблицы `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `USER_CLIENTS`
--
ALTER TABLE `USER_CLIENTS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `USER_VENDORS`
--
ALTER TABLE `USER_VENDORS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `DELIVERY_TYPES`
--
ALTER TABLE `DELIVERY_TYPES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `FIRST_POINT_ROADS`
--
ALTER TABLE `FIRST_POINT_ROADS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `LOCATIONS`
--
ALTER TABLE `LOCATIONS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `LOCATION_ROADS`
--
ALTER TABLE `LOCATION_ROADS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `ORDER_PRODUCTS`
--
ALTER TABLE `ORDER_PRODUCTS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `ORDER_STATUSES`
--
ALTER TABLE `ORDER_STATUSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `PICKUP_POINTS`
--
ALTER TABLE `PICKUP_POINTS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `PRODUCTS_COUNT`
--
ALTER TABLE `PRODUCTS_COUNT`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `PRODUCT_CATEGORIES`
--
ALTER TABLE `PRODUCT_CATEGORIES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `PRODUCT_CHARACTERISTICS`
--
ALTER TABLE `PRODUCT_CHARACTERISTICS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `PRODUCT_ROUTES`
--
ALTER TABLE `PRODUCT_ROUTES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `PRODUCT_STATUSES`
--
ALTER TABLE `PRODUCT_STATUSES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `SECOND_POINT_ROADS`
--
ALTER TABLE `SECOND_POINT_ROADS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.';

--
-- AUTO_INCREMENT для таблицы `STORES`
--
ALTER TABLE `STORES`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `USERS`
--
ALTER TABLE `USERS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `USER_CLIENTS`
--
ALTER TABLE `USER_CLIENTS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `USER_VENDORS`
--
ALTER TABLE `USER_VENDORS`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'Айди.', AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `FIRST_POINT_ROADS`
--
ALTER TABLE `FIRST_POINT_ROADS`
  ADD CONSTRAINT `first_point_roads_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `LOCATIONS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `first_point_roads_ibfk_2` FOREIGN KEY (`road_id`) REFERENCES `LOCATION_ROADS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `LOCATION_ROADS`
--
ALTER TABLE `LOCATION_ROADS`
  ADD CONSTRAINT `location_roads_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `USER_VENDORS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `USER_CLIENTS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`point_id`) REFERENCES `PICKUP_POINTS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`delivery_type_id`) REFERENCES `DELIVERY_TYPES` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `ORDER_STATUSES` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_5` FOREIGN KEY (`store_id`) REFERENCES `STORES` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `ORDER_PRODUCTS`
--
ALTER TABLE `ORDER_PRODUCTS`
  ADD CONSTRAINT `order_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `PICKUP_POINTS`
--
ALTER TABLE `PICKUP_POINTS`
  ADD CONSTRAINT `pickup_points_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `LOCATIONS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickup_points_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `USER_VENDORS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `PRODUCTS`
--
ALTER TABLE `PRODUCTS`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `PRODUCT_CATEGORIES` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `USER_VENDORS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `PRODUCTS_COUNT`
--
ALTER TABLE `PRODUCTS_COUNT`
  ADD CONSTRAINT `products_count_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_count_ibfk_2` FOREIGN KEY (`store_id`) REFERENCES `STORES` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `PRODUCT_CHARACTERISTICS`
--
ALTER TABLE `PRODUCT_CHARACTERISTICS`
  ADD CONSTRAINT `product_characteristics_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `PRODUCT_ROUTES`
--
ALTER TABLE `PRODUCT_ROUTES`
  ADD CONSTRAINT `product_routes_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `LOCATIONS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_routes_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `ORDERS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_routes_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `PRODUCTS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_routes_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `PRODUCT_STATUSES` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `SECOND_POINT_ROADS`
--
ALTER TABLE `SECOND_POINT_ROADS`
  ADD CONSTRAINT `second_point_roads_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `LOCATIONS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `second_point_roads_ibfk_2` FOREIGN KEY (`road_id`) REFERENCES `LOCATION_ROADS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `STORES`
--
ALTER TABLE `STORES`
  ADD CONSTRAINT `stores_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `LOCATIONS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stores_ibfk_2` FOREIGN KEY (`vendor_id`) REFERENCES `USER_VENDORS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `USER_CLIENTS`
--
ALTER TABLE `USER_CLIENTS`
  ADD CONSTRAINT `user_clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `USER_VENDORS`
--
ALTER TABLE `USER_VENDORS`
  ADD CONSTRAINT `user_vendors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
