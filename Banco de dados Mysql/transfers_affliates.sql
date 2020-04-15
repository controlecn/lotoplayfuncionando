-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:07 AM
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
-- Estrutura da tabela `transfers_affliates`
--

CREATE TABLE IF NOT EXISTS `transfers_affliates` (
  `id` int(11) NOT NULL auto_increment,
  `affliateId` int(11) NOT NULL default '0',
  `userId` int(11) NOT NULL default '0',
  `information` varchar(250) NOT NULL default '',
  `totalValue` float NOT NULL default '0',
  `affliateValue` float NOT NULL default '0',
  `buyMonth` int(2) NOT NULL default '0',
  `buyYear` int(4) NOT NULL default '0',
  `buyDate` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=989 ;

--
-- Extraindo dados da tabela `transfers_affliates`
--

INSERT INTO `transfers_affliates` (`id`, `affliateId`, `userId`, `information`, `totalValue`, `affliateValue`, `buyMonth`, `buyYear`, `buyDate`) VALUES
(44, 9, 7789, 'Banco do Brasil', 20, 3, 1, 2007, '2007-01-17 16:10:09'),
(988, 130, 43612, 'Banco Itau', 200, 30, 1, 2010, '2010-01-10 01:21:01');
