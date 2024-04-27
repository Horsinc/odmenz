-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 27 2024 г., 13:22
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `site`
--

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `id_client` int NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `fio` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `male` tinyint(1) NOT NULL,
  `adress` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `votes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`id_client`, `email`, `password`, `fio`, `phone_number`, `male`, `adress`, `votes`) VALUES
(24, 'admin@tyrishki.ru', '$2y$10$Ky./N4I5UMU.QE2QdC4ZCOgG6cGH4SUn/OdMmNI3c2Et1DVT874IW', 'Админ', NULL, 0, '', 0),
(25, 'user@mail.ru', '$2y$10$tL.8Dnj2UiRBPhdZOFJdM.jj7nNOZg/QRxgI04xQ9lGTfyPeBR/Rm', 'Пользователь1', '89156134195', 0, '', 0),
(26, 'dadaya@mail.ru', '$2y$10$44SWtBf6njZS.fMw3.amdebGzlun6QMcdLNc1oLSzVuAgUut.PFMG', 'да да я', '8800553535', 0, '', 0),
(27, 'soff.kochenko@gmail.com', '$2y$10$S3pLlFduCnh0F0oa4xtX/ep1qoSD9im6TrreolIMo.oReCtA8C/PG', 'Коченко София', NULL, 0, '', 0),
(28, 'user1new@mail.ru', '$2y$10$zl63aushWl5vNvyxttOn5.PjE27b0wGQeCVVpz51amIwFRRffXTDi', 'хихихих', '+79966177233', 0, '', 0),
(29, 'dadaya@mail.ru', '$2y$10$tw3G348mxq9svOBe0mCkr.c15OO/TKyRvZWk6NoceJu9ULdZLJlg.', 'да да я', NULL, 0, '', 0),
(30, 'ydgsfuygewy@dsfsdfs.er', '$2y$10$I7rlO0eEGIUu.lEmzCOgPe4h6cNfaYbG8lEuXavubU0rXRLYSYNE.', 'да да я', NULL, 0, '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `clients_hike`
--

CREATE TABLE `clients_hike` (
  `id_hike` int NOT NULL,
  `id_client` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `hike`
--

CREATE TABLE `hike` (
  `id_hike` int NOT NULL,
  `id_pictures` int NOT NULL,
  `name_hike` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description_hike` text COLLATE utf8mb4_general_ci NOT NULL,
  `start_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `stop_position` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `kod_map` text COLLATE utf8mb4_general_ci NOT NULL,
  `d_start` datetime NOT NULL,
  `d_stop` datetime NOT NULL,
  `price_hike` decimal(7,2) NOT NULL,
  `id_leader` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `hike`
--

INSERT INTO `hike` (`id_hike`, `id_pictures`, `name_hike`, `description_hike`, `start_position`, `stop_position`, `kod_map`, `d_start`, `d_stop`, `price_hike`, `id_leader`) VALUES
(1, 1, 'Тур до Сибири', '', 'Омск', 'Владивосток', '', '2024-03-28 21:38:00', '2024-03-31 21:38:00', '25000.00', 1),
(2, 2, 'Касимов-Рязань', '', ' Набережная ул., 27А, Касимов', 'ул. Кремль, 15', '<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8274daea4731059fdf500b34a6248ef683a6ee6101d2bcfdba07e37b74ad49af&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>', '2024-03-28 22:52:00', '2024-03-29 22:52:00', '10000.00', 2),
(3, 3, 'Касимов-Рязань 2', 'Незабываемый турпоход из Касимова в Рязань: по следам прошлого Отправляйтесь в увлекательное путешествие по историческим местам, следуя по маршруту бывалых купцов и путешественников – из очаровательного города Касимова в славную Рязань!  Пеший маршрут позволит вам по-настоящему прочувствовать красоту Мещерской низменности, подышать свежим воздухом, насладиться природой и сделать потрясающие фотографии.  Во время похода вы:  Посетите исторические города Касимов и Рязань с их уникальной архитектурой и богатым культурным наследием. Узнаете интересные факты и легенды, связанные с этими местами. Остановитесь на ночлег в живописных местах на берегу реки Ока. Проведете душевные вечера у костра, наслаждаясь тишиной и звездным небом. Испытаете себя на выносливость, получив заряд бодрости и положительных эмоций. Этот поход подойдет:  Любителям активного отдыха и пеших прогулок. Тем, кто интересуется историей и культурой родного края. Семьям с детьми (от 10 лет). Всем, кто хочет отдохнуть от городской суеты и общения с природой. В стоимость тура входит:  Услуги опытного гида-проводника. Разрешение на посещение национального парка (если маршрут проходит через него). Групповое снаряжение (палатки, костровое оборудование). Питание на протяжении всего похода. Необходимое снаряжение (свой личный список):  Удобная обувь для треккинга. Рюкзак. Спальный мешок. Индивидуальная аптечка. Головной убор и солнцезащитные средства. Дождевик (на случай непогоды). Походная фляжка для воды. Забронируйте свое место в этом незабываемом путешествии уже сегодня!', ' Набережная ул., 27А, Касимов', 'ул. Кремль, 15', '<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8274daea4731059fdf500b34a6248ef683a6ee6101d2bcfdba07e37b74ad49af&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>', '2024-03-31 21:25:00', '2024-04-02 21:26:00', '15000.00', 3),
(4, 4, 'Касимов-Рязань 3', 'Незабываемый турпоход из Касимова в Рязань: по следам прошлого\r\nОтправляйтесь в увлекательное путешествие по историческим местам, следуя по маршруту бывалых купцов и путешественников – из очаровательного города Касимова в славную Рязань!\r\n\r\nПеший маршрут позволит вам по-настоящему прочувствовать красоту Мещерской низменности, подышать свежим воздухом, насладиться природой и сделать потрясающие фотографии.\r\n\r\nВо время похода вы:\r\n\r\nПосетите исторические города Касимов и Рязань с их уникальной архитектурой и богатым культурным наследием.\r\nУзнаете интересные факты и легенды, связанные с этими местами.\r\nОстановитесь на ночлег в живописных местах на берегу реки Ока.\r\nПроведете душевные вечера у костра, наслаждаясь тишиной и звездным небом.\r\nИспытаете себя на выносливость, получив заряд бодрости и положительных эмоций.\r\nЭтот поход подойдет:\r\n\r\nЛюбителям активного отдыха и пеших прогулок.\r\nТем, кто интересуется историей и культурой родного края.\r\nСемьям с детьми (от 10 лет).\r\nВсем, кто хочет отдохнуть от городской суеты и общения с природой.\r\nВ стоимость тура входит:\r\n\r\nУслуги опытного гида-проводника.\r\nРазрешение на посещение национального парка (если маршрут проходит через него).\r\nГрупповое снаряжение (палатки, костровое оборудование).\r\nПитание на протяжении всего похода.\r\nНеобходимое снаряжение (свой личный список):\r\n\r\nУдобная обувь для треккинга.\r\nРюкзак.\r\nСпальный мешок.\r\nИндивидуальная аптечка.\r\nГоловной убор и солнцезащитные средства.\r\nДождевик (на случай непогоды).\r\nПоходная фляжка для воды.\r\nЗабронируйте свое место в этом незабываемом путешествии уже сегодня!', ' Набережная ул., 27А, Касимов', 'ул. Кремль, 15', '<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8274daea4731059fdf500b34a6248ef683a6ee6101d2bcfdba07e37b74ad49af&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>', '2024-04-06 22:00:00', '2024-04-07 22:00:00', '10000.00', 4),
(5, 5, 'По горам Камчатки', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum urna turpis, iaculis quis nunc vitae, eleifend tristique libero. Praesent condimentum lectus ac maximus dapibus. Nam at purus viverra, sollicitudin augue in, ullamcorper felis. Donec varius elementum egestas. Suspendisse ultrices lacus in enim posuere lobortis. Praesent vel est diam. Aliquam fermentum erat leo, fermentum finibus magna fermentum sed. Nunc laoreet placerat tellus. Vivamus sagittis, urna eget dictum rhoncus, metus velit suscipit urna, vitae finibus mauris augue porttitor ante. Ut facilisis scelerisque tempor. In vitae interdum sem, et facilisis risus. Sed accumsan bibendum varius. Cras sed nulla ac erat tincidunt feugiat vitae vitae sem. Morbi tellus libero, fermentum sed fringilla et, mollis non nunc. In hac habitasse platea dictumst. Vestibulum tortor erat, scelerisque et finibus non, accumsan sed mauris.\r\n\r\nSed justo dui, luctus aliquet blandit in, fermentum aliquet tortor. Suspendisse potenti. Nunc venenatis eros lectus, sit amet dictum est gravida id. Fusce laoreet sit amet massa et bibendum. In at tortor et urna luctus venenatis. Praesent semper placerat ante. Nulla pretium pharetra dapibus. Nullam vel gravida nisi. Integer eu dolor nisl. Duis vulputate tellus lacus, nec molestie est consequat eu. Quisque feugiat tincidunt eleifend. Vivamus dignissim fringilla augue, sit amet hendrerit eros pulvinar et. Cras sagittis mi vel dignissim eleifend. Morbi nec metus non velit scelerisque ultricies. Nulla nulla ex, tincidunt eu massa at, posuere scelerisque augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', ' Набережная ул., 27А, Касимов', 'ул. Кремль, 15', '<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8274daea4731059fdf500b34a6248ef683a6ee6101d2bcfdba07e37b74ad49af&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>', '2024-05-10 18:22:00', '2024-05-13 18:22:00', '18000.00', 6),
(6, 6, 'Тур до Сибири', 'Путешествие пешком: от Касимова до Рязани\r\n\r\nКак часто мы мечтаем о приключениях, о новых открытиях, о путешествиях? А что, если взять карту, взять рюкзак и отправиться в путь пройтись пешком от одного города до другого? Сегодня мы расскажем о захватывающем путешествии пешком из Касимова в Рязань.\r\n\r\nПодготовка к приключению\r\n\r\nПрежде чем начать свой путь, необходимо хорошо подготовиться. Убедитесь, что у вас есть удобная обувь, одежда, рюкзак с необходимыми вещами, а также карта маршрута. Проверьте прогноз погоды, возьмите с собой запас еды и воды. Главное – не забудьте позитивный настрой и желание исследовать мир вокруг!\r\n\r\nПервый этап: Касимов - Перемышль\r\n\r\nВаше путешествие начнется в живописном городе Касимове, берущем свое начало от XIV века. Прогуливаясь по улочкам старого города, наслаждаясь его архитектурой и атмосферой, вы покидаете его границы и направляетесь к первой остановке – деревне Перемышль.\r\n\r\nВторой этап: Перемышль - Кораблино\r\n\r\nПройдя через Перемышль, вы выходите на открытое пространство, где вас ждут живописные поля и леса. Ваш следующий пункт назначения – город Кораблино, известный своими историческими достопримечательностями и доброжелательными жителями.\r\n\r\nФинальный этап: Кораблино - Рязань\r\n\r\nПоследний этап вашего путешествия – дорога из Кораблино в Рязань. Пройдя этот путь, вы окажетесь в старинном городе Рязани, где вас встретят уютные улицы, древние храмы и богатая история. Насладитесь атмосферой этого удивительного города и зарядитесь его энергией.\r\n\r\nВывод\r\n\r\nПутешествие пешком из Касимова в Рязань – это не просто перемещение из одного места в другое, это настоящее приключение, которое позволит вам увидеть мир с новой стороны, испытать себя и насладиться красотой русской природы. Не бойтесь сделать первый шаг – и вас ждут удивительные открытия и незабываемые впечатления!', ' Набережная ул., 27А, Касимов', 'ул. Кремль, 15', '<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8274daea4731059fdf500b34a6248ef683a6ee6101d2bcfdba07e37b74ad49af&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>', '2024-05-10 16:47:00', '2024-05-12 16:47:00', '99999.99', 12),
(7, 7, 'Даня', 'Порядочный классный чел.\r\n\r\nВаще прикол на приколе\r\n\r\nМШКФРД!!!!!', ' Набережная ул., 27А, Касимов', 'ул. Кремль, 15', '<script type=\"text/javascript\" charset=\"utf-8\" async src=\"https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8274daea4731059fdf500b34a6248ef683a6ee6101d2bcfdba07e37b74ad49af&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true\"></script>', '2024-05-01 17:05:00', '2024-05-03 17:05:00', '1.00', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `okruga`
--

CREATE TABLE `okruga` (
  `id_okruga` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_hike`
--

CREATE TABLE `order_hike` (
  `id_hike` int NOT NULL,
  `id_client` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `otchet`
--

CREATE TABLE `otchet` (
  `id_hike` int NOT NULL,
  `id_client` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `pic_hike`
--

CREATE TABLE `pic_hike` (
  `id_hike_pictures` int NOT NULL,
  `picture_tour` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pic_hike`
--

INSERT INTO `pic_hike` (`id_hike_pictures`, `picture_tour`) VALUES
(1, '../product_img/66046c029eee8_palatka-canadian-camper-sana-4-plus-royal-1200x700.jpg'),
(1, '../product_img/66046c02a65b1_Zxe6N1h.jpg'),
(1, '../product_img/66046c02a67cf_др од г.jpg'),
(2, '../hike_img/660479d10b3a9_4445.jpg'),
(2, '../hike_img/660479d10b530_4446.jpg'),
(2, '../hike_img/660479d10ee67_4447.jpg'),
(2, '../hike_img/660479d10ef73_4448.jpg'),
(2, '../hike_img/660479d10f047_4449.jpg'),
(2, '../hike_img/660479d10f121_4450.jpg'),
(2, '../hike_img/660479d10f1f4_4451.jpg'),
(2, '../hike_img/660479d10f2db_4452.jpg'),
(2, '../hike_img/660479d10f3b6_4453.jpg'),
(3, '../hike_img/6605b715d31ac_pngwing.com (11).png'),
(3, '../hike_img/6605b715d340e_pngwing.com (9).png'),
(3, '../hike_img/6605b715d34e6_pngwing.com (8).png'),
(3, '../hike_img/6605b715d94e3_pngwing.com (7).png'),
(4, '../hike_img/6605be7ae38b7_pngwing.com (6).png'),
(4, '../hike_img/6605be7ae39fe_pngwing.com (5).png'),
(4, '../hike_img/6605be7ae3adc_pngwing.com (4).png'),
(4, '../hike_img/6605be7ae3bb0_pngwing.com (2).png'),
(5, '../hike_img/660ad18624322_5137_winter-mountains-mountain-ranges_3840x2160 1.jpg'),
(5, '../hike_img/660ad186243bd_mountains-3840x2160-003.jpg'),
(6, '../hike_img/660d5e06cf421_pngwing.com (11).png'),
(6, '../hike_img/660d5e06cf4d7_pngwing.com (9).png'),
(6, '../hike_img/660d5e06cf512_pngwing.com (8).png'),
(6, '../hike_img/660d5e06cf53e_5362676a-5260-496f-88fa-6ec0d0f6681d.jpg'),
(7, '../hike_img/660d62e7d1a2e_ВФЫВФЫВФЫ.JPG'),
(7, '../hike_img/660d62e7d1ac7_ВФЫВФЫВЫФВ.JPG'),
(7, '../hike_img/660d8ce05f90c_1614510861_5-p-na-belom-fone-chelovek-5.jpg'),
(7, '../hike_img/660d8ce05fadb_ПРЕВЬЮ.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id_region` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_hike` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `votes`
--

CREATE TABLE `votes` (
  `id_region` int NOT NULL,
  `id_okruga` int NOT NULL,
  `votes_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `votes_2`
--

CREATE TABLE `votes_2` (
  `id_region` int NOT NULL,
  `votes_2_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id_client`);

--
-- Индексы таблицы `clients_hike`
--
ALTER TABLE `clients_hike`
  ADD UNIQUE KEY `id_hike` (`id_hike`),
  ADD UNIQUE KEY `id_client` (`id_client`);

--
-- Индексы таблицы `hike`
--
ALTER TABLE `hike`
  ADD PRIMARY KEY (`id_hike`),
  ADD KEY `id_pictures` (`id_pictures`),
  ADD KEY `id_leader` (`id_leader`);

--
-- Индексы таблицы `okruga`
--
ALTER TABLE `okruga`
  ADD PRIMARY KEY (`id_okruga`);

--
-- Индексы таблицы `order_hike`
--
ALTER TABLE `order_hike`
  ADD KEY `id_hike` (`id_hike`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `otchet`
--
ALTER TABLE `otchet`
  ADD KEY `id_hike` (`id_hike`),
  ADD KEY `id_client` (`id_client`);

--
-- Индексы таблицы `pic_hike`
--
ALTER TABLE `pic_hike`
  ADD KEY `id_hike_pictures` (`id_hike_pictures`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id_region`),
  ADD KEY `id_hike` (`id_hike`);

--
-- Индексы таблицы `votes`
--
ALTER TABLE `votes`
  ADD KEY `id_region` (`id_region`),
  ADD KEY `id_okruga` (`id_okruga`);

--
-- Индексы таблицы `votes_2`
--
ALTER TABLE `votes_2`
  ADD KEY `id_region` (`id_region`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `clients`
--
ALTER TABLE `clients`
  MODIFY `id_client` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `okruga`
--
ALTER TABLE `okruga`
  MODIFY `id_okruga` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id_region` int NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `clients_hike`
--
ALTER TABLE `clients_hike`
  ADD CONSTRAINT `clients_hike_ibfk_1` FOREIGN KEY (`id_hike`) REFERENCES `hike` (`id_hike`),
  ADD CONSTRAINT `clients_hike_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Ограничения внешнего ключа таблицы `order_hike`
--
ALTER TABLE `order_hike`
  ADD CONSTRAINT `order_hike_ibfk_1` FOREIGN KEY (`id_hike`) REFERENCES `hike` (`id_hike`),
  ADD CONSTRAINT `order_hike_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Ограничения внешнего ключа таблицы `otchet`
--
ALTER TABLE `otchet`
  ADD CONSTRAINT `otchet_ibfk_1` FOREIGN KEY (`id_hike`) REFERENCES `hike` (`id_hike`),
  ADD CONSTRAINT `otchet_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`);

--
-- Ограничения внешнего ключа таблицы `pic_hike`
--
ALTER TABLE `pic_hike`
  ADD CONSTRAINT `pic_hike_ibfk_1` FOREIGN KEY (`id_hike_pictures`) REFERENCES `hike` (`id_pictures`);

--
-- Ограничения внешнего ключа таблицы `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_ibfk_1` FOREIGN KEY (`id_hike`) REFERENCES `hike` (`id_hike`);

--
-- Ограничения внешнего ключа таблицы `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id_region`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`id_okruga`) REFERENCES `okruga` (`id_okruga`);

--
-- Ограничения внешнего ключа таблицы `votes_2`
--
ALTER TABLE `votes_2`
  ADD CONSTRAINT `votes_2_ibfk_1` FOREIGN KEY (`id_region`) REFERENCES `regions` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
