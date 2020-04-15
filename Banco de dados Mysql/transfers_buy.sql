-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:08 AM
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
-- Estrutura da tabela `transfers_buy`
--

CREATE TABLE IF NOT EXISTS `transfers_buy` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL default '0',
  `bankId` int(11) NOT NULL default '0',
  `value` int(11) NOT NULL default '0',
  `cents` int(11) NOT NULL default '0',
  `affliateId` int(11) default NULL,
  `boughtWhen` datetime default NULL,
  `status` int(11) NOT NULL default '0',
  `doc` char(240) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60707 ;

--
-- Extraindo dados da tabela `transfers_buy`
--

INSERT INTO `transfers_buy` (`id`, `userId`, `bankId`, `value`, `cents`, `affliateId`, `boughtWhen`, `status`, `doc`) VALUES
(28208, 36401, 30, 50, 1, 0, '2009-07-27 21:19:40', 2, '000000'),
(28322, 28791, 30, 100, 2, 0, '2009-07-26 07:55:43', 2, NULL),
(60706, 33977, 34, 50, 1, 0, '2010-01-10 11:07:22', 1, '60706');
