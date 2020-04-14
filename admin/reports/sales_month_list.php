<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Relatório do mês (Lista)", "../");

$showMonthYear = $_POST["showMonthYear"];

if (!$showMonthYear) $showMonthYear = date("n")."-".date("Y"); 

$showMonth = substr($showMonthYear, 0, strpos($showMonthYear, "-"));
$showYear = substr($showMonthYear, strpos($showMonthYear, "-")+1, 4);

?>
<script>
function changeMonth() {
	document.forms.monthForm.submit();
}
</script>
<form method="post" action="sales_month_list.php" name="monthForm" id="monthForm">
<font class="tabletop"><b><?=$lang_affliatetransfers_selectmonth?>:</b> </font><select class="tabletext" name="showMonthYear" onChange="changeMonth()">
<?

// I Need to get all the months since the register date (including the register month)

function monthName($i) {

	switch($i) {
	
		case 1:		$name = "Janeiro"; break;
		case 2:		$name = "Fevereiro"; break;
		case 3:		$name = "Março"; break;
		case 4:		$name = "Abril"; break;
		case 5:		$name = "Maio"; break;
		case 6:		$name = "Junho"; break;
		case 7:		$name = "Julho"; break;
		case 8:		$name = "Agosto"; break;
		case 9:		$name = "Setembro"; break;
		case 10:	$name = "Outubro"; break;
		case 11:	$name = "Novembro"; break;
		case 12:	$name = "Dezembro"; break;
	
	}
	
	return $name;

}

$compYear = date("Y");
$compMonth = date("n");

$userYear = 2009;
$userMonth = 07;

if (substr($userMonth,0,1)=="0") { $userMonth=str_replace("0", "", $userMonth); } // Erase the leading zero

if ($compYear==$userYear) {

	// The user registered in this year, only list the months since he registered

	if ($compMonth==$userMonth) {

		// He actually registered this month... Only list one month (this one)

		echo "<option value=\"$compMonth-$userYear\" selected>$userYear - ".monthName($compMonth)."</option>";


	} else {

		// List the months, in this order = desember to january (only this year since he registered in this year

		for ($a=$compMonth; $a>=$userMonth; $a--) {

			if ($showMonthYear=="$a-$userYear") {
				echo "<option value=\"$a-$userYear\" selected>$userYear - ".monthName($a)."</option>";
			} else {
				echo "<option value=\"$a-$userYear\">$userYear - ".monthName($a)."</option>";
			}

		}

	}

} else {

	// He registered some years before

	// First we need a loop that lists the years since he registered

	for ($b=$compYear; $b>=$userYear; $b--) {

		// B is the year

		if ($b!=$userYear) {

			if ($b==$compYear) {

				// List all the months that have gone by in this year

				for ($c=$compMonth; $c>=1; $c--) {

					if ($showMonthYear=="$c-$b") {
						echo "<option value=\"$c-$b\" selected>$b - ".monthName($c)."</option>";
					} else {
						echo "<option value=\"$c-$b\">$b - ".monthName($c)."</option>";
					}
				}

			} else {

				// List all twelve months in this year

				if ($showMonthYear=="12-$b") {
					 echo "<option value=\"12-$b\" selected>$b - ".monthName(12)."</option>";
				} else { echo "<option value=\"12-$b\">$b - ".monthName(12)."</option>"; }

				if ($showMonthYear=="11-$b") {
					 echo "<option value=\"11-$b\" selected>$b - ".monthName(11)."</option>";
				} else { echo "<option value=\"11-$b\">$b - ".monthName(11)."</option>"; }

				if ($showMonthYear=="10-$b") {
					 echo "<option value=\"10-$b\" selected>$b - ".monthName(10)."</option>";
				} else { echo "<option value=\"10-$b\">$b - ".monthName(10)."</option>"; }

				if ($showMonthYear=="9-$b") {
					 echo "<option value=\"9-$b\" selected>$b - ".monthName(9)."</option>";
				} else { echo "<option value=\"9-$b\">$b - ".monthName(9)."</option>"; }

				if ($showMonthYear=="8-$b") {
					 echo "<option value=\"8-$b\" selected>$b - ".monthName(8)."</option>";
				} else { echo "<option value=\"8-$b\">$b - ".monthName(8)."</option>"; }

				if ($showMonthYear=="7-$b") {
					 echo "<option value=\"7-$b\" selected>$b - ".monthName(7)."</option>";
				} else { echo "<option value=\"7-$b\">$b - ".monthName(7)."</option>"; }

				if ($showMonthYear=="6-$b") {
					 echo "<option value=\"6-$b\" selected>$b - ".monthName(6)."</option>";
				} else { echo "<option value=\"6-$b\">$b - ".monthName(6)."</option>"; }

				if ($showMonthYear=="5-$b") {
					 echo "<option value=\"5-$b\" selected>$b - ".monthName(5)."</option>";
				} else { echo "<option value=\"5-$b\">$b - ".monthName(5)."</option>"; }

				if ($showMonthYear=="4-$b") {
					 echo "<option value=\"4-$b\" selected>$b - ".monthName(4)."</option>";
				} else { echo "<option value=\"4-$b\">$b - ".monthName(4)."</option>"; }

				if ($showMonthYear=="3-$b") {
					 echo "<option value=\"3-$b\" selected>$b - ".monthName(3)."</option>";
				} else { echo "<option value=\"3-$b\">$b - ".monthName(3)."</option>"; }

				if ($showMonthYear=="2-$b") {
					 echo "<option value=\"2-$b\" selected>$b - ".monthName(2)."</option>";
				} else { echo "<option value=\"2-$b\">$b - ".monthName(2)."</option>"; }

				if ($showMonthYear=="1-$b") {
					 echo "<option value=\"1-$b\" selected>$b - ".monthName(1)."</option>";
				} else { echo "<option value=\"1-$b\">$b - ".monthName(1)."</option>"; }

			}


		} else {

			// List only the months since he registered this year

			for ($d=12; $d>=$userMonth; $d--) {
				if ($showMonthYear=="$d-$b") {
					echo "<option value=\"$d-$b\" selected>$b - ".monthName($d)."</option>";
				} else {
					echo "<option value=\"$d-$b\">$b - ".monthName($d)."</option>";
				}
			}

		}

	}

}



?>
</select></form>
<?

gui_tabletop(array("Usuário", "Data", "Valor", "Banco", "KK", "Sald/LIQ", "Saques"), 0);

if ($showMonth==12) {
	$nextMonth = "01";
	$nextYear = $showYear + 1;
} else {
	$nextMonth = $showMonth + 1;
	$nextYear = $showYear;
}

$sql = "SELECT * FROM statistics_sales WHERE buyDate BETWEEN '$showYear-$showMonth-01 00:00:00' AND '$nextYear-$nextMonth-01 00:00:00' ORDER BY id";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	$kk = 0;
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
		$newBuyDate = substr($buyDate, 8, 2) . "/" . substr($buyDate, 5, 2);
		
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
			<td bgcolor=\"$color\" height=\"20\">&nbsp;</td>
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