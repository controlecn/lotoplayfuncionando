-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:40 AM
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
-- Estrutura da tabela `bingo75_rounds`
--

CREATE TABLE IF NOT EXISTS `bingo75_rounds` (
  `id` int(11) NOT NULL auto_increment,
  `round_time` datetime NOT NULL,
  `round_type` int(1) NOT NULL,
  `round_object` char(14) default NULL,
  `round_prize` int(11) NOT NULL,
  `round_vip` int(1) NOT NULL,
  `round_winners` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=394 ;

--
-- Extraindo dados da tabela `bingo75_rounds`
--

INSERT INTO `bingo75_rounds` (`id`, `round_time`, `round_type`, `round_object`, `round_prize`, `round_vip`, `round_winners`) VALUES
(1, '2009-10-27 20:00:00', 1, '', 1000, 2, 1),
(2, '2009-10-27 21:00:00', 1, '', 2000, 2, 1),
(393, '2009-12-31 23:00:00', 1, '', 4000, 2, 1);
