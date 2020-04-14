-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:09 AM
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
-- Estrutura da tabela `transfers_payout`
--

CREATE TABLE IF NOT EXISTS `transfers_payout` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `payDate` datetime default NULL,
  `payValue` int(11) default NULL,
  `payBank` int(11) default NULL,
  `payAccount` varchar(30) default NULL,
  `payAgent` varchar(30) default NULL,
  `payAccountType` varchar(30) default NULL,
  `status` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8883 ;

--
-- Extraindo dados da tabela `transfers_payout`
--

INSERT INTO `transfers_payout` (`id`, `userId`, `payDate`, `payValue`, `payBank`, `payAccount`, `payAgent`, `payAccountType`, `status`) VALUES
(3237, 34904, '2009-07-27 10:56:46', 1162, 237, '111-1', '111', '1', 2),
(8882, 36145, '2010-01-10 09:22:47', 2229, 341, '00000-0', '0000', '2', 1);
