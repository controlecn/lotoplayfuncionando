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
<chart caption='Compras e Saques' decimals='0' yAxisName='Vendas em R$' xAxisName='Dia' palette='1' showValues='0' yAxisValuesPadding='10' formatNumberScale='0' numberPrefix='R$ '>	
<categories>
<?

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;

		echo "<category label='$b' />
";
	
	}

?>
</categories>

<dataset seriesName='Compras 123'>
<?

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;
		
		$value = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN '$year-$month-$b 00:00:00' AND DATE_ADD('$year-$month-$b 00:00:00', INTERVAL 24 HOUR)");

		echo "<set label='$b' value='$value' />
";
	
	}

?>
</dataset>

	
	<dataset seriesname='Saques' renderAs='Line'>
<?

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;

		$value = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '2' AND buyDate BETWEEN '$year-$month-$b 00:00:00' AND DATE_ADD('$year-$month-$b 00:00:00', INTERVAL 24 HOUR)");

	
		if (!$value) $value = '0';
	
		echo "<set label='$b' value='$value' />
";
	
	}

?>
	</dataset>
<trendLines>
<?

$sales_total = 0;

for ($a=0; $a<$today; $a++) {
	
	$b = $a+1;
	$c = $a+2;
	
	$value = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN '$year-$month-$b' AND '$year-$month-$c'");
	
	$sales_total = $sales_total + $value;
	
}

$sales_avg = $sales_total / $today;

?>
	<line startValue="<?=$sales_avg?>" color="359A35" displayvalue="Media" valueOnRight="1"/>
</trendLines>

</chart>