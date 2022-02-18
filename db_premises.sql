-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Фев 18 2022 г., 12:23
-- Версия сервера: 10.4.22-MariaDB
-- Версия PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `db_premises`
--

-- --------------------------------------------------------

--
-- Структура таблицы `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type_of_division_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `type_of_division_id`) VALUES
(646499, 'фуадлщзылуашщоыфуа', 5),
(646500, 'ВЫАЫА', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `divisions_types`
--

CREATE TABLE `divisions_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `divisions_types`
--

INSERT INTO `divisions_types` (`id`, `name`) VALUES
(7, 'ВЗЫлфяьывыра'),
(6, 'ываыасмЫвЫФВ'),
(5, 'ыяавщзлыщза');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Сотрудник');

-- --------------------------------------------------------

--
-- Структура таблицы `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `square` float NOT NULL,
  `amount_of_seats` int(11) NOT NULL,
  `type_of_room_id` int(11) NOT NULL,
  `division_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `square`, `amount_of_seats`, `type_of_room_id`, `division_id`) VALUES
(1, 'ывацуыщзлвйцщз', 30, 20, 3, 646500),
(2, 'ывалщывла', 514546, 656, 4, 646499),
(3, 'промангяываыв', 30, 50, 3, 646499);

-- --------------------------------------------------------

--
-- Структура таблицы `rooms_types`
--

CREATE TABLE `rooms_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `rooms_types`
--

INSERT INTO `rooms_types` (`id`, `name`) VALUES
(4, 'ВЗЫДВщзлфыв'),
(3, 'учебныйкабинет');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `patronymic` varchar(64) NOT NULL,
  `birthdate` date NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `patronymic`, `birthdate`, `token`, `role_id`) VALUES
(1, 'pumkillo', 'e10adc3949ba59abbe56e057f20f883e', 'Мария', 'Седова', 'Владимировна', '2004-01-20', '16c4f0f22f4cdc3a3f1aed627b5ba5ed', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `type_of_division_id` (`type_of_division_id`);

--
-- Индексы таблицы `divisions_types`
--
ALTER TABLE `divisions_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_of_room` (`type_of_room_id`),
  ADD KEY `division_id` (`division_id`);

--
-- Индексы таблицы `rooms_types`
--
ALTER TABLE `rooms_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=646501;

--
-- AUTO_INCREMENT для таблицы `divisions_types`
--
ALTER TABLE `divisions_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rooms_types`
--
ALTER TABLE `rooms_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `divisions`
--
ALTER TABLE `divisions`
  ADD CONSTRAINT `divisions_ibfk_1` FOREIGN KEY (`type_of_division_id`) REFERENCES `divisions_types` (`id`);

--
-- Ограничения внешнего ключа таблицы `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`type_of_room_id`) REFERENCES `rooms_types` (`id`),
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
