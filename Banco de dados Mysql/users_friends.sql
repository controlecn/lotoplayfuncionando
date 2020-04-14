-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:12 AM
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
-- Estrutura da tabela `users_friends`
--

CREATE TABLE IF NOT EXISTS `users_friends` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) default NULL,
  `name` varchar(150) default NULL,
  `email` varchar(150) default NULL,
  `percentage` int(11) default NULL,
  `addedWhen` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5244 ;

--
-- Extraindo dados da tabela `users_friends`
--

INSERT INTO `users_friends` (`id`, `userId`, `name`, `email`, `percentage`, `addedWhen`) VALUES
(2, 6290, 'ratinho', 'testeteste@mai.com', 0, '2006-08-21 23:04:10'),
(5243, 43744, 'Maria Rosa', 'teste-email@teste.com.br', 0, '2010-01-10 10:15:20');
