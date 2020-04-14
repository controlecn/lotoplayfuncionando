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

menuItemDropDown($lang_leftmenu_users, 1);
menuItem2($lang_leftmenu_users_active, "users/active.php", 1);
menuItem2("Deletados", "users/deleted.php", 2);
menuItem2("Baneados", "users/banned.php", 2);
menuItem2("Testes", "users/testusers.php", 2);
menuItem2("Procurar...", "users/find.php", 1);
menuItemDropDownEnd(1);

menuItem("Balanço do dia", "balanco/dia_step1.php", 1);
menuItem4("Google Analytics", "https://www.google.com/analytics/reporting/",2);

menuItemDropDown("Relatórios", 2);
menuItem2("Vendas do dia", "reports/sales_day.php", 2);
menuItem5("Vendas do mês", "reports/sales_month.php", 2);
menuItem2("Vendas do mês (Lista)", "reports/sales_month_list.php", 2);
menuItem2("Cadastros", "reports/registrations.php", 2);
menuItem2("Saldo, Bônus & Pontos", "reports/credits_bonus.php", 2);
menuItem2("Pagamentos de jogos", "reports/games.php", 2);
menuItem2("Outras informações", "reports/other.php", 2);
menuItemDropDownEnd(2);

?>
</table>

</td></tr></table>
</body>
</html>