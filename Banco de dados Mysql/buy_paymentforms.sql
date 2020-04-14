-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:41 AM
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
-- Estrutura da tabela `buy_paymentforms`
--

CREATE TABLE IF NOT EXISTS `buy_paymentforms` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(120) NOT NULL default '',
  `name_short` char(150) default NULL,
  `information` longtext,
  `onlinebankurl` varchar(150) default NULL,
  `onlinebanktext` varchar(150) default NULL,
  `disabled` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1002 ;

--
-- Extraindo dados da tabela `buy_paymentforms`
--

INSERT INTO `buy_paymentforms` (`id`, `name`, `name_short`, `information`, `onlinebankurl`, `onlinebanktext`, `disabled`) VALUES
(34, 'Banco Unibanco', 'Unibanco', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco Unibanco<br>	\r\n<b>Ag.:</b> 8259 <br>	\r\n<b>C/C:</b> 101397-2<br>	\r\n<b>Correntista:</b> Play Net Entretenimento Ltda.<br>	\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência', 'http://www.unibanco.com.br', 'Home Bank Unibanco', 0),
(38, 'Banco HSBC ', 'HSBC', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco HSBC<br>	\r\n<b>Ag.:</b>0171 <br>	\r\n<b>C/C:</b>00143-58<br>	\r\n<b>Correntista:</b> Play net entretenimento  ltda - me<br>\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência\r\n', 'http://www.hsbc.com.br', 'Home Bank HSBC', 0),
(35, 'Banco Itau', 'Itau', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco Itau<br>	\r\n<b>Ag.:</b> 1637 <br>	\r\n<b>C/C:</b> 25957-1<br>	\r\n<b>Correntista:</b> Play Net Entretenimento Ltda.<br>	\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência', 'http://www.itau.com.br', 'Home Bank Itau', 0),
(30, 'Banco Caixa Economica', 'Caixa', 'Realize o pagamento para: <br>		\r\n<b>Banco:</b> banco Caixa Economica<br>		\r\n<b>Ag.:</b> 1814 <br>\r\n<b>Op.:</b> 022 <br>		\r\n<b>C/C:</b> 79-4<br>		\r\n<b>Correntista:</b> Play Net Hosting Ltda.<br>		\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>		\r\n• Anote os dados para transferência\r\n<br><br>\r\n<B>ATENÇÃO - CLIENTES CAIXA ECONÔMICA: LIBERAÇÃO DE CRÉDITOS APENAS DURANTE O HORARIO BANCÁRIO. CAIXA NÃO ATUALIZA SALDOS DURANTE A NOITE OU FINAIS DE SEMANA. OBRIGADO E DESCULPE-NOS PELOS TRANSTORNOS.</B>', 'http://www.caixa.gov.br', 'Home Bank Caixa Economica Federal', 0),
(39, 'Banco Santander/Banespa', 'Santander', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco Santander/Banespa<br>	\r\n<b>Ag: 0090 tipo:13 conta: 007692-3</b> Play Hosting  LTDA-ME<br>	\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência 	\r\n', 'http://www.santander.com.br', 'Home bank Santander', 0),
(42, 'Banco Nossa Caixa', 'NCaixa', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco Nossa Caixa<br>	\r\n<b>Ag: 0410-3 tipo: 04 conta: 002266-3</b> \r\n<b>Correntista:</b> vivabem Entretenimento Ltda -ME.<br>\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência	\r\n', 'http://www.nossacaixa.com.br', 'Home Bank Nossa Caixa', 0),
(47, 'Banco do Brasil', 'BB', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco do Brasil<br>	\r\n<b>Ag.:</b> 0637-8<br>	\r\n<b>C/C:</b> 64806-X<br>	\r\n<b>Correntista:</b> Play net entretenimento  Ltda.<br>	\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência', 'http://www.bb.com.br', 'Home Bank do Brasil', 0),
(48, 'Banco Real', 'Real', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco Real<br>	\r\n<b>Ag.:</b> 1545 <br>	\r\n<b>C/C:</b>9004890-8<br>	\r\n<b>Correntista:</b> Play Net Entretenimento Ltda.<br>	\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência\r\n<br>\r\n<B>ATENÇÃO - CLIENTES BANCO REAL: LIBERAÇÃO DE CRÉDITOS APENAS ATE MEIA NOITE. BANCO REAL NÃO ATUALIZA SALDOS DURANTE A NOITE. OBRIGADO E DESCULPE-NOS PELOS TRANSTORNOS.</B>', 'http://www.bancoreal.com.br', 'Accesse Banco Real', 0),
(45, 'Banco Bradesco', 'Bradesco', 'Realize o pagamento para: <br>	\r\n<b>Banco:</b> Banco Bradesco<br>	\r\n<b>Ag.:</b> 2466-0 <br>	\r\n<b>C/C:</b> 20445-5<br>	\r\n<b>Correntista:</b> Play Net Entretenimento Ltda.<br>	\r\nObs: Deposite o valor exato, será identificado pelos centavos.<br>	\r\n• Anote os dados para transferência', 'http://www.bradesco.com.br', 'Acesse Bradesco', 0),
(1001, 'ClickAndBuy', 'C&B', 'ClickAndBuy', 'www.clickandbuy.com', 'ClickAndBuy', 1);
