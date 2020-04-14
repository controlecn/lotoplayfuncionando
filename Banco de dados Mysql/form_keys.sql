-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:48 AM
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
-- Estrutura da tabela `form_keys`
--

CREATE TABLE IF NOT EXISTS `form_keys` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `code` char(32) NOT NULL,
  `key` char(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=175866 ;

--
-- Extraindo dados da tabela `form_keys`
--

INSERT INTO `form_keys` (`id`, `created`, `code`, `key`) VALUES
(175639, '2010-01-10 01:18:10', 'ACCOUNT_LOGIN', 'a6ae1657292b95dba898eee0399e5c57'),
(175694, '2010-01-10 02:19:51', 'ACCOUNT_LOGIN', '558924c8b8d4178ebf4a59581e1adb00'),
(175865, '2010-01-10 10:44:36', 'ACCOUNT_PAY', '0861cde49aa04a2adc8af5b65d03eb8c');
