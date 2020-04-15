-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:50 AM
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
-- Estrutura da tabela `fraud_comments`
--

CREATE TABLE IF NOT EXISTS `fraud_comments` (
  `id` int(11) NOT NULL auto_increment,
  `operator` char(140) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=109 ;

--
-- Extraindo dados da tabela `fraud_comments`
--

INSERT INTO `fraud_comments` (`id`, `operator`, `user_id`, `comment_date`, `comment`) VALUES
(1, 'kk', 1, '2009-07-22 10:55:03', 'teste'),
(108, 'kk', 43087, '2010-01-02 23:41:13', 'problematica');
