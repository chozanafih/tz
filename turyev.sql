-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 13 2019 г., 17:39
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `turyev`
--

-- --------------------------------------------------------

--
-- Структура таблицы `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `short` tinytext NOT NULL,
  `long` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `url`
--

INSERT INTO `url` (`short`, `long`) VALUES
('cf23e6', 'https://www.hostinger.ru/rukovodstva/rukovodstvo-po-codeigniter/'),
('f58e8b', 'https://www.google.com/search?rlz=1C1CHZL_ruRU789RU789&ei=4_eIXJGtEorNrgSbj5H4AQ&q=codeigniter+view%28%29&oq=codeigniter+view%28%29&gs_l=psy-ab.3..0i22i30l10.3819.3861..6677...0.0..0.103.187.1j1......0....1..gws-wiz.......0i71.Sx5MIq2jHdg'),
('66fda8', 'https://codeigniter.com/userguide3/helpers/url_helper.html');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
