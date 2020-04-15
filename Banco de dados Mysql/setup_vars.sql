-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:58 AM
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
-- Estrutura da tabela `setup_vars`
--

CREATE TABLE IF NOT EXISTS `setup_vars` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(40) default NULL,
  `value` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `setup_vars`
--

INSERT INTO `setup_vars` (`id`, `name`, `value`) VALUES
(1, 'bingo75_cardid', '22866288'),
(2, 'bingo75_jackpot_percents', '0.001'),
(3, 'bingo75_meganumbers', '55'),
(4, 'bingo75_mega_cardprice', '3'),
(5, 'bingo75_norm_cardprice', '2'),
(6, 'bingo75_prize_percents', '0.65'),
(7, 'bingo75_roundid', '33938'),
(8, 'bingo75_vip_cards_max', '40'),
(9, 'bingo75_vip_cards_min', '15'),
(10, 'bingo75_vip_onoff', '1'),
(11, 'bingo75_vip_players_max', '25'),
(12, 'bingo75_vip_players_min', '14'),
(13, 'friend_friend1', '200'),
(14, 'friend_friend2', '100'),
(15, 'friend_friend3', '40'),
(16, 'payment_forAffliates', '15'),
(17, 'payment_points', '1'),
(18, 'players_online', '11'),
(19, 'server_creditvalue', '0.25'),
(20, 'server_timedifference', '0'),
(21, 'surprise_bonus_active', '1'),
(22, 'surprise_bonus_max', '1.0'),
(23, 'surprise_bonus_min', '1.0');
