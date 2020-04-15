-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:44 AM
-- Versão do Servidor: 5.0.87
-- Versão do PHP: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `lotoplay`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cron_vip`
--

CREATE TABLE IF NOT EXISTS `cron_vip` (
  `id` int(11) NOT NULL auto_increment,
  `active` int(2) NOT NULL default '0',
  `hours` int(2) NOT NULL default '0',
  `players_min` int(3) NOT NULL default '0',
  `players_max` int(3) NOT NULL default '0',
  `cards_min` int(2) NOT NULL default '0',
  `cards_max` int(2) NOT NULL default '0',
  `prize_percents` float(2,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `cron_vip`
--

INSERT INTO `cron_vip` (`id`, `active`, `hours`, `players_min`, `players_max`, `cards_min`, `cards_max`, `prize_percents`) VALUES
(1, 1, 0, 22, 32, 15, 40, 0.55),
(2, 1, 1, 18, 29, 15, 40, 0.50),
(3, 1, 2, 12, 23, 15, 40, 0.60),
(4, 1, 3, 6, 15, 15, 40, 0.65),
(5, 1, 4, 4, 12, 15, 40, 0.65),
(6, 1, 5, 6, 12, 15, 40, 0.55),
(7, 1, 6, 6, 14, 15, 40, 0.65),
(8, 1, 7, 6, 14, 19, 40, 0.55),
(9, 1, 8, 12, 16, 15, 40, 0.45),
(10, 1, 9, 13, 23, 15, 40, 0.55),
(11, 1, 10, 14, 25, 15, 40, 0.65),
(12, 1, 11, 18, 24, 15, 40, 0.65),
(13, 1, 12, 22, 34, 15, 40, 0.45),
(14, 1, 13, 26, 37, 15, 40, 0.60),
(15, 1, 14, 18, 32, 15, 40, 0.50),
(16, 1, 15, 25, 39, 15, 40, 0.55),
(17, 1, 16, 15, 23, 15, 40, 0.45),
(18, 1, 17, 22, 34, 15, 40, 0.55),
(19, 1, 18, 24, 39, 15, 40, 0.55),
(20, 1, 19, 19, 28, 15, 40, 0.60),
(21, 1, 20, 26, 39, 15, 40, 0.45),
(22, 1, 21, 28, 42, 15, 40, 0.55),
(23, 1, 22, 32, 44, 15, 40, 0.60),
(24, 1, 23, 24, 35, 15, 40, 0.55);
