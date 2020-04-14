-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:39 AM
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
-- Estrutura da tabela `balanco_vendas`
--

CREATE TABLE IF NOT EXISTS `balanco_vendas` (
  `id` int(11) NOT NULL auto_increment,
  `dia` int(11) NOT NULL,
  `boughtid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `value` int(11) NOT NULL,
  `cents` int(11) NOT NULL,
  `bank` int(11) NOT NULL,
  `doc` char(240) NOT NULL,
  `confirmed` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=313 ;

--
-- Extraindo dados da tabela `balanco_vendas`
--

INSERT INTO `balanco_vendas` (`id`, `dia`, `boughtid`, `userid`, `value`, `cents`, `bank`, `doc`, `confirmed`) VALUES
(1, 1, 60190, 43472, 300, 1, 45, 'XX', 0),
(312, 2, 60662, 20305, 70, 1, 38, 'ddd3', 0);
