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

menuItemDropDown($lang_leftmenu_affliates,2);
menuItem2($lang_leftmenu_affliates_registrations, "affliates/overview.php",2);
menuItem2($lang_leftmenu_affliates_sales, "affliates/transfers.php",2);
menuItem2($lang_leftmenu_affliates_banners, "affliates/banners.php",2);
menuItem2($lang_leftmenu_affliates_statistics, "affliates/statistics.php",2);
menuItem2("Relatório do mês", "affliates/report.php",2);
menuItemDropDownEnd(2);

menuItemDropDown($lang_leftmenu_friends,2);
menuItem2($lang_leftmenu_friends_statistics, "friends/statistics.php",2);
menuItem2($lang_leftmenu_friends_configuration, "friends/options.php",2);
menuItemDropDownEnd(2);

menuItemDropDown("Bônus Surpresa",2);
menuItem2("Resultados", "surprise_bonus/results.php",2);
menuItem2("Configuração", "surprise_bonus/options.php",2);
menuItemDropDownEnd(2);

menuItemDropDown("Email Marketing",2);
menuItem2("Enviar para todos", "emailmarketing/send.php",2);
menuItem2("Emails Prontos", "emailmarketing/emails_overview.php",2);
menuItemDropDownEnd(2);

menuItem("Pontos - Produtos", "points/points.php",2);

?>
</table>

</td></tr></table>
</body>
</html>