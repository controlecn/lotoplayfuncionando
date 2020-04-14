-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 11:04 AM
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
-- Estrutura da tabela `tickets_emails`
--

CREATE TABLE IF NOT EXISTS `tickets_emails` (
  `id` int(11) NOT NULL auto_increment,
  `nome` char(150) NOT NULL,
  `email` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `tickets_emails`
--

INSERT INTO `tickets_emails` (`id`, `nome`, `email`) VALUES
(1, 'INICIO_F', 'Olá %%NOME%%,\r\n\r\nObrigado por nos ter contactado. O meu nome é Castilho e vou assisti-la hoje.'),
(2, 'INICIO_M', 'Olá %%NOME%%,\r\n\r\nObrigado por nos ter contactado. O meu nome é Castilho e vou assisti-lo hoje.'),
(3, 'FINAL', 'Para uma assistência cordial e imediata, sobre esse ou qualquer outro assunto, por favor, contate o nosso Atendimento Online. Você poderá ainda enviar um email para: email2@email.com para falar diretamente com a gerencia.\r\n\r\nObrigado por ser nosso jogador associado e pela confiança que depositou em nós. Por favor contate-nos sempre que necessitar de assistência.\r\n\r\n<b>Atentamente,</b>\r\nCastilho.\r\n<i>Serviço de Apoio ao Cliente</i>\r\n\r\nO nosso Departamento de Apoio estará disponível 24 por dia, 7 dias por semana para o assistir, através do email suporte@lotoplay.com'),
(4, 'DESCULPA', '%%NOME%%, primeiramente nós nos desculpamos por qualquer inconveniência causada. '),
(5, 'CREDITOS_LIBERADOS', '%%NOME%%, eu quero acradecer a paciência do aguardo em espera na liberação da compra. Informamos que os créditos estão disponível na sua conta a sua disposição. '),
(6, 'CADASTRO_NAO_LOCALIZADO', 'Infelizmente não foi possível localizar a sua conta com as informações que você nos enviou. Envie o nome de usuário e o endereço de e-mail que você registrou, para que possamos localizar os seus registros e ajudá-lo.\r\n\r\nEsperamos ter notícias suas em breve.'),
(12, 'MODO_FREE', '%%NOME%%, primeiramente nós nos desculpamos por qualquer inconveniência causada, mas o nosso modo Free-Play esta em manutenção no momento.');
