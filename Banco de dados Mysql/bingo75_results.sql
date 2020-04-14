-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:39 AM
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
-- Estrutura da tabela `bingo75_results`
--

CREATE TABLE IF NOT EXISTS `bingo75_results` (
  `id` int(11) NOT NULL auto_increment,
  `bingoDate` datetime NOT NULL default '0000-00-00 00:00:00',
  `gameId` int(11) NOT NULL default '0',
  `players` int(11) NOT NULL default '0',
  `cards` int(11) NOT NULL default '0',
  `jackpot` char(150) NOT NULL,
  `balls` int(2) NOT NULL default '0',
  `winnersId` varchar(250) NOT NULL,
  `winnersPrize` varchar(250) NOT NULL,
  `winnersCards` varchar(250) NOT NULL,
  `winnersNumbers` longtext,
  `gameTime` int(3) NOT NULL default '0',
  `gameEnds` datetime default NULL,
  `resultWhen` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=85331 ;

--
-- Extraindo dados da tabela `bingo75_results`
--

INSERT INTO `bingo75_results` (`id`, `bingoDate`, `gameId`, `players`, `cards`, `jackpot`, `balls`, `winnersId`, `winnersPrize`, `winnersCards`, `winnersNumbers`, `gameTime`, `gameEnds`, `resultWhen`) VALUES
(81295, '2009-12-27 10:20:00', 29898, 20, 483, '627', 31, 'Antunes', '627', '19877861', '3,4,9,11,12,16,17,18,19,24,36,41,42,43,46,53,56,58,60,62,64,66,72,73', 62, '2009-12-27 10:21:02', '2009-12-27 10:20:00'),
(85330, '2010-01-10 10:35:00', 33933, 21, 597, '776', 35, 'Sem_medo', '776', '22863264', '3,4,5,6,10,16,19,23,24,30,31,32,43,45,52,53,54,55,56,61,63,64,68,71', 70, '2010-01-10 10:36:10', '2010-01-10 10:35:00');
