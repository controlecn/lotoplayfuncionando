<?

include('../include_functions.php');

checkAccess(2);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.font_title {
	font-family: Arial, Helvetica, sans-serif;
	font-size:38px;
	font-weight: bold;
}
.font_item {
	font-family: Arial, Helvetica, sans-serif;
	font-size:20px;
	font-weight: bold;
}
.item_text {
	font-family: Arial, Helvetica, sans-serif;
	font-size:18px;
}
.item_display {
	font-family: Arial, Helvetica, sans-serif;
	font-size:18px;
	font-weight: bold;
	color:#3300CC;
}
-->
</style></head>
<?

function showItem ($name, $value, $color) {

	if ($color==1) {
		$cor = "#ededed";
	} else {
		$cor = "#d9d9d9";
	}

?>
  <tr>
    <td class="item_text" width="250" bgcolor="<?=$cor?>"><?=$name?>:</td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$value?></td>
  </tr>
<?

}

function lastday($month = '', $year = '') {
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('Y-m-d', $result);
}


?>
<body>
<font class="font_title">Relatório de créditos, bônus e pontos</font>

<br /><br /> 
<font class="font_item">Informações Básicas:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Pre config
$month = date("m");
$year = date("Y");
$today = date("j");

// Total de creditos
$credits_total = GetRow("SELECT SUM(credits) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0'");
showItem ("Total de créditos", "R$ ". credits2money($credits_total), 1);

// Total de bonus
$bonus_total = GetRow("SELECT SUM(bonus) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0'");
showItem ("Total de bônus", "R$ ". credits2money($bonus_total), 1);

// Total de points
$points_total = GetRow("SELECT SUM(points) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0'");
showItem ("Total de pontos", $points_total, 1);

// Total de bonus
$prize_credits = floor(($points_total / 10) / 0.25);
$convert_total = $prize_credits * 5;
showItem ("Pontos para converter ainda", "R$ ". credits2money($convert_total), 1);

// Total de bonus surprise
$surprise_bonus = GetRow("SELECT value FROM counters WHERE `code` = 'surprisebonus'");
showItem ("Saída de Bonus Surpresa", "R$ ". credits2money($surprise_bonus), 1);

?>
</table>

<br /><br /> 
<font class="font_item">Top 10 Clientes com créditos:</font>
<br /><br />

<table width="600" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td class="item_text" width="250">Apelido</td>
    <td class="item_text">Créditos</td>
    <td class="item_text">Bônus</td>
    <td class="item_text">Pontos</td>
  </tr>
<?
$sql = "SELECT * FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0' ORDER BY credits DESC LIMIT 10";
$result = mysql_query($sql, $mysql_link);

	$a = 0;

if ($result) {


	while ($row = mysql_fetch_array($result)) {

		if($a%2 == 0) {
			$cor = "#FFFFFF";
			$a++;
		} else {
 			$cor = "#F7F7F7";
 			$a++;
		}

		$payout = 0;

		$id = $row["id"];
		$username = $row["username"];
		$points = $row["points"];
		$credits = "R$ ". credits2money($row["credits"]);
		$bonus = "R$ ". credits2money($row["bonus"]);
		
		?>
  <tr>
    <td class="item_text" width="250" bgcolor="<?=$cor?>"><a href="../users/user_info.php?id=<?=$id?>" class="link"><?=$username?></a></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$credits?></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$bonus?></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$points?></td>
  </tr>
		<?
		
		

	}

mysql_free_result($result);

}

?>

</table>

<br /><br /> 
<font class="font_item">Top 10 Clientes com bônus:</font>
<br /><br />

<table width="600" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td class="item_text" width="250">Apelido</td>
    <td class="item_text">Créditos</td>
    <td class="item_text">Bônus</td>
    <td class="item_text">Pontos</td>
  </tr>
<?
$sql = "SELECT * FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0' ORDER BY bonus DESC LIMIT 10";
$result = mysql_query($sql, $mysql_link);

	$a = 0;

if ($result) {


	while ($row = mysql_fetch_array($result)) {

		if($a%2 == 0) {
			$cor = "#FFFFFF";
			$a++;
		} else {
 			$cor = "#F7F7F7";
 			$a++;
		}

		$payout = 0;

		$id = $row["id"];
		$username = $row["username"];
		$points = $row["points"];
		$credits = "R$ ". credits2money($row["credits"]);
		$bonus = "R$ ". credits2money($row["bonus"]);
		
		?>
  <tr>
    <td class="item_text" width="250" bgcolor="<?=$cor?>"><a href="../users/user_info.php?id=<?=$id?>" class="link"><?=$username?></a></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$credits?></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$bonus?></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$points?></td>
  </tr>
		<?
		
		

	}

mysql_free_result($result);

}

?>

</table>

<br /><br /> 
<font class="font_item">Top 10 Clientes com pontos:</font>
<br /><br />

<table width="800" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td class="item_text" width="250">Apelido</td>
    <td class="item_text">Créditos</td>
    <td class="item_text">Bônus</td>
    <td class="item_text">Pontos</td>
	<td class="item_text">Bonus para Pontos</td>
  </tr>
<?
$sql = "SELECT * FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `test` = '0' ORDER BY points DESC LIMIT 10";
$result = mysql_query($sql, $mysql_link);

	$a = 0;

if ($result) {


	while ($row = mysql_fetch_array($result)) {

		if($a%2 == 0) {
			$cor = "#FFFFFF";
			$a++;
		} else {
 			$cor = "#F7F7F7";
 			$a++;
		}

		$payout = 0;

		$id = $row["id"];
		$username = $row["username"];
		$points = $row["points"];
		$credits = "R$ ". credits2money($row["credits"]);
		$bonus = "R$ ". credits2money($row["bonus"]);
		
		$prize_credits = floor(($points / 10) / 0.25);
		$convert_points = $prize_credits * 5;
		
		?>
  <tr>
    <td class="item_text" width="250" bgcolor="<?=$cor?>"><a href="../users/user_info.php?id=<?=$id?>" class="link"><?=$username?></a></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$credits?></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$bonus?></td>
    <td class="item_display" bgcolor="<?=$cor?>"><?=$points?></td>
    <td class="item_display" bgcolor="<?=$cor?>">R$ <?=credits2money($convert_points)?></td>
  </tr>
		<?
		
		

	}

mysql_free_result($result);

}

?>

</table>

<br /><br />

</body>

</html>
