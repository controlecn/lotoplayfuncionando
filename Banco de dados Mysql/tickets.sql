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
-- Estrutura da tabela `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL auto_increment,
  `account_id` int(11) NOT NULL,
  `subject` longtext,
  `status` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `email` longtext,
  `ticket_type` int(11) NOT NULL,
  `ticket_date` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3000 ;

--
-- Extraindo dados da tabela `tickets`
--

INSERT INTO `tickets` (`id`, `account_id`, `subject`, `status`, `userid`, `email`, `ticket_type`, `ticket_date`) VALUES
(47, 7, 'COMPROVANTE DE TRANSAC?A?O BANCA?RIA', 2, 0, 'InternetBanking@bradesco.com.br', 1, '2009-10-05 12:32:41'),
(100, 1, 'Liberação de créditos', 2, 39553, 'email1@email.com', 1, '2009-10-05 19:24:08'),
(101, 1, 'Reclamação', 2, 38389, 'email2@email.com', 1, '2009-10-05 19:36:38'),
(2999, 1, 'Liberação de créditos', 1, 36810, 'email3@email.com', 1, '2010-01-09 15:59:28');
