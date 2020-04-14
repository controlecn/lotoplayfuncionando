<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Vendas de afiliados", "../");

$id = $_REQUEST["id"];
$showMonthYear = $_POST["showMonthYear"];

if (!$showMonthYear) {
	$sql = "SELECT * FROM transfers_affliates";
} else {
	$showMonth = substr($showMonthYear, 0, strpos($showMonthYear, "-"));
	$showYear = substr($showMonthYear, strpos($showMonthYear, "-")+1, 4);
	$sql = "SELECT * FROM transfers_affliates where buyMonth = $showMonth and buyYear = $showYear";
}


?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_affliatetransfers_delete?>');
}


function changeMonth() {
	document.forms.monthForm.submit();
}
</script>
<form method="post" action="transfers.php" name="monthForm" id="monthForm">
<font class="tabletop"><b><?=$lang_affliatetransfers_selectmonth?>:</b> </font><select class="tabletext" name="showMonthYear" onChange="changeMonth()">
<option value=""<? if (!$showMonthYear) { echo " selected"; } ?>><?=$lang_affliatetransfers_selectmonth_all?></option>
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



gui_tabletop(array($lang_affliatetransfers_table_date, $lang_affliatetransfers_table_affliate, $lang_affliatetransfers_table_description, $lang_affliatetransfers_table_value, $lang_affliatetransfers_table_commissionvalue), 0);

$result = mysql_query($sql, $mysql_link);

$valorTotal = 0;
$valorPercent = 0;
$i=0;
$a=0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}


			$id = $row["id"];
			$transferDate = changeMysqlTime($row["buyDate"]);
			$value = $row["totalValue"];
			$userId = $row["userId"];
			$affliateId = $row["affliateId"];
			$percent = $row["affliateValue"];
			$information = $row["information"];

			$valorTotal = $valorTotal + $value;
			$valorPercent = $valorPercent + $percent;

			$affliate = GetRow("Select login from users_affliates where id = $affliateId");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="7"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$transferDate?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="info.php?id=<?=$affliateId?>" class="link"><?=$affliate?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$information?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=formatMoney($value)?> <?=$lang_system_moneyafter?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=formatMoney($percent)?> <?=$lang_system_moneyafter?></td>
  </tr>
		<?

		$i++;


	}

	mysql_free_result($result);

}

if ($i==0) {
		echo "<tr>
			<td class=\"label4\" align=\"center\" bgcolor=\"#FFFFFF\" colspan=\"7\">$lang_global_emptytable</td>
		      </tr>";
}

?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="8"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" align="right" class="tabletop" colspan="5"><?=$lang_affliatetransfers_total?>:&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FFFFFF" class="tabletop"><?=$lang_system_moneybefore?> <?=formatMoney($valorTotal)?> <?=$lang_system_moneyafter?></td>
    <td bgcolor="#FFFFFF" class="tabletop"><?=$lang_system_moneybefore?> <?=formatMoney($valorPercent)?> <?=$lang_system_moneyafter?></td>
  </tr>
</table><br>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
<? gui_bottom(); ?>