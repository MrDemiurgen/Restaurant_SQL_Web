-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 14 2022 г., 12:15
-- Версия сервера: 10.5.15-MariaDB-10+deb11u1
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mrdemiurgen`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Dishes`
--

CREATE TABLE `Dishes` (
  `dishes_id_serial` int(10) UNSIGNED NOT NULL,
  `emploeer_id_serial` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `category` varchar(20) NOT NULL,
  `weight` float UNSIGNED NOT NULL,
  `cost` float NOT NULL,
  `recipe` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Dishes`
--

INSERT INTO `Dishes` (`dishes_id_serial`, `emploeer_id_serial`, `name`, `category`, `weight`, `cost`, `recipe`) VALUES
(1, 3, 'Tomato soup', 'soups', 500, 65, 'Tomat'),
(2, 4, 'Greek salad', 'salad', 450, 70, 'Tomat, cucumber, feta'),
(3, 4, 'Fried rice', 'sides', 750, 95, 'Rice'),
(4, 3, 'Fish soup', 'soups', 500, 150, 'Trout'),
(5, 3, 'Cheese sticks', 'snacks', 225, 35, 'Bread, cheese '),
(6, 4, 'French fries', 'snacks', 350, 38, 'Potato, oils'),
(7, 3, 'Gyro', 'main dishes', 700, 130, 'Meat, oils'),
(8, 4, 'Fish and chips', 'main dishes', 550, 115, 'Trout, bread, cheese '),
(9, 3, 'Vegetable soup', 'soups', 500, 80, 'Tomat, carrot'),
(10, 3, 'Pizza', 'main dishes', 750, 145, 'Tomat, sausage, cheese, feta, dough');

-- --------------------------------------------------------

--
-- Структура таблицы `Employees`
--

CREATE TABLE `Employees` (
  `employes_id_serial` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `restaurant` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Employees`
--

INSERT INTO `Employees` (`employes_id_serial`, `name`, `role`, `restaurant`, `phone_number`, `email`, `password`) VALUES
(1, 'John Johnson', 'Director', 'Leo', '2(070)575-59-75', 'grebraje-8219@yopmail.com', 'fKAO6I'),
(2, 'Martin Bennett', 'Kitchen manager', 'Leo', '6(279)246-74-61', 'breippinici-6564@yopmail.com', 'Omo5Gc'),
(3, 'Eddie Cummings', 'Chief-cooker', 'Leo', '0(132)396-04-19', 'geiseagra-6771@yopmail.com', 'YR0uLJ'),
(4, 'Arthur Haynes', 'Chief-cooker', 'Leo', '6(918)222-33-21', 'troxoicu-3503@yopmail.com', 'mhWE1E'),
(5, 'Gregory Pierce', 'Cleaner', 'Leo', '05(149)62-96-21', 'trouzedsa-5719@yopmail.com', 'dFnhNJ'),
(6, 'Paul Lane', 'Cleaner', 'Leo', '737007-11-35', 'heeuneu-2759@yopmail.com', '24u616'),
(15, 'Valera Nabok', '', '', '', 'valera123$#%Gmail.com', '123789'),
(16, 'Yaroslav', '', '', '+23452245335', 'bogus@example.org', '12345');

-- --------------------------------------------------------

--
-- Структура таблицы `Products`
--

CREATE TABLE `Products` (
  `product_id_serial` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `provider_id_serial` int(10) UNSIGNED NOT NULL,
  `number_in_storage` int(11) NOT NULL,
  `number_of_ordered` int(11) NOT NULL,
  `date_of_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `expiration_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cost` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Products`
--

INSERT INTO `Products` (`product_id_serial`, `name`, `provider_id_serial`, `number_in_storage`, `number_of_ordered`, `date_of_creation`, `expiration_date`, `cost`) VALUES
(1, 'meat', 1, 250, 50, '2022-11-16 21:59:31', '2022-11-30 19:55:24', 3),
(2, 'sausage', 5, 1100, 400, '2022-11-16 22:02:14', '2023-03-28 20:00:24', 1.75),
(3, 'trout', 3, 75, 150, '2022-11-16 22:03:13', '2022-11-22 20:02:27', 7.5),
(4, 'carrot', 2, 4320, 680, '2022-11-16 22:04:01', '2023-02-01 20:03:15', 0.5),
(5, 'cucumber', 3, 175, 1500, '2022-11-16 22:04:49', '2023-01-23 20:04:03', 0.35),
(6, 'potato', 5, 7300, 2000, '2022-11-16 22:05:33', '2023-03-30 20:04:50', 0.27),
(7, 'buckwheat', 1, 6470, 3000, '2022-11-16 22:06:34', '2023-11-16 20:05:34', 0.75),
(8, 'butter', 2, 8920, 4500, '2022-11-16 22:07:27', '2023-01-24 20:06:36', 0.3),
(9, 'cheese', 3, 750, 2250, '2022-11-16 22:08:03', '2022-11-26 20:07:29', 0.62),
(10, 'eggs', 4, 240, 800, '2022-11-16 22:08:44', '2022-11-20 20:08:08', 0.33),
(11, 'tomat', 4, 550, 50, '2022-11-16 22:12:44', '2022-11-28 20:12:23', 0.35),
(12, 'feta', 5, 240, 60, '2022-11-16 22:28:09', '2022-11-29 20:27:49', 0.82),
(13, 'rice ', 2, 1750, 150, '2022-11-16 22:29:51', '2023-04-07 20:29:20', 0.38),
(14, 'bread', 1, 910, 250, '2022-11-16 22:37:31', '2022-11-23 20:36:42', 0.2),
(15, 'oils', 5, 75, 10, '2022-11-16 22:43:53', '2023-11-29 20:42:31', 1.45),
(16, 'dough', 3, 350, 0, '2022-11-16 22:56:37', '2022-11-29 20:55:52', 0.68);

-- --------------------------------------------------------

--
-- Структура таблицы `Provider`
--

CREATE TABLE `Provider` (
  `provider_id_serial` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `firm` varchar(30) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Provider`
--

INSERT INTO `Provider` (`provider_id_serial`, `name`, `firm`, `phone_number`, `email`, `password`) VALUES
(1, 'Calvin Wells', 'Freuer Logistik', '8(762)841-51-40', 'feduddipiri-7254@yopmail.com', 'wvmyGC'),
(2, 'David Taylor', 'CC Transport', '27(68)184-27-86', 'coufreujaq-5010@yopmail.com', '6g9CVp'),
(3, 'Donald Young', 'European way', '6(05)718-80-39', 'greuyin-6086@yopmail.com', 'wGpSEn'),
(4, 'Jason Barnes', 'Argo Transport', '5(963)215-30-06', 'baboipiva-4005@yopmail.com', 'luQlYl'),
(5, 'Adam Myers', 'Ulsped Meier', '0(644)500-45-36', 'lezoxea-7238@yopmail.com', 'TSirid');

-- --------------------------------------------------------

--
-- Структура таблицы `Recipe products`
--

CREATE TABLE `Recipe products` (
  `recipe_products_id_serial` int(10) UNSIGNED NOT NULL,
  `product_id_serial` int(10) UNSIGNED NOT NULL,
  `dishes_id_serial` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `Recipe products`
--

INSERT INTO `Recipe products` (`recipe_products_id_serial`, `product_id_serial`, `dishes_id_serial`) VALUES
(1, 11, 1),
(2, 11, 2),
(3, 5, 2),
(4, 12, 2),
(5, 13, 3),
(6, 3, 4),
(7, 14, 5),
(8, 9, 5),
(9, 6, 6),
(10, 15, 6),
(11, 1, 7),
(12, 15, 7),
(13, 3, 8),
(14, 9, 8),
(15, 15, 8),
(16, 11, 9),
(17, 4, 9),
(18, 11, 10),
(19, 9, 10),
(20, 12, 10),
(21, 2, 10),
(22, 16, 10);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Dishes`
--
ALTER TABLE `Dishes`
  ADD PRIMARY KEY (`dishes_id_serial`,`emploeer_id_serial`),
  ADD KEY `emploeer_id_serial` (`emploeer_id_serial`);

--
-- Индексы таблицы `Employees`
--
ALTER TABLE `Employees`
  ADD PRIMARY KEY (`employes_id_serial`);

--
-- Индексы таблицы `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`product_id_serial`,`provider_id_serial`),
  ADD KEY `provider_id_serial` (`provider_id_serial`);

--
-- Индексы таблицы `Provider`
--
ALTER TABLE `Provider`
  ADD PRIMARY KEY (`provider_id_serial`);

--
-- Индексы таблицы `Recipe products`
--
ALTER TABLE `Recipe products`
  ADD PRIMARY KEY (`recipe_products_id_serial`,`product_id_serial`,`dishes_id_serial`),
  ADD KEY `recipe products_ibfk_1` (`product_id_serial`),
  ADD KEY `dishes_id_serial` (`dishes_id_serial`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Dishes`
--
ALTER TABLE `Dishes`
  MODIFY `dishes_id_serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `Employees`
--
ALTER TABLE `Employees`
  MODIFY `employes_id_serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `Products`
--
ALTER TABLE `Products`
  MODIFY `product_id_serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `Provider`
--
ALTER TABLE `Provider`
  MODIFY `provider_id_serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `Recipe products`
--
ALTER TABLE `Recipe products`
  MODIFY `recipe_products_id_serial` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
