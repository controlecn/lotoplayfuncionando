-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:46 AM
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
-- Estrutura da tabela `emails`
--

CREATE TABLE IF NOT EXISTS `emails` (
  `code` char(150) NOT NULL,
  `subject` char(250) default NULL,
  `content` longtext,
  PRIMARY KEY  (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `emails`
--

INSERT INTO `emails` (`code`, `subject`, `content`) VALUES
('CHANGE_PASSWORD', 'Alteracao da sua senha', 'Para completar a alteração da sua senha, clique no link abaixo:<br>\r\n<a href="%%LINK%%">Completar a alteracao da sua senha</a>'),
('FRIENDS_EMAIL', 'Conheça o melhor site de bingo on-line do Brasil!', 'Encontrei um excelente site de diversão e lazer!\r\n\r\nComo sei que você adora jogar, fiz questão de lhe indicar o LotoPlay. Encontrei aqui segurança e bom atendimento, além de excelentes jogos. Disponibilizam bônus de 50% em todas as sua compras de crédito.\r\n\r\nO site possui um programa que indicação de amigos que estou utilizando para entrar em contato com você,  realize seu cadastro através desse e-mail, pois assim você e eu ganhamos bênus e prêmios. Recomendo que você faça o mesmo com seu grupo de amigos.\r\n\r\nAbraços!'),
('FORGOT_PASSWORD', 'Sua nova senha de accesso para Lotoplay', 'Seu apelido do LotoPlay: %%USERNAME%%<br><br>\r\n\r\nSua nova senha do LotoPlay: %%PASSWORD%%<br><br>');
