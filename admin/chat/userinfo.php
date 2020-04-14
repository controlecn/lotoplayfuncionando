<? if (($_GET["username"]=="Visitante")&&($_GET["email"]=="visitante@lotoplay.com")) {
	die("<b>VISITANTE SEM CADASTRO</b>");
}

?><html>
<head>
<title>LotoPlay - Sistema de controle</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body bgcolor="#F7F7F7" style="margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px;">
<?

include('../include_functions.php');
checkAccess(1);

$username = $_GET["username"];
$email = $_GET["email"];
$user_id = GetRow("SELECT id FROM users WHERE username = '$username' AND email = '$email'");

$sql = "SELECT * FROM users WHERE id = $user_id";

$result = mysql_query($sql, $mysql_link);

	$i = 0;

if ($result) {

	$row = mysql_fetch_array($result);
    
	$fullname = $row["fullname"];
	$username = $row["username"];
	$password = $row["password"];
	$email = $row["email"];
	$cpf = $row["ssn"];
	$endereco = $row["address"];
	$bairro = $row["citypart"];
	$cep = $row["zipcode"];
	$dia = $row["day"];
	$mes = $row["month"];
	$ano = $row["year"];
	$sexo = $row["sex"];
	$cidade = $row["city"];
	$estado = $row["state"];
	$socioId = $row["affliateId"];
	$amigoId = $row["friendId"];
	$valid = $row["valid"];
	$validCode = $row["validCode"];
	$joinedWhen = $row["joinedWhen"];

	mysql_free_result($result);

}

$allcredits = getCredits($user_id);
$saldo = $allcredits[0];
$bonus = $allcredits[1];

function birthday2($birthday) {

    list($year,$month,$day) = explode("-",$birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
      $year_diff--;
    return $year_diff;
}

function tempo_site ($date) {

	$today = time();
	list ($month, $day, $year) = preg_split("/[\\/-]/", $date);
	$date= mktime (0,0,0,$month,$day,$year);
	$diff = floor(($today - $date)/60/60/24);
	return $diff;
}

$idade = birthday2("$ano-$mes-$dia");
$tempo_no_site = tempo_site(substr($joinedWhen, 5, 2)."-".substr($joinedWhen, 8, 2)."-".substr($joinedWhen, 0, 4));

$tw = 100;
$height = 25;
$cor1 = "#FFFFFF";
$cor2 = "#F7F7F7";

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Apelido</td>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletext"><?=$username?></td>
</tr>
<tr>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Nome</td>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletext"><?=$fullname?></td>
</tr>
<tr>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;E-mail</td>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletext"><?=$email?></td>
</tr>
<tr>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;CPF</td>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletext"><?=$cpf?></td>
</tr>
<tr>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Nascimento</td>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletext"><?=$dia?> / <?=$mes?> / <?=$ano?> ( Idade: <?=$idade?> )</td>
</tr>
<tr>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Local</td>
	<td bgcolor="<?=$cor2?>" height="<?=$height?>" class="tabletext"><?=$cidade?> / <?=$estado?></td>
</tr>
<tr>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletop" width="<?=$tw?>">&nbsp;Tempo no site</td>
	<td bgcolor="<?=$cor1?>" height="<?=$height?>" class="tabletext"><?=$tempo_no_site?> dias</td>
</tr>
</table>

</body>
</html>