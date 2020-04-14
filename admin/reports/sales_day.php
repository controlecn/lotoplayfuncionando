<?

include('../include_functions.php');
include('../include_guifunctions.php');

checkAccess(2);

gui_header("Relatório do dia", "../");

$year = date("Y");
$month = date("m");
$today = date("j");

$sales_total = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL 1 DAY)");
$payout_total = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '2' AND buyDate BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL 1 DAY)");

?>
<style>
.moneytext {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 28px;
	font-weight: bold;
	color: #009900;
	text-decoration: none;
}
.moneytext2 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 28px;
	font-weight: bold;
	color: #FF0000;
	text-decoration: none;
}
</style>
<font class="tabletop">Total em vendas hoje:</font><br>
<font class="moneytext">R$ <?=formatmoney($sales_total)?></font><BR><BR>
<font class="tabletop">Total em saques hoje:</font><br>
<font class="moneytext2">R$ <?=formatmoney($payout_total)?></font><BR><BR>

<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Usuário</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Data</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Valor</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Banco</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;KK</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Sald/LIQ</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Vendas</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Saques</td>
  </tr>
<?
$sql = "SELECT * FROM statistics_sales WHERE buyDate BETWEEN DATE(NOW()) AND DATE_ADD(DATE(NOW()), INTERVAL 1 DAY) ORDER BY id";
$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	$kj = 0;
	$saldliq = 0;
	$vendas = 0;
	$saques = 0;

	while ($row = mysql_fetch_array($result)) {

		$i++;

		$payout = 0;

		$id = $row["id"];
		$userId = $row["userId"];
		$buyDate = $row["buyDate"];
		$amount = $row["amount"];
		$bank = $row["bank"];
		$transfertype = $row["transfertype"];

		$username = GetRow("SELECT username FROM users WHERE id = $userId");
		$newBuyDate = substr($buyDate, 11, 5);
		
		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}
		
		if ($transfertype==1) {
			$icon = "../images/icons/compra.gif";
			$vendas = $vendas + $amount;
		} else {
			$icon = "../images/icons/pagamento.gif";
			$saques = $saques + $amount;
		}
		
		$kk = $vendas * 0.10;
		$saldliq = $vendas - ($kk + $saques);
		
		$kk = round($kk, 2);
		$gover = round($gover, 2);
		$payout = round($payout, 2);
		$saldliq = round($saldliq, 2);
		$vendas = round($vendas, 2);
		
		if ($bank!=0) {
			$bank = GetRow("SELECT name_short FROM buy_paymentforms WHERE id = $bank");
		} else {
			$bank = "--";
		}
		
		echo "
		  <tr>
			<td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;<img src=\"../images/$icon\"></td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;<a class=\"link\" href=\"../users/user_info.php?id=$userId\">$username</a></td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$newBuyDate</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$amount</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$bank</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$kk</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$saldliq</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$vendas</td>
			<td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$saques</td>
		  </tr>
		";
		
		

	}

mysql_free_result($result);

}

?>
</table><br><br>
<? gui_bottom(); ?>