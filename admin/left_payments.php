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

function open_xml() {
	window.open("xmlserver/xmlserver.php","_blank","toolbar=no, location=no, directories=no, status=yes, menubar=no, scrollbars=no, resizable=yes, copyhistory=no, width=800, height=800")
}

</script>
</head>

<body bgcolor="#dde8f0" leftmargin="0" topmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">

<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td align="center">

<table width="187" border="0" cellspacing="0" cellpadding="0">
<?

menuItemDropDown("Compras", 1);
menuItem2("Dependentes", "payments/transfers_buy.php", 1);
menuItem2("Liberadas", "payments/transfers_buy_confirmed.php", 1);
menuItem2("Canceladas", "payments/transfers_buy_cancelled.php", 1);
menuItem2("Novo pedido...", "payments/transfers_buy_new.php", 1);
menuItemDropDownEnd(1);

menuItemDropDown("Saques",1);
menuItem2("Dependentes", "payments/payout.php",1);
menuItem2("Pagos", "payments/payout_paid.php",1);
menuItem2("Revertidos", "payments/payout_revert.php",1);
menuItem2("Produtos", "points/produtos.php",1);
menuItemDropDownEnd(1);

?>
	  <tr>
	<td height="26" bgcolor="#dde8f0"><div style="float: left;"><a href="javascript:open_xml();" class="link"><img border="0" src="images/arrows.gif"></a></div><div style="float: left; padding-top: 7px;"><a href="javascript:open_xml();" class="link">Servidor</a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_dark.jpg"></td>
  </tr>
<?

menuItem("Servidor 2", "xmlserver/xmlserver2.php", 1);

menuItemDropDown($lang_leftmenu_transfers, 1);
menuItem2($lang_leftmenu_transfers_overview, "payments/transfers.php",1);
menuItem2($lang_leftmenu_transfers_add, "payments/transfers_add.php",1);
menuItemDropDownEnd(1);

menuItemDropDown($lang_leftmenu_gateway,2);
menuItem2("Resumo", "payments/gateway.php",2);
menuItem2($lang_leftmenu_gateway_add, "payments/gateway_add.php",2);
menuItemDropDownEnd(2);

menuItem($lang_leftmenu_paymentsettings, "payments/options.php",2);

?>
</table>

</td></tr></table>
</body>
</html>