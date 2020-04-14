-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:11 AM
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
-- Estrutura da tabela `users_changepassword`
--

CREATE TABLE IF NOT EXISTS `users_changepassword` (
  `id` int(11) NOT NULL auto_increment,
  `userid` int(11) NOT NULL,
  `newpassword` char(32) NOT NULL,
  `verifykey` char(32) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=195 ;

--
-- Extraindo dados da tabela `users_changepassword`
--

INSERT INTO `users_changepassword` (`id`, `userid`, `newpassword`, `verifykey`) VALUES
(5, 37121, '9d433c3f8976982367772750ea8f48f0', '2f75c87ccc67a54234264653a40f5d05'),
(184, 43606, '296178897236984623986cbad83397d5', 'cd8234242423cecd63b223015d69fd12');
