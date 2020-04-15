-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:42 AM
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
-- Estrutura da tabela `buy_values`
--

CREATE TABLE IF NOT EXISTS `buy_values` (
  `id` int(11) NOT NULL auto_increment,
  `value` int(11) default NULL,
  `moneyValue` varchar(10) default NULL,
  `name` varchar(150) default NULL,
  `bonus` int(11) NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `buy_values`
--

INSERT INTO `buy_values` (`id`, `value`, `moneyValue`, `name`, `bonus`) VALUES
(1, 80, '20', 'R$ 20,00 - 80 creditos', 50),
(2, 100, '25', 'R$ 25,00 - 100 creditos', 50),
(3, 120, '30', 'R$ 30,00 - 120 creditos', 50),
(4, 140, '35', 'R$ 35,00 - 140 creditos', 50),
(5, 160, '40', 'R$ 40,00 - 160 creditos', 50),
(6, 180, '45', 'R$ 45,00 - 180 creditos', 50),
(7, 200, '50', 'R$ 50,00 - 200 creditos', 50),
(8, 240, '60', 'R$ 60,00 - 240 creditos', 50),
(9, 280, '70', 'R$ 70,00 - 280 creditos', 50),
(10, 320, '80', 'R$ 80,00 - 320 creditos', 50),
(11, 360, '90', 'R$ 90,00 - 360 creditos', 50),
(12, 400, '100', 'R$ 100,00 - 400 creditos', 50),
(13, 600, '150', 'R$ 150,00 - 600 creditos', 50),
(14, 800, '200', 'R$ 200,00 - 800 creditos', 50),
(15, 1000, '250', 'R$ 250,00 - 1000 creditos', 50),
(16, 1200, '300', 'R$ 300,00 - 1200 creditos', 50),
(17, 1400, '350', 'R$ 350,00 - 1400 creditos', 50),
(18, 1600, '400', 'R$ 400,00 - 1600 creditos', 50),
(19, 1800, '450', 'R$ 450,00 - 1800 creditos', 50),
(20, 2000, '500', 'R$ 500,00 - 2000 creditos', 50),
(21, 2400, '600', 'R$ 600,00 - 2400 creditos', 75),
(22, 2800, '700', 'R$ 700,00 - 2800 creditos', 75),
(23, 3200, '800', 'R$ 800,00 - 3200 creditos', 75),
(24, 3600, '900', 'R$ 900,00 - 3600 creditos', 75),
(25, 4000, '1000', 'R$ 1000,00 - 4000 creditos', 100);
