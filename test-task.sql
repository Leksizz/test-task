-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Июн 24 2024 г., 16:43
-- Версия сервера: 8.2.0
-- Версия PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test-task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `phones`
--

CREATE TABLE `phones` (
  `id` int NOT NULL,
  `number` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `phones`
--

INSERT INTO `phones` (`id`, `number`) VALUES
(162, '89136667788'),
(163, '89137789812'),
(164, '89137002030'),
(165, '89137342031'),
(166, '89137789812'),
(167, '89136667788'),
(168, '89876543311'),
(169, '80003334455'),
(170, '89996660011'),
(171, '89137342031'),
(172, '88099988776'),
(173, '89996660011'),
(174, '89996660011'),
(175, '89137342031'),
(176, '89996660011'),
(177, '89137789812'),
(178, '89996660011'),
(179, '89137789812'),
(180, '89137789812'),
(181, '89996660011'),
(182, '89137342031'),
(183, '89137789812'),
(184, '85556665566'),
(185, '89996660011'),
(186, '89137789812'),
(187, '89996660011'),
(188, '89137789812'),
(189, '89137342031'),
(190, '89137342031'),
(191, '89996660011'),
(192, '89137789812'),
(193, '83334445500'),
(194, '87779990011'),
(195, '88888888888');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(55) NOT NULL,
  `lastname` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `company` varchar(55) DEFAULT NULL,
  `position` varchar(55) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(55) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `company`, `position`, `password`, `role`) VALUES
(50, 'Alexey', 'Ivanov', 'example@example.ru', 'Example', 'Exampe', '$2y$10$wj4pCARo/YJS/6aW4H1sousIj5vgsscVYQJFO6ITaI22LJnIxAzkW', 'user'),
(54, 'Petr', 'Olegov', 'oleg@olegg.ru', 'Нет', 'Нет', '$2y$10$T1FgPCAOLcI/l8HUW7MKzecAAZbMaiOTxgWGEUSqDToLzQqnLrDa.', 'user'),
(55, 'Evgeniy', 'Potapov', 'potapov@mail.ru', 'Potap', 'Teacher', '$2y$10$XFUvpp.AR/CiUSALYSE4buElyHXX8Luj7VPJSBKNPMIPThgFF110S', 'user'),
(56, 'Dmitriy', 'Lokot', 'lokot@lokot.ru', 'Нет', 'Нет', '$2y$10$QoLJVQiir0Q3YwhRVgGUouzi9XqSmbAND8U6mcSGT1celWuK1OD/u', 'user'),
(57, 'Ostap', 'Ostapov', 'mail@poc.ru', 'Mail', 'Нет', '$2y$10$dtviBXnzq6hT7z8Dt5buL.5xa7tF7juzkiamc2EPvdR7OtSXs8Qsm', 'user'),
(58, 'Mariya', 'Smirnova', 'smirnova@smirnova.ru', 'Smirnova', 'Director', '$2y$10$adaAh6xuJx5Jn.skVH179erOFGKanbDY57YZoC91tZwbsBZHRnJKG', 'user'),
(59, 'Timur', 'Gorlov', 'gorl@lok.ru', 'Roke', 'Developer', '$2y$10$M0Hwkfj9DNY2YJtWjheENegNuhUy4iRoqLd73.shiCoqzbrWucNQ6', 'user'),
(60, 'Panfil', 'Sergeev', 'sergeev@sergey.ru', 'Нет', 'Нет', '$2y$10$ThZquwQuEQdCBKYHBe76KuxncTBMsgIxGWvTUkQx47xYsY6M9iaOO', 'user'),
(61, 'Nikita', 'Notov', 'notov@mail.ru', 'Mail', 'Driver', '$2y$10$I/4eJPpqB98EjjPk5cBTbOwiUDE6ThWOmMfcqjJVQbFd3ErhzYPgq', 'user'),
(62, 'Anastasiya', 'Barskaya', 'bar@rui.ru', 'Нет', 'Нет', '$2y$10$DBu7ubtyZeWlq0MeHY7PhuyN3p1X02Bcdwuj9tOBTu.7iltqVqTCK', 'user'),
(63, 'Dariya', 'Novoselova', 'lodse@mail.ru', 'Нет', 'Нет', '$2y$10$ezsfDcL5LFwJkoF73PLbuezjCo5XkC23uEaA6kGo1GcfizvDtqIpu', 'user'),
(64, 'Denis', 'Denisov', 'denis@denis.denis', 'Denis', 'Denis', '$2y$10$zL9NhG72DzpWfQfk7VIlV.hpc2dtso4Jjj/ummJZ/5/zpilGlHkvS', 'user'),
(65, 'Anna', 'Parubova', 'lot@lot.ru', 'Super', 'Owner', '$2y$10$PHybOsecsdxI.n829x1UoeNlalsHrlQsTyHQsCKc6mgJ0SpASKBEu', 'user'),
(66, 'Inna', 'Leip', 'leiber@lok.ru', 'Mail', 'Doctor', '$2y$10$7OwZ9LuJubye2MmcpsVekeiGhVxvu2ZSl9OG/YMyfg5Txa3ba1EfS', 'user'),
(67, 'Arsen', 'Bromov', 'brom@mor.ru', 'Нет', 'Нет', '$2y$10$UrJhPi812ApE3R59DMa5Hemv8lxR3ing7qTDLLiN47WSDah8VbmWe', 'user'),
(68, 'Alexey', 'Boylov', 'boylov@das.ru', 'Example', 'Example', '$2y$10$9lChhvUrnkWof3Dj18X4cOw989dnKP95euxDQPpoQWblT0/EoA5N.', 'user'),
(69, 'John', 'Rybakov', 'rybak@fish.ru', 'Fish', 'hr', '$2y$10$mTppLCUs3J/MTAHVXt686.qIaFd.6DehVt4IfXWKHWsyIgmes.zM.', 'user'),
(70, 'Kirill', 'Sollv', 'solvd@solvde.ru', 'Shop', 'Director', '$2y$10$G9KCGSEp4T/yLzPzxdlMw.HrWnW6uAWrGSAAmO1Vw8O2rWJIN8zZi', 'user'),
(71, 'Lev', 'Tigrov', 'tigrov@tigrov.ru', 'Zoo', 'Security', '$2y$10$Lmhzsoxa.miDExf64OpUw.7LkSSgfsIaMgYxPz64caUTz7OTH8j0W', 'user'),
(72, 'Matvey', 'Nikitov', 'nikitov@nikitov.ru', 'Example', 'Designer', '$2y$10$.G.vYpt9Rnq/me2Z3guviO31D8KQHe817BtTrr8UJ1.vcJE7BP0HG', 'user'),
(75, 'Ivan', 'Ivanov', 'admin@admin.ru', NULL, NULL, '$2y$10$i6ckd5oLyJLh.zRyPsZd3.fZLBxbpOzix0XsalkCZKjRsFkxbCWoy', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user_phone`
--

CREATE TABLE `user_phone` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `phone_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user_phone`
--

INSERT INTO `user_phone` (`id`, `user_id`, `phone_id`) VALUES
(134, 50, 162),
(135, 50, 163),
(136, 50, 164),
(137, 54, 165),
(138, 55, 166),
(139, 55, 167),
(140, 55, 168),
(141, 58, 169),
(142, 58, 170),
(143, 58, 171),
(144, 59, 172),
(145, 59, 173),
(146, 60, 174),
(147, 61, 175),
(148, 63, 176),
(149, 63, 177),
(150, 64, 178),
(151, 64, 179),
(152, 65, 180),
(153, 65, 181),
(154, 65, 182),
(155, 66, 183),
(156, 66, 184),
(157, 66, 185),
(158, 68, 186),
(159, 69, 187),
(160, 69, 188),
(161, 69, 189),
(162, 70, 190),
(163, 70, 191),
(164, 70, 192),
(165, 71, 193),
(166, 72, 194),
(167, 72, 195);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `phones`
--
ALTER TABLE `phones`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_phone`
--
ALTER TABLE `user_phone`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_phone_ibfk_2` (`user_id`),
  ADD KEY `user_phone_ibfk_1` (`phone_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `phones`
--
ALTER TABLE `phones`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `user_phone`
--
ALTER TABLE `user_phone`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_phone`
--
ALTER TABLE `user_phone`
  ADD CONSTRAINT `user_phone_ibfk_1` FOREIGN KEY (`phone_id`) REFERENCES `phones` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `user_phone_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
