-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Мар 22 2026 г., 16:43
-- Версия сервера: 8.0.44
-- Версия PHP: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ip_data`
--

-- --------------------------------------------------------

--
-- Структура таблицы `computers`
--

CREATE TABLE `computers` (
  `id` int NOT NULL,
  `ip` int UNSIGNED NOT NULL COMMENT 'IPv4 как число',
  `inventory_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `owner_phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tech_support` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `software_support` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `visit_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `computers`
--

INSERT INTO `computers` (`id`, `ip`, `inventory_number`, `owner`, `owner_phone`, `tech_support`, `software_support`, `visit_date`) VALUES
(3, 2130706433, '11045', 'Игорь  ', '56-43', 'Дима - 22-22', 'Коля - 33-33', '2026-03-21 07:11:54'),
(4, 3232235787, '12334', 'Телефон ', '55-55', 'Сара', 'Элли ', '2026-03-21 06:50:04'),
(5, 3232235792, NULL, NULL, NULL, NULL, NULL, '2026-03-21 07:22:19'),
(6, 3232235815, NULL, NULL, NULL, NULL, NULL, '2026-03-21 07:36:03');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `computers`
--
ALTER TABLE `computers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `computers`
--
ALTER TABLE `computers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
