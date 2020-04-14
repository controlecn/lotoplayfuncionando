-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:41 AM
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
-- Estrutura da tabela `bonus_results`
--

CREATE TABLE IF NOT EXISTS `bonus_results` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `qt` int(11) NOT NULL,
  `resultdate` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2674 ;

--
-- Extraindo dados da tabela `bonus_results`
--

INSERT INTO `bonus_results` (`id`, `userid`, `qt`, `resultdate`) VALUES
(1, 38034, 39, '2009-09-14 06:00:00'),
(2, 12374, 651, '2009-09-14 07:00:01'),
(2673, 41188, 20, '2010-01-10 10:00:01');
