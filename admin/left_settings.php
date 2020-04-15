<? include('include_functions.php'); ?>
<html>
<head>
<title><?=$lang_system_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/styles.css" rel="stylesheet" type="text/css">
<script>

function changeElement (element) {
	if (document.getElementById(element).style.display=='none') {
		document.getElementById(element).style.display = 'block';
	} else {
		document.getElementById(element).style.display = 'none';
	}
}
</script>
</head>

<body bgcolor="#dde8f0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center">

<table width="187" border="0" cellspacing="0" cellpadding="0">

<?

menuItemDropDown($lang_leftmenu_techinfo,2);
menuItem5($lang_leftmenu_techinfo_phpmyadmin, "phpmyadmin_63c65a225858cdebfccdf60f279b4372123/",2);
menuItem2($lang_leftmenu_techinfo_flashtracer, "techinfo/tracer2.swf",2);
menuItem2($lang_leftmenu_techinfo_phpinfo, "techinfo/phpinfo.php",2);
menuItem2("XML Servidor", "xmlserver/status.php",2);
menuItemDropDownEnd(2);

menuItemDropDown("Conteúdo",2);
menuItem2("E-Mails", "settings/email_overview.php",2);
menuItem2("Páginas", "settings/content_overview.php",2);
menuItem2("Texto", "settings/strings.php",2);
menuItem2("Notícias", "settings/news.php",2);
menuItem2("Testemunhas", "settings/testimonials.php",2);
menuItem2("Dicas", "settings/advice.php",2);
menuItemDropDownEnd(2);

menuItem($lang_leftmenu_cpanel, "http://www.reidobingo-net.umbler.net/cpanel/",2);

?>
</table>

</td></tr></table>
</body>
</html>