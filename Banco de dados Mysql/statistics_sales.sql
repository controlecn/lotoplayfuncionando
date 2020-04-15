-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:58 AM
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
-- Estrutura da tabela `statistics_sales`
--

CREATE TABLE IF NOT EXISTS `statistics_sales` (
  `id` int(11) NOT NULL auto_increment,
  `transfertype` int(1) NOT NULL default '1',
  `userId` int(11) NOT NULL default '0',
  `buyDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `amount` decimal(10,2) NOT NULL default '0.00',
  `bank` int(11) NOT NULL default '0',
  `doc` char(240) default NULL,
  `boughtid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27249 ;

--
-- Extraindo dados da tabela `statistics_sales`
--

INSERT INTO `statistics_sales` (`id`, `transfertype`, `userId`, `buyDate`, `amount`, `bank`, `doc`, `boughtid`) VALUES
(1, 1, 25107, '2009-07-01 00:05:37', 10.00, 35, NULL, 0),
(2, 1, 22638, '2009-07-01 00:19:54', 30.00, 45, NULL, 0),
(27248, 1, 36145, '2010-01-10 10:43:25', 50.00, 35, '0448.19883-8', 60703);
