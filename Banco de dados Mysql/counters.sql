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
-- Estrutura da tabela `counters`
--

CREATE TABLE IF NOT EXISTS `counters` (
  `code` char(150) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `counters`
--

INSERT INTO `counters` (`code`, `value`) VALUES
('bingo75_in', 5504301),
('bingo75_out', 2992519),
('bingo75_vip_in', 27785884),
('bingo75_vip_out', 16788435),
('bingomaster_in', 25326),
('bingomaster_out', 7585),
('bonusbingo_in', 45107),
('bonusbingo_out', 20558),
('carnaval_in', 913728),
('carnaval_out', 702780),
('cb2009_in', 2656624),
('cb2009_out', 1694875),
('circus_in', 1925483),
('circus_out', 1328494),
('egyptdiamonds_in', 5690665),
('egyptdiamonds_out', 7045918),
('fruitmania_in', 863929),
('fruitmania_out', 713779),
('halloween_in', 9694357),
('halloween_out', 6182997),
('lucky25_in', 116794),
('lucky25_out', 90798),
('megabingo_in', 87388),
('megabingo_out', 50810),
('nineballs_in', 1030958),
('nineballs_out', 769068),
('points_converted', 0),
('showbingoball_in', 590127),
('showbingoball_out', 230302),
('silverball_in', 2520874),
('silverball_out', 1951636),
('superbingo2008_in', 371397),
('superbingo2008_out', 341856),
('superbingo75_in', 28005),
('superbingo75_out', 5562),
('superbingo_in', 1942378),
('superbingo_out', 1424712),
('surprisebonus', 526402),
('treasuresoftheocean_in', 1965342),
('treasuresoftheocean_out', 1352342),
('turbo90_in', 450858),
('turbo90_out', 335796),
('videopoker_in', 9695),
('videopoker_out', 1371);
