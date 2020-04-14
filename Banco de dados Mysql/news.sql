-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:52 AM
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
-- Estrutura da tabela `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL auto_increment,
  `headline` char(240) character set utf8 collate utf8_unicode_ci NOT NULL,
  `story` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `newsdate` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `news`
--

INSERT INTO `news` (`id`, `headline`, `story`, `newsdate`) VALUES
(1, 'NOVO LOTOPLAY!', 'Saudações! É com imenso prazer, que anunciamos a tão esperada atualização do LotoPlay! Novas promoções, benefícios, maior interatividade e fácil localização dos setores, é o que trazemos para você. Além de novas dicas, e prêmios maiores! Tudo isso é resultado de um trabalho de meses, em agradecimento aos inúmeros contatos recebidos, tanto de críticas, elogios, como os de dúvidas e agradecimento, que serviram para proporcionarmos a você, o que há de melhor em entretenimento de jogos online bingo, video bingos e cassinos. Continuaremos nosso trabalho de melhoria contínua, feito por jogadores para jogadores, pois nossa satisfação é sua diversão!', '2009-09-20');
