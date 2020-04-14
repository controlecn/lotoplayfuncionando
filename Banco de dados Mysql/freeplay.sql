-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 08, 2010 as 02:20 AM
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
-- Estrutura da tabela `freeplay`
--

CREATE TABLE IF NOT EXISTS `freeplay` (
  `id` int(11) NOT NULL auto_increment,
  `ip` char(15) NOT NULL,
  `session_start` datetime NOT NULL,
  `credits` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6896 ;

--
-- Extraindo dados da tabela `freeplay`
--

INSERT INTO `freeplay` (`id`, `ip`, `session_start`, `credits`) VALUES
(6879, '201.13.64.97', '2010-01-07 06:08:57', 0),
(6895, '200.134.13.16', '2010-01-07 20:25:22', 10000);
