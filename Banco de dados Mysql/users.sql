-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:09 AM
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
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `fullname` varchar(200) NOT NULL default '',
  `username` varchar(30) default NULL,
  `password` varchar(32) default NULL,
  `email` varchar(200) default NULL,
  `ssn` char(20) default NULL,
  `address` varchar(240) default NULL,
  `citypart` varchar(240) default NULL,
  `zipcode` varchar(15) default NULL,
  `telephone` varchar(100) default NULL,
  `day` int(11) default NULL,
  `month` int(11) default NULL,
  `year` int(11) default NULL,
  `sex` int(11) default NULL,
  `city` varchar(150) default NULL,
  `state` char(2) default NULL,
  `affliateId` int(11) default '0',
  `friendId` int(11) default '0',
  `joinedWhen` datetime default NULL,
  `lastActive` datetime default NULL,
  `ip` varchar(15) default NULL,
  `super` int(11) default '0',
  `b75_voice` int(11) NOT NULL default '1',
  `b75_avatar` int(11) NOT NULL default '1',
  `b75_marker` int(11) NOT NULL default '1',
  `credits` int(11) NOT NULL default '0',
  `bonus` int(11) NOT NULL default '0',
  `logged` int(1) NOT NULL default '0',
  `captcha` int(1) NOT NULL default '0',
  `points` int(11) NOT NULL default '0',
  `payout_bank` int(11) NOT NULL default '0',
  `payout_agent` char(150) default NULL,
  `payout_account` char(150) default NULL,
  `payout_type` int(11) NOT NULL default '0',
  `marketing` int(1) NOT NULL default '0',
  `newsletter` int(1) NOT NULL default '0',
  `ban` int(1) NOT NULL default '0',
  `delete` int(1) NOT NULL default '0',
  `test` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43759 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `email`, `ssn`, `address`, `citypart`, `zipcode`, `telephone`, `day`, `month`, `year`, `sex`, `city`, `state`, `affliateId`, `friendId`, `joinedWhen`, `lastActive`, `ip`, `super`, `b75_voice`, `b75_avatar`, `b75_marker`, `credits`, `bonus`, `logged`, `captcha`, `points`, `payout_bank`, `payout_agent`, `payout_account`, `payout_type`, `marketing`, `newsletter`, `ban`, `delete`, `test`) VALUES
(135, 'Marcio', 'Marcinho', '699cca5d4e2099231a222224056454ad', 'xxxxxxxxxxxxxxx', 'xxxxxxxx', 'xxxxxxxxxxxx', 'xxx', 'xxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxx', 0, 1, 1935, 2, 'Rio De Janeiro', 'SP', 0, 0, '2006-05-03 21:20:33', '2009-12-07 12:56:59', '201.76.234.101', 0, 1, 6, 4, 6726, 4000, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 1),
(43758, 'yuri silva', 'Yuri', '2ace2c441b4b9c6874198235489238d6', 'yuri@email.com', NULL, NULL, NULL, NULL, NULL, 20, 8, 1988, 1, NULL, NULL, 0, 0, '2010-01-10 10:23:30', '2010-01-10 10:30:55', '201.5.15.182', 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, NULL, NULL, 0, 2, 0, 0, 0, 0);
