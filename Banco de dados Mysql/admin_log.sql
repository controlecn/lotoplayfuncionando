-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:36 AM
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
-- Estrutura da tabela `admin_log`
--

CREATE TABLE IF NOT EXISTS `admin_log` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(25) NOT NULL,
  `actionDate` datetime NOT NULL,
  `action` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42830 ;

--
-- Extraindo dados da tabela `admin_log`
--

INSERT INTO `admin_log` (`id`, `username`, `actionDate`, `action`) VALUES
(42563, 'jm', '2010-01-08 23:16:51', 'Compra Liberada. R$ 20,01. Banco: Banco Bradesco. 
(42828, 'kelly', '2010-01-10 10:31:06', 'Compra Liberada. R$ 20,01. Banco: Banco Caixa Economica. Usuario: catarina');
