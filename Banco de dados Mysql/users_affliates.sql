-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:11 AM
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
-- Estrutura da tabela `users_affliates`
--

CREATE TABLE IF NOT EXISTS `users_affliates` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(250) NOT NULL default '',
  `url` varchar(250) NOT NULL default '',
  `telephone` varchar(15) default NULL,
  `login` varchar(15) default NULL,
  `password` varchar(32) default NULL,
  `email` varchar(150) default NULL,
  `payType` int(11) default NULL,
  `payBank` int(11) default NULL,
  `payAgent` varchar(20) default NULL,
  `payAccount` varchar(20) default NULL,
  `payAccountType` varchar(20) default NULL,
  `registerDate` date default NULL,
  `valid` int(11) default NULL,
  `validCode` varchar(32) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=205 ;

--
-- Extraindo dados da tabela `users_affliates`
--

INSERT INTO `users_affliates` (`id`, `name`, `url`, `telephone`, `login`, `password`, `email`, `payType`, `payBank`, `payAgent`, `payAccount`, `payAccountType`, `registerDate`, `valid`, `validCode`) VALUES
(3, 'ANTUNES CALCULOS', 'http://www.site.com.br', '0000-0000', 'antunes', '64bf547ae4913e892378926e524', '0000antunes@hotmail.com', 1, 104, '0009', '0000000', 'Poupanca', '2006-07-31', 1, '4e2587de5cb60ff0c97f07e77932bab8'),
(204, 'Paulo Henrique', '000000.hdfree.com.br', '(11)0000-0000', 'phxpert', 'd41d84348f00b204e98000986789034e', '010101010@gmail.com', 1, 151, '0000', '000000-0', '1', '2010-01-10', NULL, NULL);
