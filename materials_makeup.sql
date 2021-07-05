-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2021 г., 20:08
-- Версия сервера: 8.0.19
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `materials_makeup`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(64) NOT NULL COMMENT 'название категории'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'КатяГориЯ'),
(2, 'КатяГориЯы'),
(3, 'КатяГориЯе'),
(4, 'КатяГориЯй'),
(5, 'КатяГориЯйпавы'),
(6, 'КатяГор'),
(7, 'КатяГориЯыыыыйq');

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE `materials` (
  `id` int NOT NULL,
  `type` int NOT NULL COMMENT 'тип материала',
  `category` int NOT NULL COMMENT 'категория материала',
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название материала',
  `author` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'автор материала',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'описание материала'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `type`, `category`, `name`, `author`, `description`) VALUES
(1, 1, 2, 'Гарри Поттер и философский камень', '', 'История о том, как мальчик по имени Гарри....'),
(2, 2, 1, 'Хз какое название', '', ''),
(3, 1, 2, 'asd', '', 'sss'),
(4, 3, 7, 'PewDiePie first video', 'PewDiePie', 'Крутое описание');

-- --------------------------------------------------------

--
-- Структура таблицы `material_link`
--

CREATE TABLE `material_link` (
  `id` int NOT NULL,
  `material_id` int NOT NULL COMMENT 'id материала',
  `link_title` varchar(64) NOT NULL COMMENT 'подпись ссылки',
  `link_url` varchar(128) NOT NULL COMMENT 'url'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_link`
--

INSERT INTO `material_link` (`id`, `material_id`, `link_title`, `link_url`) VALUES
(2, 1, 'title', 'https://www.youtube.com/'),
(3, 1, 'test link', 'https://mail.ru/'),
(4, 1, '', 'https://mail.ru/'),
(5, 2, 'Хз какая ссылка', 'https://aliexpress.com/'),
(6, 3, '', 'https://aliexpress.com/'),
(7, 4, 'Ютуб', 'https://www.youtube.com/');

-- --------------------------------------------------------

--
-- Структура таблицы `material_tag`
--

CREATE TABLE `material_tag` (
  `id` int NOT NULL,
  `material_id` int NOT NULL COMMENT 'id материала, к которому привзяан тег',
  `tag_id` int NOT NULL COMMENT 'id тега, который привязан к материалу'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `material_tag`
--

INSERT INTO `material_tag` (`id`, `material_id`, `tag_id`) VALUES
(4, 1, 1),
(6, 1, 2),
(7, 2, 1),
(9, 3, 2),
(10, 4, 2),
(11, 4, 5),
(12, 4, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'название тега'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Продуктивность'),
(2, 'Саморазвитие'),
(3, 'Главный герой не ОЯШ'),
(4, '177013'),
(5, 'Крутой тег');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_link`
--
ALTER TABLE `material_link`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `material_tag`
--
ALTER TABLE `material_tag`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `material_link`
--
ALTER TABLE `material_link`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `material_tag`
--
ALTER TABLE `material_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
