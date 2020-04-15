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

menuItemDropDown($lang_leftmenu_livesupport, 1);
menuItem2("PHPLive Suporte", "../support/", 1);
menuItem2("PHPLive Configuração", "../support/setup/", 2);
menuItemDropDownEnd(1);

menuItemDropDown("Tickets",2);
menuItem2("Atualizar", "tickets/tickets_updates.php",2);
menuItem2("Tickets Abertos", "tickets/tickets_abertos.php",2);
menuItem2("Tickets Fechados", "tickets/tickets_fechados.php",2);
menuItem2("Novo ticket", "tickets/tickets_novo.php",2);
menuItem2("Respostas prontas", "tickets/respostas_overview.php",2);
menuItem2("Contas Ativas", "tickets/accounts_overview.php",2);
menuItemDropDownEnd(2);

menuItem("Enviar mensagem", "tickets/send_message.php",1);

menuItemDropDown($lang_leftmenu_faq,2);
menuItem2($lang_leftmenu_faq_categories, "faq/categories.php",2);
menuItem2($lang_leftmenu_faq_addcategory, "faq/categories_add.php",2);
menuItemDropDownEnd(2);

menuItemDropDown("Prevenção de Fraude",2);
menuItem2("Alertas de fraude", "security/fraud_detection.php",2);
menuItem2("IP Ban", "security/ban_ip.php",2);
menuItem2("Email Ban", "security/ban_email.php",2);
menuItemDropDownEnd(2);

menuItem("Forum", "https://www.reidobingo-net.umbler.net/admin_mais_complicado/forum/",1);
//menuItem("Programa de avisos", "https://www.reidobingo-net.umbler.net/admin_mais_complicado/LPTray.exe",1);

menuItemDropDown("Log",2);
menuItem2("Admin Log", "log/admin_log.php",2);
menuItem2("Chat Log", "log/phplive_log.php",2);
menuItemDropDownEnd(2);

menuItemDropDown("Cursos",1);
menuItem2("Compras", "https://www.reidobingo-net.umbler.net/admin_mais_complicado/cursos/compras.swf",1);
menuItem2("Fraude e Commentários", "https://www.reidobingo-net.umbler.net/admin_mais_complicado/cursos/mudancas.swf",1);
menuItem2("Chat", "https://www.reidobingo-net.umbler.net/admin_mais_complicado/cursos/sistema.swf",1);
menuItem2("Regras (PDF)", "https://www.reidobingo-net.umbler.net/admin_mais_complicado/cursos/regras.pdf",1);
menuItem2("Regras (HTML)", "https://www.criativawebsites.com.br/admin_mais_complicado/cursos/regras.html",1);
menuItemDropDownEnd(1);

?>
</table>

</td></tr></table>
</body>
</html>