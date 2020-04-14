<?
include('../../include_functions.php');
checkAccess(2);

$month = date("m");
$year = date("Y");

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
<chart caption='Cadastros por dia' xAxisName='Dia' yAxisName='Qt. de cadastros' showValues='0' decimals='0' formatNumberScale='0'>
<?

	for ($a=0; $a<$today; $a++) {
	
		$b = $a+1;
		$c = $a+2;
	
		$value = GetRow("SELECT Count( id ) FROM users WHERE `joinedWhen` BETWEEN '$year-$month-$b 00:00:00' AND DATE_ADD('$year-$month-$b 00:00:00', INTERVAL 24 HOUR)");
	
		echo "<set label='$b' value='$value' />
";
	
	}

?>
<trendLines>
<?

$cadastros_total = 0;

for ($a=0; $a<$today; $a++) {
	
	$b = $a+1;
	$c = $a+2;
	
	$value = GetRow("SELECT Count(id) FROM users WHERE `joinedWhen` BETWEEN '$year-$month-$b 00:00:00' AND DATE_ADD('$year-$month-$b 00:00:00', INTERVAL 24 HOUR)");
	
	$cadastros_total = $cadastros_total + $value;
	
}

$cadastros_avg = $cadastros_total / $today;

?>
	<line startValue="<?=$cadastros_avg?>" color="359A35" displayvalue="Media" valueOnRight="1"/>
</trendLines>
</chart>