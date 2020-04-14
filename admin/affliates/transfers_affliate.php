<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Vendas de afiliado", "../");

$id = $_REQUEST["id"];
$showMonthYear = $_POST["showMonthYear"];

if (!$showMonthYear) {
	$sql = "SELECT id,buyDate,totalValue,userId,affliateId,affliateValue,information FROM transfers_affliates where affliateId = $id";
} else {
	$showMonth = substr($showMonthYear, 0, strpos($showMonthYear, "-"));
	$showYear = substr($showMonthYear, strpos($showMonthYear, "-")+1, 4);
	$sql = "SELECT id,buyDate,totalValue,userId,affliateId,affliateValue,information FROM transfers_affliates where affliateId = $id and buyMonth = $showMonth and buyYear = $showYear";
}


?>
<script>
function confirmDelete() {

    var is_confirmed = confirm('<?=$lang_affliatetransfers_delete?>');

    return is_confirmed;

}

function changeMonth() {

	document.forms.monthForm.submit();

}

</script>
<form method="post" action="transfers_affliate.php?id=<?=$id?>" name="monthForm" id="monthForm">
<font class="smalltext"><b><?=$lang_affliatetransfers_selectmonth?>:</b> </font><select class="inputField" name="showMonthYear" onChange="changeMonth()">
<option value=""<? if (!$showMonthYear) { echo " selected"; } ?>><?=$lang_affliatetransfers_selectmonth_all?></option>
<?

// I Need to get all the months since the register date (including the register month)

$compYear = date("Y");
$compMonth = date("n");

$userDate = GetRow("Select registerDate From users_affliates Where id = $id"); // 2005-09-11
$userYear = substr($userDate, 0, 4);
$userMonth = substr($userDate, 5, 2);

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

gui_tabletop(array($lang_affliatetransfers_table_date, $lang_affliatetransfers_table_username, $lang_affliatetransfers_table_description, $lang_affliatetransfers_table_value, $lang_affliatetransfers_table_commissionvalue), 1);

$result = mysql_query($sql, $mysql_link);

$valueTotal = 0;
$valuePercent = 0;
$i = 0;
$a = 0;

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
		$affliateId = $row["affliateId"];
		$userId = $row["userId"];
		$information = $row["information"];
		$totalValue = $row["totalValue"];
		$affliateValue = $row["affliateValue"];
		$buyMonth = $row["buyMonth"];
		$buyYear = $row["buyYear"];
		$buyDate = changeMysqlTime($row["buyDate"]);

		$username = GetRow("Select username from users where id = $userId");

		$valuePercent = $valuePercent+$affliateValue;
		$valueTotal = $valueTotal+$totalValue;

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="7"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$buyDate?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userId?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$information?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=formatMoney($totalValue)?> <?=$lang_system_moneyafter?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=formatMoney($affliateValue)?> <?=$lang_system_moneyafter?></td>
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
    <td bgcolor="#F7F7F7" height="1" colspan="11" background="../images/table_dots2.png"></td>
  </tr>
  <tr>
    <td bgcolor="#FFFFFF" align="right" class="tabletop" colspan="8"><?=$lang_affliatetransfers_total?>:&nbsp;&nbsp;&nbsp;</td>
    <td bgcolor="#FFFFFF" class="tabletop"><?=$lang_system_moneybefore?> <?=formatMoney($valueTotal)?> <?=$lang_system_moneyafter?></td>
    <td bgcolor="#FFFFFF" height="23" width="10" align="center"><img src="../images/table_dots.png"></td>
    <td bgcolor="#FFFFFF" class="tabletop"><?=$lang_system_moneybefore?> <?=formatMoney($valuePercent)?> <?=$lang_system_moneyafter?></td>
  </tr>
</table><br>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
<? gui_bottom(); ?>