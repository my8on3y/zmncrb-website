-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 18 2018 г., 12:30
-- Версия сервера: 5.7.19
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zmncrb_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `wp_tt_doctors`
--

CREATE TABLE `wp_tt_doctors` (
  `id` int(3) NOT NULL,
  `last_name` varchar(18) NOT NULL,
  `name` varchar(18) NOT NULL,
  `patronymic` varchar(18) NOT NULL,
  `specialty` varchar(24) NOT NULL,
  `profile` varchar(30) DEFAULT NULL,
  `cabinet` int(3) NOT NULL DEFAULT '0',
  `time_table` json DEFAULT NULL,
  `tt_disabled` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Значение "нет приёма"',
  `photo_url` varchar(160) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `wp_tt_doctors`
--

INSERT INTO `wp_tt_doctors` (`id`, `last_name`, `name`, `patronymic`, `specialty`, `profile`, `cabinet`, `time_table`, `tt_disabled`, `photo_url`) VALUES
(1, 'Иванов', 'Николай', 'Владимирович', 'Терапевт', NULL, 0, '[{\"end_hour\": \"3\", \"end_minute\": \"4\", \"start_hour\": \"1\", \"start_minute\": \"2\"}, {\"end_hour\": \"5\", \"end_minute\": \"1\", \"start_hour\": \"5\", \"start_minute\": \"6\"}, {\"end_hour\": \"5\", \"end_minute\": \"4\", \"start_hour\": \"2\", \"start_minute\": \"3\"}, {\"end_hour\": \"3\", \"end_minute\": \"5\", \"start_hour\": \"4\", \"start_minute\": \"2\"}, {\"end_hour\": \"3\", \"end_minute\": \"5\", \"start_hour\": \"1\", \"start_minute\": \"2\"}]', 0, NULL),
(2, 'Курпатов', 'Валерий', 'Рыцаревич', 'Терапевт', NULL, 0, NULL, 0, NULL),
(19, 'Николай', 'Разимович', 'Шульц', 'Терапевт', NULL, 0, NULL, 0, NULL),
(20, 'Волков', 'Чумачай', 'Никакой', 'Терапевт', NULL, 0, NULL, 0, NULL),
(21, 'Вьетнамов', 'Мазафакович', 'Чачкчакун', 'Педиатр', NULL, 0, NULL, 0, NULL),
(22, 'Иванов', 'Иван', 'Вольфович', 'Окулист', NULL, 0, NULL, 0, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `wp_tt_doctors`
--
ALTER TABLE `wp_tt_doctors`
  ADD UNIQUE KEY `unique id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `wp_tt_doctors`
--
ALTER TABLE `wp_tt_doctors`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
