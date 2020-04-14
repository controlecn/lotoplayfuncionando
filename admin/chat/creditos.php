<? if (($_GET["username"]=="Visitante")&&($_GET["email"]=="visitante@lotoplay.com")) {
	die("<b>VISITANTE SEM CADASTRO</b>");
}

?><html>
<head>
<title>LotoPlay - Sistema de controle</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#F7F7F7" style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px;">
<?

include('../include_functions.php');
checkAccess(1);

$username = $_GET["username"];
$email = $_GET["email"];
$user_id = GetRow("SELECT id FROM users WHERE username = '$username' AND email = '$email'");

$allcredits = getCredits($user_id);
$saldo = $allcredits[0];
$bonus = $allcredits[1];

$tw = 100;
$height = 25;
$cor1 = "#FFFFFF";
$cor2 = "#F7F7F7";

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Creditos</td>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletext"><?=$lang_system_moneybefore?> <?=credits2money($saldo)?> <?=$lang_system_moneyafter?> (<?=$saldo?>)</td>
</tr>
<tr>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Bonus</td>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletext"><?=$lang_system_moneybefore?> <?=credits2money($bonus)?> <?=$lang_system_moneyafter?> (<?=$bonus?>)</td>
</tr>
</table>
</body>
</html>