<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Afiliados - Relatório do mês", "../");

$id = $_REQUEST["id"];
$showMonthYear = $_POST["showMonthYear"];

if (!$showMonthYear) $showMonthYear = date("n")."-".date("Y"); 

$showMonth = substr($showMonthYear, 0, strpos($showMonthYear, "-"));
$showYear = substr($showMonthYear, strpos($showMonthYear, "-")+1, 4);

?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_affliatetransfers_delete?>');
}


function changeMonth() {
	document.forms.monthForm.submit();
}
</script>
<form method="post" action="report.php" name="monthForm" id="monthForm">
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

$userYear = 2005;
$userMonth = 10;

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

$result = mysql_query("SELECT DISTINCT(affliateId) FROM transfers_affliates WHERE buyMonth = '$showMonth' AND buyYear = '$showYear'", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {

			$affliateId = $row["affliateId"];
			$affliate = GetRow("Select login from users_affliates where id = $affliateId");
			echo "<h1>$affliate</h1>";
			
			$result2 = mysql_query("SELECT totalValue,affliateValue FROM transfers_affliates WHERE affliateId = '$affliateId' AND buyMonth = '$showMonth' AND buyYear = '$showYear'", $mysql_link);

			$sales1 = 0;
			$sales2 = 0;

			if ($result) {

				while ($row = mysql_fetch_array($result2)) {
					$sales1 = $sales1 + $row["totalValue"];
					$sales2 = $sales2 + $row["affliateValue"];
				}

				mysql_free_result($result2);

			}
			 	 	
			echo "Vendas: <b>R$ ".formatMoney($sales1)."</b><br>";
			echo "Comissao: <b>R$ ".formatMoney($sales2)."</b><br><br>";
			echo "Banco: <b>".GetRow("SELECT name FROM affliates_banks WHERE number = '".GetRow("SELECT payBank FROM users_affliates WHERE id = '$affliateId'")."'")."</b><br>";
			echo "Agencia: <b>".GetRow("SELECT payAgent FROM users_affliates WHERE id = '$affliateId'")."</b><br>";
			echo "Conta: <b>".GetRow("SELECT payAccount FROM users_affliates WHERE id = '$affliateId'")."</b><br>";
			echo "Tipo: <b>".GetRow("SELECT payAccountType FROM users_affliates WHERE id = '$affliateId'")."</b><br><br>";
			

	}

	mysql_free_result($result);

}

?>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
<? gui_bottom(); ?>