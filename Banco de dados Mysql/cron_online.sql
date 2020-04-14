-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:43 AM
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
-- Estrutura da tabela `cron_online`
--

CREATE TABLE IF NOT EXISTS `cron_online` (
  `hours` int(11) NOT NULL,
  `players` int(11) NOT NULL,
  PRIMARY KEY  (`hours`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cron_online`
--

INSERT INTO `cron_online` (`hours`, `players`) VALUES
(0, 36),
(1, 30),
(2, 24),
(3, 16),
(4, 12),
(5, 8),
(6, 6),
(7, 10),
(8, 20),
(9, 28),
(10, 34),
(11, 38),
(12, 25),
(13, 38),
(14, 46),
(15, 58),
(16, 64),
(17, 70),
(18, 56),
(19, 40),
(20, 56),
(21, 68),
(22, 50),
(23, 42);
