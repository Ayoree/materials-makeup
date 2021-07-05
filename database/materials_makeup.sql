-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 05 2021 г., 21:12
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
(1, 'Тестовая категория 1'),
(2, 'Тестовая категория 2'),
(3, 'Тестовая категория 3'),
(4, 'Тестовая категория 4'),
(5, 'Тестовая категория 5'),
(6, 'Тестовая категория 6'),
(9, 'Категория для удаления');

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
(2, 4, 1, 'Хз какое название', '', ''),
(4, 3, 6, 'PewDiePie first video', 'PewDiePie', 'Крутое описание'),
(5, 2, 4, 'Какая-то статья', 'Последняя буква алфавита', 'Какая-то рандомная статья на какую-то рандомную тему');

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
(3, 1, 'test link', 'https://mail.ru/'),
(4, 1, '', 'https://mail.ru/'),
(5, 2, 'Хз какая ссылка', 'https://aliexpress.com/'),
(6, 3, '', 'https://aliexpress.com/'),
(7, 4, 'Ютуб', 'https://www.youtube.com/'),
(8, 4, 'Видео', 'https://www.youtube.com/watch?v=UgBqMPb2sa4'),
(9, 2, 'Али', 'https://aliexpress.com/'),
(10, 5, 'Яндекс Балабоба', 'https://yandex.ru/lab/yalm');

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
(12, 4, 1),
(17, 5, 7),
(18, 5, 4),
(19, 2, 7),
(24, 2, 4);

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
(1, 'Тестовый тег 1'),
(2, 'Тестовый тег 2'),
(3, 'Тестовый тег 3'),
(4, 'Тестовый тег 4'),
(7, 'Тестовый тег 5'),
(8, 'Тестовый тег 6');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `material_link`
--
ALTER TABLE `material_link`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `material_tag`
--
ALTER TABLE `material_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
