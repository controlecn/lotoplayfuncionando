-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:54 AM
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
-- Estrutura da tabela `points_transfers`
--

CREATE TABLE IF NOT EXISTS `points_transfers` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `transfertype` int(11) NOT NULL,
  `transferdate` datetime NOT NULL,
  `points` int(240) NOT NULL,
  `description` char(240) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30718 ;

--
-- Extraindo dados da tabela `points_transfers`
--

INSERT INTO `points_transfers` (`id`, `userid`, `transfertype`, `transferdate`, `points`, `description`) VALUES
(1, 1, 1, '2009-09-14 06:00:04', 20, 'Compra de créditos: R$ 20,03'),
(2, 1, 2, '2009-09-14 06:00:16', 63, 'Saque'),
(30717, 36145, 1, '2010-01-10 10:43:25', 150, 'Compra de créditos: R$ 150,01');
