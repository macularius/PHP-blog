-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 14 2018 г., 01:41
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `MessageId` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `Author` text NOT NULL,
  `Date` date NOT NULL,
  `Text` text,
  PRIMARY KEY (`MessageId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `messages`
--

INSERT INTO `messages` (`MessageId`, `Author`, `Date`, `Text`) VALUES
(2, 'admin', '2018-06-12', 'привет'),
(6, 'admin', '2018-06-13', 'пока'),
(8, 'admin', '2018-06-13', 'скоро'),
(9, 'selkirk', '2018-06-14', 'привет');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserId` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `Login` text NOT NULL,
  `Password` text NOT NULL,
  `Role` text,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`UserId`, `Login`, `Password`, `Role`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'selkirk', '1', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
