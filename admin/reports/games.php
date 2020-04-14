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

function display_bingo75($title) {

?>
<br /><br /> 
<font class="font_item"><?=$title?>:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Entrada
$game_in = GetRow("SELECT value FROM counters WHERE code = 'bingo75_in'") + GetRow("SELECT value FROM counters WHERE code = 'bingo75_vip_in'");
showItem ("Entrada Total", "R$ ". credits2money($game_in), 1);

// Saida
$game_out = GetRow("SELECT value FROM counters WHERE code = 'bingo75_out'") + GetRow("SELECT value FROM counters WHERE code = 'bingo75_vip_out'");
showItem ("Saída Total", "R$ ". credits2money($game_out), 2);

// Percentage

$payout = floor(($game_out / $game_in) * 100);
showItem ("Pagamentos %", $payout."%", 1);

?>
</table>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Entrada
$game_in = GetRow("SELECT value FROM counters WHERE code = 'bingo75_vip_in'");
showItem ("Entrada VIP", "R$ ". credits2money($game_in), 1);

// Saida
$game_out = GetRow("SELECT value FROM counters WHERE code = 'bingo75_vip_out'");
showItem ("Saída VIP", "R$ ". credits2money($game_out), 2);

// Percentage

$payout = floor(($game_out / $game_in) * 100);
showItem ("Pagamentos %", $payout."%", 1);

?>
</table>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Entrada
$game_in = GetRow("SELECT value FROM counters WHERE code = 'bingo75_in'");
showItem ("Entrada", "R$ ". credits2money($game_in), 1);

// Saida
$game_out = GetRow("SELECT value FROM counters WHERE code = 'bingo75_out'");
showItem ("Saída", "R$ ". credits2money($game_out), 2);

// Percentage

$payout = floor(($game_out / $game_in) * 100);
showItem ("Pagamentos %", $payout."%", 1);

?>
</table>

<?

}

function display_game($title, $game, $type) {

?>
<br /><br /> 
<font class="font_item"><?=$title?>:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Entrada
$game_in = GetRow("SELECT value FROM counters WHERE code = '".$game."_in'");

if ($type==2) {
	$game_in = floor($game_in / 25);
}

showItem ("Entrada", "R$ ". credits2money($game_in), 1);

// Saida
$game_out = GetRow("SELECT value FROM counters WHERE code = '".$game."_out'");

if ($type==2) {
	$game_out = floor($game_out / 25);
}

showItem ("Saída", "R$ ". credits2money($game_out), 2);

// Percentage

$payout = floor(($game_out / $game_in) * 100);
showItem ("Pagamentos %", $payout."%", 1);

?>
</table>
<?

}

?>
<body>
<font class="font_title">Relatório de pagamentos em jogos</font>

<br /><br /> 
<font class="font_item">Informações Básicas:</font>
<br /><br />
<table width="600" border="0" cellspacing="3" cellpadding="0">
<?

// Entrada
$games1_in = GetRow("SELECT SUM(value) FROM counters WHERE code = 'bingo75_in' OR code = 'bingomaster_in' OR code = 'bonusbingo_in' OR code = 'carnaval_in' OR code = 'egyptdiamonds_in' OR code = 'fruitmania_in' OR code = 'lucky25_in' OR code = 'megabingo_in' OR code = 'nineballs_in' OR code = 'showbingoball_in' OR code = 'silverball_in' OR code = 'superbingo75_in' OR code = 'superbingo2008_in' OR code = 'superbingo_in' OR code = 'treasuresoftheocean_in' OR code = 'turbo90_in' OR code = 'videopoker_in'");
$games2_in = GetRow("SELECT SUM(value) FROM counters WHERE code = 'cb2009_in' OR code = 'circus_in' OR code = 'halloween_in'");
$games_total_in = floor($games1_in + ($games2_in / 25));
showItem ("Entrada", "R$ ". credits2money($games_total_in), 1);

// Saida
$games1_out = GetRow("SELECT SUM(value) FROM counters WHERE code = 'boutgo75_out' OR code = 'boutgomaster_out' OR code = 'bonusboutgo_out' OR code = 'carnaval_out' OR code = 'egyptdiamonds_out' OR code = 'fruitmania_out' OR code = 'lucky25_out' OR code = 'megaboutgo_out' OR code = 'nouteballs_out' OR code = 'showboutgoball_out' OR code = 'silverball_out' OR code = 'superboutgo75_out' OR code = 'superboutgo2008_out' OR code = 'superboutgo_out' OR code = 'treasuresoftheocean_out' OR code = 'turbo90_out' OR code = 'videopoker_out'");
$games2_out = GetRow("SELECT SUM(value) FROM counters WHERE code = 'cb2009_out' OR code = 'circus_out' OR code = 'halloween_out'");
$games_total_out = floor($games1_out + ($games2_out / 25));
showItem ("Saída", "R$ ". credits2money($games_total_out), 2);

// Percentage
$payout = floor(($games_total_out / $games_total_in) * 100);
showItem ("Pagamentos %", $payout."%", 1);

?>
</table>

<?

display_bingo75("Bingo Tradicional");
display_game("Bingo Master", "bingomaster", 1);
display_game("Bonus Bingo", "bonusbingo", 1);
display_game("Carnaval", "carnaval", 1);
display_game("CB 2009", "cb2009", 2);
display_game("Circus", "circus", 2);
display_game("Diamantes da Kleopatra", "egyptdiamonds", 1);
display_game("Mania Das Frutas", "fruitmania", 1);
display_game("Halloween", "halloween", 2);
display_game("25 Da Sorte", "lucky25", 1);
display_game("Mega Bingo", "megabingo", 1);
display_game("Nine Balls", "nineballs", 1);
display_game("Show Bingo Ball", "showbingoball", 1);
display_game("Silver Ball", "silverball", 1);
display_game("Super Bingo 75", "superbingo75", 1);
display_game("Super Bingo 2008", "superbingo2008", 1);
display_game("Super Bingo", "superbingo", 1);
display_game("Tesouros Do Mar", "treasuresoftheocean", 1);
display_game("Noventinha", "turbo90", 1);
display_game("Video Poker", "videopoker", 1);











?>



<br /><br />

</body>

</html>
