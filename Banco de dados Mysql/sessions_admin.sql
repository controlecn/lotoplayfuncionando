-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:57 AM
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
-- Estrutura da tabela `sessions_admin`
--

CREATE TABLE IF NOT EXISTS `sessions_admin` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `sessionkey` char(32) NOT NULL,
  `username` char(150) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1379 ;

--
-- Extraindo dados da tabela `sessions_admin`
--

INSERT INTO `sessions_admin` (`id`, `created`, `sessionkey`, `username`) VALUES
(1, '2009-09-14 05:40:31', 'd9fe133d054d32d4e5261c09479809be', 'Carlos'),
(2, '2009-09-14 08:06:50', '1f6cb1d324460dc24ae7b3813c3a4892', 'Michel'),
(1378, '2010-01-10 09:53:16', '5fd3a3fa9eb36b44ba148bd6387fac29', 'Marcos');
