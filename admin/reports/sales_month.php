<?
include('../include_functions.php');
checkAccess(2);

$showMonthYear = $_POST["showMonthYear"];

if (!$showMonthYear) $showMonthYear = date("n")."-".date("Y"); 

$showMonth = substr($showMonthYear, 0, strpos($showMonthYear, "-"));
$showYear = substr($showMonthYear, strpos($showMonthYear, "-")+1, 4);



?><html>
<head>
<title>Relatório do mes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<script language="JavaScript" src="../js/FusionCharts.js"></script>
<style type="text/css">

body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

</style>
<script>
function changeMonth() {
	document.forms.monthForm.submit();
}
</script>
</head>

<body bgcolor="#FFFFFF">
<form method="post" action="sales_month.php" name="monthForm" id="monthForm">
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
$userMonth = 05;

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

$id = $_REQUEST["id"];

function getLastDayOfMonth($month, $year) {
	return idate('d', mktime(0, 0, 0, ($month + 1), 0, $year));
}

$year = $showYear;
$month = $showMonth;
$lastday = getLastDayOfMonth($month, $year);

$month2 = $month+1;

$sales_total = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month2-01'");

$payout_total = GetRow("SELECT SUM(amount) FROM statistics_sales WHERE transfertype = '2' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month2-01'");

/****************************/

$cadastros_total = GetRow("SELECT Count( id ) FROM users WHERE `joinedWhen` BETWEEN '$year-$month-01' AND '$year-$month2-01'");

if (strlen($month)==1) {
	$month = "0".$month;
}

?>
<style>
.titletext {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 28px;
	font-weight: bold;
	color: #000000;
	text-decoration: none;
}
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

<center><h1>Relatório do mes</h1></center>

<div id="chartdiv" align="center"></div>

  <script type="text/javascript">
	var chart = new FusionCharts("Charts/MSColumnLine3D.swf", "ChartId", "1000", "500", "0", "0");
	chart.setDataURL("Data/vendas_por_dia.php<?=urlencode("?month=$showMonth&year=$showYear")?>");		   
	chart.render("chartdiv");
  </script>
  
<?



?>
  
  <br><br>
<center>
<table width="600" border="1" cellspacing="0" cellpadding="0" style="border: solid 1px #000000">
  <tr>
    <td align="center"><font class="tabletop">Total em compras este mes:</font><br>
        <font class="moneytext">R$ <?=formatmoney($sales_total)?></font></td>
  </tr>
  <tr>
    <td align="center"><font class="tabletop">Total em saques este mes:</font><br>
        <font class="moneytext2">R$ <?=formatmoney($payout_total)?></font></td>
  </tr>
</table></center>
<br><br>
  <div id="chartdiv2" align="center"></div>
  <script type="text/javascript">
	var chart2 = new FusionCharts("Charts/Column3D.swf", "ChartId", "1000", "500", "0", "0");
	chart2.setDataURL("Data/cadastros_por_dia.php<?=urlencode("?month=$showMonth&year=$showYear")?>");		   
	chart2.render("chartdiv2");
  </script><br>
<br>
  <center>
<table width="600" border="1" cellspacing="0" cellpadding="0" style="border: solid 1px #000000">
  <tr>
    <td align="center"><font class="tabletop">Total de cadastros este mes:</font><br>
        <font class="moneytext"><?=$cadastros_total?></font></td>
  </tr>
</table></center>

<br><br>

  <div id="chartdiv3" align="center"></div>
  <script type="text/javascript">
	var chart2 = new FusionCharts("Charts/StackedColumn3D.swf", "ChartId", "1000", "500", "0", "0");
	chart2.setDataURL("Data/novos_velhos.php<?=urlencode("?month=$showMonth&year=$showYear")?>");		   
	chart2.render("chartdiv3");
  </script><br>

<br><br>
  
</body>
</html>