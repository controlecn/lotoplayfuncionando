-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:05 AM
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
-- Estrutura da tabela `transfers`
--

CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int(11) NOT NULL auto_increment,
  `userId` int(11) NOT NULL default '0',
  `transferDate` datetime default NULL,
  `value` int(11) NOT NULL default '0',
  `transferType` int(1) NOT NULL default '1',
  `information` char(110) NOT NULL default '''''',
  `affliateId` int(11) default NULL,
  `bonus` int(1) NOT NULL default '0',
  `buy` int(1) NOT NULL default '0',
  `game` int(1) NOT NULL default '0',
  `gameid` int(1) NOT NULL default '0',
  `bet` int(1) NOT NULL default '0',
  `prize` int(1) NOT NULL default '0',
  `payout` int(1) NOT NULL default '0',
  `boughtid` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=265927 ;

--
-- Extraindo dados da tabela `transfers`
--

INSERT INTO `transfers` (`id`, `userId`, `transferDate`, `value`, `transferType`, `information`, `affliateId`, `bonus`, `buy`, `game`, `gameid`, `bet`, `prize`, `payout`, `boughtid`) VALUES
(1, 42792, '2010-01-03 10:16:55', 20, 1, 'Diamantes da Kleopatra: Aposta', NULL, 0, 0, 8, 0, 1, 0, 0, 0),
(2, 10012, '2010-01-03 10:16:56', 6, 1, 'Bingo Tradicional 75: Aposta', NULL, 0, 0, 1, 31914, 1, 0, 0, 0),
(265917, 42244, '2010-01-10 11:05:19', 8, 2, 'Diamantes da Kleopatra: Prêmio', NULL, 0, 0, 8, 0, 0, 1, 0, 0);
