-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:59 AM
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
-- Estrutura da tabela `testimonials`
--

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` int(11) NOT NULL auto_increment,
  `username` char(240) NOT NULL,
  `testimonial` longtext NOT NULL,
  `index` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `testimonials`
--

INSERT INTO `testimonials` (`id`, `username`, `testimonial`, `index`) VALUES
(1, 'CELMA37', 'Obrigado por me pagarem a premiação com  tanta agilidade, eu estava um pouco desconfiada, mas gostei de ver a seriedade de vocês, ganharam mais uma cliente!', 0),
(2, 'Antonio', 'Olha, vocês estão de parabéns, me atenderam de madrugada e conseguiram resolver meu problema, continuem assim!', 0),
(3, 'Helena', 'Adorei o novo site, ficou mais interativo e fácil de entender o funcionamento, parabéns!', 0),
(4, 'Juliana', 'Eu sempre joguei na lotoplay por que foi o unico site que consegui bons prêmios, com as novas promoções, ficou muito melhor, por favor não tirem! rs', 1),
(5, 'Monica', 'Amei o site, o atendimento, a interatividade do lotoplay junto a minha pessoa, esta sendo fantastico poder jogar de casa e contar com a facilidade de pagar e receber os créditos.', 0),
(6, 'Claudi@', 'Primeiramente, agradecer a todos pelo exímio atendimento, depois dizer que estou encantada com o novo designe do site eu diria Maravilhada, jogo aqui tem mais de 5 anos e sempre confiei e nunca tive problemas não resolvidos.Já me sinto da família lotoplay. Parabéns a todos.', 0);
