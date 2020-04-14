-- phpMyAdmin SQL Dump
-- version 3.2.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Jan 10, 2010 as 10:37 AM
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
-- Estrutura da tabela `affliates_banners`
--

CREATE TABLE IF NOT EXISTS `affliates_banners` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `code` longtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `affliates_banners`
--

INSERT INTO `affliates_banners` (`id`, `name`, `code`) VALUES
(3, 'Banner 1', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="180" height="75" id="banner1" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner1.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" target="_blank" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#21014c" />\r\n<embed src="http://www.lotoplay.com/banners/banner1.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" target="_blank" quality="high" bgcolor="#21014c" width="180" height="75" name="banner1" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(4, 'Banner 2', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="468" height="60" id="banner2" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner2.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" target="_blank" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner2.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" target="_blank" quality="high" bgcolor="#ffffff" width="468" height="60" name="banner2" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(5, 'Banner 3', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="180" height="75" id="banner6" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner3.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner3.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" quality="high" bgcolor="#ffffff" width="180" height="75" name="banner6" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(6, 'Banner 4', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="468" height="60" id="banner4" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner4.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner4.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" quality="high" bgcolor="#ffffff" width="468" height="60" name="banner4" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(7, 'Banner 5', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="120" height="60" id="banner5" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner5.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner5.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" quality="high" bgcolor="#ffffff" width="120" height="60" name="banner5" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(8, 'Banner 6', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="468" height="60" id="banner6" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner6.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner6.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" quality="high" bgcolor="#ffffff" width="468" height="60" name="banner6" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(9, 'Banner 7', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="160" height="600" id="banner7" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner7.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner7.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" quality="high" bgcolor="#ffffff" width="160" height="600" name="banner7" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>'),
(10, 'Banner 8', '<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="468" height="60" id="banner8" align="middle">\r\n<param name="allowScriptAccess" value="always" />\r\n<param name="movie" value="http://www.lotoplay.com/banners/banner8.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" />\r\n<param name="quality" value="high" />\r\n<param name="bgcolor" value="#ffffff" />\r\n<embed src="http://www.lotoplay.com/banners/banner8.swf?movieUrl=http://www.lotoplay.com/games.php?affliateId=%%SOCIOID%%" quality="high" bgcolor="#ffffff" width="468" height="60" name="banner8" align="middle" allowScriptAccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />\r\n</object>');
