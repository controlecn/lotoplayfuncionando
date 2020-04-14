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

menuItemDropDown($lang_global_game_bingo75,1);
menuItem2($lang_leftmenu_bingo75_vipplayers, "games/bingo75/virtualplayers.php",2);
menuItem2($lang_leftmenu_settings, "games/bingo75/options.php",2);
menuItem2($lang_leftmenu_bingo75_roundspassed, "games/bingo75/rounds.php",1);
menuItem2("Horários dos VIP", "games/bingo75/vip_hours.php",2);
menuItem2("Rodadas Especiais", "games/bingo75/special_rounds.php",2);
menuItemDropDownEnd(2);

menuItem("Acumulados", "games/select_game_jackpots.php",2);
menuItem("Configuração de RNG", "games/selectgame.php",2);

?>
</table>

</td></tr></table>
</body>
</html>