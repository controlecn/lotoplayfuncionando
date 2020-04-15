-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:00 AM
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
-- Estrutura da tabela `tickets_accounts`
--

CREATE TABLE IF NOT EXISTS `tickets_accounts` (
  `id` int(11) NOT NULL auto_increment,
  `server` char(250) NOT NULL,
  `port` int(11) NOT NULL,
  `username` char(250) NOT NULL,
  `password` char(250) NOT NULL,
  `from_email` char(250) NOT NULL,
  `from_name` char(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tickets_accounts`
--

INSERT INTO `tickets_accounts` (`id`, `server`, `port`, `username`, `password`, `from_email`, `from_name`) VALUES
(1, 'localhost', 25, 'email1+email.com', 'senha', 'email1@email.com', 'LotoPlay.com'),
(2, 'localhost', 25, 'email2+email.com', 'senha', 'email2@email.com', 'LotoPlay.com');
