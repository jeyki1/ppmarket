-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 15 2026 г., 13:03
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ppmmarket`
--

-- --------------------------------------------------------

--
-- Структура таблицы `artists`
--

CREATE TABLE `artists` (
  `id` int(11) NOT NULL,
  `artist` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `artists`
--

INSERT INTO `artists` (`id`, `artist`) VALUES
(1, 'Young Thug'),
(2, '6lack'),
(3, 'Don Toliver'),
(4, '21 Savage'),
(5, '$uicideboy$'),
(6, 'PinkPantheress'),
(7, 'PartyNextDoor');

-- --------------------------------------------------------

--
-- Структура таблицы `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NULL DEFAULT current_timestamp(),
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `basket`
--

INSERT INTO `basket` (`id`, `user_id`, `product_id`, `quantity`, `added_at`, `service_id`) VALUES
(18, 13, NULL, 1, '2026-05-05 11:56:35', 4),
(39, 12, 27, 1, '2026-05-15 04:44:35', NULL),
(40, 12, 26, 1, '2026-05-15 04:44:37', NULL),
(41, 12, NULL, 1, '2026-05-15 04:44:39', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `name`, `phone`, `email`, `message`) VALUES
(10, 'Og Buda Lyahov', '+7 (999) 888-77-66', 'ogbuda@gmail.com', 'ogbuda ogbuda ogbuda ogbuda'),
(11, 'tyttr', '89008007060', 'tyttr@gmail.com', 'tyttr titter'),
(12, 'Олег Ничипаренко', '98887776655', 'kuzaru@gm.cm', 'дурка от бублика'),
(13, 'jeff', '12223334455', 'youngthug@gm.cm', 'on film fire'),
(14, 'курекгу', '34534545456', 'rute@gm.c', 'rterter');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `product_id`, `service_id`, `created_at`) VALUES
(3, 12, 28, NULL, '2026-05-14 11:47:52'),
(4, 12, 27, NULL, '2026-05-14 11:47:52'),
(5, 12, NULL, 5, '2026-05-14 11:47:52'),
(6, 12, 29, NULL, '2026-05-14 12:48:32'),
(7, 12, NULL, 6, '2026-05-14 12:48:32'),
(8, 15, 28, NULL, '2026-05-14 13:43:54'),
(9, 15, NULL, 5, '2026-05-14 13:43:54'),
(10, 15, 24, NULL, '2026-05-14 13:52:10'),
(11, 15, NULL, 7, '2026-05-14 13:52:10'),
(12, 15, 27, NULL, '2026-05-14 13:52:24');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `audio` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `artist_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `bpm` int(11) DEFAULT NULL,
  `beat_key` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `audio`, `price`, `image`, `type_id`, `artist_id`, `user_id`, `bpm`, `beat_key`) VALUES
(23, 'onfilm', 'onfilm.mp3', 2000.00, 'thug.jpg', 5, 1, NULL, 140, 'amin'),
(24, 'pzlka', '6a036d26ce97e0.07121354.mp3', 2000.00, 'sixlack.jpeg', 2, 2, NULL, 96, 'g#min'),
(25, 'mrazi', '6a036da7626b45.56248851.mp3', 2000.00, '6a036da7603679.23424351.jpeg', 4, 5, NULL, 117, 'c#min'),
(26, 'mocachino', '6a036ee8259df1.17510469.mp3', 2000.00, '6a036ee824c1b5.98570052.jpeg', 3, 1, NULL, 134, 'f#min'),
(27, 'tern', '6a03706a684125.90016960.mp3', 2000.00, '6a03706a678868.08800953.jpeg', 5, 4, NULL, 119, 'd#min'),
(28, 'amslex', '6a0371aecd0c85.69282373.mp3', 2000.00, '6a0371aecb19e9.83986070.jpeg', 6, 6, NULL, 178, 'bmin'),
(29, 'tancuyu', '6a0372e3df7a64.92030373.mp3', 2000.00, '6a0372e3debb56.28358096.jpeg', 2, 7, NULL, 127, 'dmin');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'User'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `services`
--

INSERT INTO `services` (`id`, `name`, `price`, `description`, `image`) VALUES
(4, 'Сведение трека', 5990.00, 'включает в себя:\r\n- Полноценное сведение дорожек вашего голоса и бита;\r\n- Частотная, динамическая и пространственная обработка;\r\n- Работа с инструменталом;\r\n- Саунд-дизайн проекта, создание различных эффектов на голосе.', 'mix.jpg'),
(5, 'Мастеринг трека', 2990.00, 'включает в себя:\r\n- Лимитирование и компрессия финального материала;\r\n- Эквализация, улучшение стерео;\r\n- Приведение всего релизу к одному звучанию.\r\n', 'master.jpg'),
(6, 'Сведение и мастеринг трека', 8990.00, 'включает в себя:\r\n- Исправление вокала и создание фирменного звучания «под ключ»;\r\n- Частотная и динамическая склейка вашего голоса с битом;\r\n- Финальная полировка звука, стерео-улучшение и готовность к релизу.', 'mixmaster.jpg'),
(7, 'Дистрибуция трека', 1390.00, 'включает в себя:\r\n- Размещение трека в цифровых магазинах и на стримингах;\r\n- Отслеживание прослушиваний и выплата дохода;\r\n- Указание исполнителя, названия, жанра, ISRC-кодов.', 'disrib.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `types`
--

INSERT INTO `types` (`id`, `type`) VALUES
(2, 'rnb'),
(3, 'slime'),
(4, 'memphis'),
(5, 'trap'),
(6, 'jungle');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `login`, `password`, `role_id`) VALUES
(12, 'Admin Adminov', 'admin@gm.co', 'admin', 'adminone', 2),
(13, 'Григорий Ляхов', 'ogbuda@gmail.com', 'ogbuda', 'ogbuda', 1),
(14, 'Артем Никитин', 'mayot@gm.co', 'mayot', 'mayot', 1),
(15, 'Денис Бучельников', 'kichneight@gm.cm', 'kichneight', 'kichneight', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `basket_ibfk_3` (`service_id`);

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `artists`
--
ALTER TABLE `artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `basket_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`artist_id`) REFERENCES `artists` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
