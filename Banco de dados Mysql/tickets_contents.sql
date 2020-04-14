-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:03 AM
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
-- Estrutura da tabela `tickets_contents`
--

CREATE TABLE IF NOT EXISTS `tickets_contents` (
  `id` int(11) NOT NULL auto_increment,
  `ticket_id` int(11) NOT NULL,
  `content_time` datetime NOT NULL,
  `content_type` int(1) NOT NULL,
  `contents` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24122 ;

--
-- Extraindo dados da tabela `tickets_contents`
--

INSERT INTO `tickets_contents` (`id`, `ticket_id`, `content_time`, `content_type`, `contents`) VALUES
(218, 82, '2009-10-05 16:53:57', 1, 'MessagebodyLive Support Message Delivery:\r<br>-------------------------------------------\r<br>\r<br>qomo poso adiquiri credito com faso o pagamento\r<br>'),
(354, 110, '2009-10-06 11:09:44', 2, 'Olá,\r\n\r\nO opção de cartões Visa e Visa electron esta em reforma no momento, mas vai estar disponível em breve.'),
(24121, 2138, '2010-01-10 08:27:40', 1, 'irene das graças de moura coelho:<br><br>60584');
