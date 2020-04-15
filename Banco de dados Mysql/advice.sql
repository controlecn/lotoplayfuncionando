-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:36 AM
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
-- Estrutura da tabela `advice`
--

CREATE TABLE IF NOT EXISTS `advice` (
  `id` int(11) NOT NULL auto_increment,
  `headline` char(240) character set utf8 collate utf8_unicode_ci NOT NULL,
  `story` longtext character set utf8 collate utf8_unicode_ci NOT NULL,
  `newsdate` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `advice`
--

INSERT INTO `advice` (`id`, `headline`, `story`, `newsdate`) VALUES
(2, 'Conheça o seu jogo!', 'Jogue apenas jogos que você conhece. Se você quer praticar, use o nosso modo de Free Play antes de colocar o seu dinheiro na máquina. Conheça as regras de cada jogo, conheça as apostas mínimas, máximas e conheça os prêmios. Se você tem alguma duvida sobre o funcionamento dos jogos, pergunte aos nossos atendentes no atendimento online.', '2009-09-13'),
(3, 'Jogue na sua velocidade', 'Não jogue tudo de uma vez só, jogue na sua velocidade. Jogos online tem a tendência de funcionar mais rápido do que você conhece no cassino ou na sala de bingo. Jogue na sua velocidade e lembre-se do entretenimento. Pense bem na sua estratégia durante o jogo e aposte com inteligencia.', '2009-09-13'),
(4, 'Mantenha o controle', 'Sucesso de qualquer apostador esta na palavra "controle". Jogue apenas com dinheiro que você pode perder, não jogue o dinheiro do aluguel ou da sua alimentação. Não corra atrás das suas perdas. Se você não esta com sorte hoje, tente outro dia, quando a sua sorte estiver maior. Não perca o controle e limite as suas apostas quando não for seu dia de sorte. Lembre-se: Maximize os seus prêmios e minimize as suas perdas. Não dobre as suas apostas para recuperar a perda, apenas quando sentir que é seu dia de sorte!', '2009-09-14'),
(5, 'Quer ganhar um acumulado?', 'Se você quer ganhar um acumulado, as suas melhores chances estão no jogos: Carnaval, Mania Das Frutas e Tesouros Do Mar. São os únicos jogos que você precisa de apenas 1 crédito apostado para concorrer o acumulado.', '2009-09-14'),
(6, 'Não compre todas as bolas extras', 'Quando você está jogando um dos nossos vídeo bingos, não compre todas as bolas extras se você não tiver chance de completar um prêmio sustentável. Comprando bolas extras para completar pequenos prêmios, vai fazer você perder. Mas se você tiver chance de completar um prêmio grande, compre todas as bolas.', '2009-09-14'),
(7, 'Se beber, não jogue', 'Não misture jogos com bebidas ou drogas. Na maioria dos cassinos em Las Vegas, as bebidas são graça. Por quê você acha que as bebidas são de graça? Você não joga tão bem quando bebe, e perde o controle com mais facilidade. Conheça o seu jogo, jogue bem e não beba durante os seus jogos.', '2009-09-14'),
(8, 'Resgate os seus prêmios', 'Planeje o momento que você vai parar. Se você depositar, por exemplo, R$ 20 e quer parar com R$ 40, pare quando chegar aos R$ 40. Seja qual for a sua decisão, tome uma atitude e pare quando chegar ao valor que você definir. Lembre-se: Sua sorte não vai durar para sempre.', '2009-09-14'),
(9, 'Divirta-se!', 'Depois de ter lido todas essas dicas, lembre-se que os jogos tem um valor máximo de entretenimento. Você está sendo seletivo(a) em sua diversão e proporcionando a você mesmo(a), momentos incríveis de diversão e adrenalina. LotoPlay deseja uma ótima diversão, e boa sorte!', '2009-09-13');
