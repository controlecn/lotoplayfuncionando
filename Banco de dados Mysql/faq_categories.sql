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
-- Estrutura da tabela `faq_categories`
--

CREATE TABLE IF NOT EXISTS `faq_categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(150) default NULL,
  `description` longtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `name`, `description`) VALUES
(1, 'Como faco o Cadastro', 'Acesse a area cadastre-se e siga as instruções passo a passo para poder usufruir o maximo de nossos jogos.'),
(2, 'Como adquirir creditos.', 'Acesse nossa area de COMPRAS e siga as instruções no local passo-a-passo, para realizar uma compra segura facil, e rapida.'),
(3, 'Sacar  Prêmios', 'Resgate os seus atraves de transferencias, doc, ted ou deposito bancarios. diretamente depositados em sua conta, normalmente em ate 48 horas no horario comercial. Lembramos que os valores dos premios sao pagos o que voce solicitar ja estara deduzido todos os impostos.'),
(4, 'Segurança total..', 'Todo o site, possui um sistema proprio de criptografia e seguranca.'),
(5, 'Suporte.', 'Estamos prontos para ajudar passo-a-passo, acesse nossa area de ajuda on-line.'),
(6, 'Institucional', 'Quem somos, Club, Amigos, horário de funcionamento, jogos, bonus premios.');
