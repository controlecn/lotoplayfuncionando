-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:37 AM
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
-- Estrutura da tabela `affliates_banks`
--

CREATE TABLE IF NOT EXISTS `affliates_banks` (
  `id` int(11) NOT NULL auto_increment,
  `number` varchar(10) default NULL,
  `name` varchar(200) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Extraindo dados da tabela `affliates_banks`
--

INSERT INTO `affliates_banks` (`id`, `number`, `name`) VALUES
(8, '356', 'Banco ABN Amro'),
(10, '1', 'Banco do Brasil'),
(36, '237', 'Bradesco'),
(41, '104', 'Caixa Econ. Federal'),
(86, '399', 'HSBC Bank'),
(95, '341', 'Itau'),
(113, '151', 'Nossa Caixa'),
(132, '353', 'Santander/Banespa'),
(138, '356', 'Sudameris/Real'),
(143, '409', 'Unibanco');
