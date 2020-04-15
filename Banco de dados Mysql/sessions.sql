-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:56 AM
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
-- Estrutura da tabela `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL auto_increment,
  `sessionId` varchar(32) default NULL,
  `userId` int(11) default '0',
  `sessionStart` datetime default NULL,
  `lastACTIVE` datetime default NULL,
  `userType` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261970 ;

--
-- Extraindo dados da tabela `sessions`
--

INSERT INTO `sessions` (`id`, `sessionId`, `userId`, `sessionStart`, `lastACTIVE`, `userType`) VALUES
(261317, '52533405f9316ad1a66038672ff85312', 43724, '2010-01-09 10:17:19', '2010-01-09 10:17:19', 1),
(261969, '90ec079dc3215b2a5052d7ee5907dfd0', 36605, '2010-01-10 10:52:59', '2010-01-10 10:52:59', 1);
