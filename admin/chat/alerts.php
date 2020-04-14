<? if (($_GET["username"]=="Visitante")&&($_GET["email"]=="visitante@lotoplay.com")) {
	die("<b>VISITANTE SEM CADASTRO</b>");
}

?><?
include('../include_functions.php');
checkAccess(1);

$username = $_GET["username"];
$email = $_GET["email"];
$user_id = GetRow("SELECT id FROM users WHERE username = '$username' AND email = '$email'");

if ($_POST["submitbutton"]) {
	SqlQuery("INSERT INTO fraud_alerts (operator, user_id) VALUES ('$logged_user', '$user_id')");
}

?>
<html>
<head>
<title>LotoPlay - Sistema de controle</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script>
function temCerteza() {
	return confirm('TEM ABSOLUTA CERTEZA?');
}
</script>
</head>

<body bgcolor="#F7F7F7" style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px;">
<? if ($_POST["submitbutton"]) { ?>
<b>Alerta recebida. Obrigado.</b>
<? } else { ?>
<b><font color="#FF0000">AVISO!<br>Verifique duas vezes antes que confirmar a tapiação. Olha no banco ou os emails no minimo duas vezes antes que confirmar.</font></b>
<br><br>
<form onSubmit="return temCerteza()" method="post" action="alerts.php?username=<?=$_GET["username"]?>&email=<?=$_GET["email"]?>"><center><input type="submit" name="submitbutton" value="CONFIRMAR TENTATIVA DE FRAUDE!"></center></form>
<? } ?>
</body>
</html>