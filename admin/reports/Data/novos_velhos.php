<?

include('../../include_functions.php');
checkAccess(2);

function getLastDayOfMonth($month, $year) {
	return idate('d', mktime(0, 0, 0, ($month + 1), 0, $year));
}

$month = date("m");
$year = date("Y");

$showYear = $_GET["year"];
$showMonth = $_GET["month"];

if (($month==$showMonth)&&($year==$showYear)) {
	$month = date("m");
	$year = date("Y");
	$today = date("j");
} else {
	$year = $showYear;
	$month = $showMonth;
	$today = getLastDayOfMonth($showMonth, $showYear);
}

?>
<chart palette='2' caption='Novos usuario vs. Usuarios voltando' decimals='0' yAxisName='Vendas em R$' xAxisName='Dia' showValues='0' yAxisValuesPadding='10' formatNumberScale='0' numberPrefix='R$ '>	
<categories>
<?

	$today = date("j");

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;
	
		$value = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN '$year-$month-$b 00:00:00' AND DATE_ADD('$year-$month-$b 00:00:00', INTERVAL 24 HOUR)");
	
		echo "<category label='$b' />
";
	
	}

?>
</categories>
<dataset seriesName='Novos usuarios' color='AFD8F8' showValues='0'>
<?

	$today = date("j");

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;
		
		$value = 0;
		
		$sql = "SELECT * FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN '$year-$month-$b' AND '$year-$month-$c'";
		$result = mysql_query($sql, $mysql_link);

		if ($result) {

			while ($row = mysql_fetch_array($result)) {

				$userId = $row["userId"];
				$amount = $row["amount"];
				$buyDate = $row["buyDate"];
				
				$novo = GetRow("SELECT COUNT(id) FROM users WHERE id = $userId AND joinedWhen BETWEEN DATE_SUB('$buyDate', INTERVAL 7 DAY) AND '$buyDate'");
				
				if ($novo==1) {
					$value = $value + $amount;
				}

			}

			mysql_free_result($result);

		}
		
		echo "<set label='$b' value='$value' />
";
	
	}

?>
</dataset>
<dataset seriesName='Usuarios voltando' color='F6BD0F' showValues='0'>
<?

	$today = date("j");

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;
	
		$value = 0;
		
		$sql = "SELECT * FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN '$year-$month-$b' AND '$year-$month-$c'";
		$result = mysql_query($sql, $mysql_link);

		if ($result) {

			while ($row = mysql_fetch_array($result)) {

				$userId = $row["userId"];
				$amount = $row["amount"];
				$buyDate = $row["buyDate"];
				
				$novo = GetRow("SELECT COUNT(id) FROM users WHERE id = $userId AND joinedWhen BETWEEN DATE_SUB('$buyDate', INTERVAL 7 DAY) AND '$buyDate'");
				
				if ($novo==0) {
					$value = $value + $amount;
				}

			}

			mysql_free_result($result);

		}
	
		echo "<set label='$b' value='$value' />
";
	
	}

?>
</dataset>
</chart>