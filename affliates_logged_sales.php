<?

$showMonthYear = sql_injection_check($_POST["showMonthYear"]);

if (!$showMonthYear) {
	$showMonthYear = date("n")."-".date("Y");
}

$showMonth = substr($showMonthYear, 0, strpos($showMonthYear, "-"));
$showYear = substr($showMonthYear, strpos($showMonthYear, "-")+1, 4);

function monthName ($month) {

	global $lang;
	
	return $lang["month_".$month];

}


?><h1><?=$lang["affliates_sales_title"]?></h1>

<form method="post" action="<?=$links["AFFILIATES_SALES"]?>" id="sales_form">

<?=$lang["affliates_sales_selectmonth"]?>: 

<select name="showMonthYear" id="showMonthYear" class="registration_text" onchange="document.getElementById('sales_form').submit()">
<?

// I Need to get all the months since the register date (including the register month)

$compYear = date("Y");
$compMonth = date("n");

$userDate = GetRow("SELECT registerDate FROM users_affliates WHERE id = '$affliate_logged_user'");
$userYear = substr($userDate, 0, 4);
$userMonth = substr($userDate, 5, 2);

if (substr($userMonth,0,1)=="0") { $userMonth=str_replace("0", "", $userMonth); } // Erase the leading zero

if ($compYear==$userYear) {

	// The user registered in this year, only list the months since he registered

	if ($compMonth==$userMonth) {

		// He actually registered this month... Only list one month (this one)

		echo "<option value=\"$compMonth-$userYear\" selected=\"selected\">$userYear - ".monthName($compMonth)."</option>";


	} else {

		// List the months, in this order = desember to january (only this year since he registered in this year

		for ($a=$compMonth; $a>=$userMonth; $a--) {

			if ($showMonthYear=="$a-$userYear") {
				echo "<option value=\"$a-$userYear\"  selected=\"selected\">$userYear - ".monthName($a)."</option>";
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
						echo "<option value=\"$c-$b\"  selected=\"selected\">$b - ".monthName($c)."</option>";
					} else {
						echo "<option value=\"$c-$b\">$b - ".monthName($c)."</option>";
					}
				}

			} else {

				// List all twelve months in this year

				if ($showMonthYear=="12-$b") {
					 echo "<option value=\"12-$b\"  selected=\"selected\">$b - ".monthName(12)."</option>";
				} else { echo "<option value=\"12-$b\">$b - ".monthName(12)."</option>"; }

				if ($showMonthYear=="11-$b") {
					 echo "<option value=\"11-$b\"  selected=\"selected\">$b - ".monthName(11)."</option>";
				} else { echo "<option value=\"11-$b\">$b - ".monthName(11)."</option>"; }

				if ($showMonthYear=="10-$b") {
					 echo "<option value=\"10-$b\"  selected=\"selected\">$b - ".monthName(10)."</option>";
				} else { echo "<option value=\"10-$b\">$b - ".monthName(10)."</option>"; }

				if ($showMonthYear=="9-$b") {
					 echo "<option value=\"9-$b\"  selected=\"selected\">$b - ".monthName(9)."</option>";
				} else { echo "<option value=\"9-$b\">$b - ".monthName(9)."</option>"; }

				if ($showMonthYear=="8-$b") {
					 echo "<option value=\"8-$b\"  selected=\"selected\">$b - ".monthName(8)."</option>";
				} else { echo "<option value=\"8-$b\">$b - ".monthName(8)."</option>"; }

				if ($showMonthYear=="7-$b") {
					 echo "<option value=\"7-$b\"  selected=\"selected\">$b - ".monthName(7)."</option>";
				} else { echo "<option value=\"7-$b\">$b - ".monthName(7)."</option>"; }

				if ($showMonthYear=="6-$b") {
					 echo "<option value=\"6-$b\"  selected=\"selected\">$b - ".monthName(6)."</option>";
				} else { echo "<option value=\"6-$b\">$b - ".monthName(6)."</option>"; }

				if ($showMonthYear=="5-$b") {
					 echo "<option value=\"5-$b\"  selected=\"selected\">$b - ".monthName(5)."</option>";
				} else { echo "<option value=\"5-$b\">$b - ".monthName(5)."</option>"; }

				if ($showMonthYear=="4-$b") {
					 echo "<option value=\"4-$b\"  selected=\"selected\">$b - ".monthName(4)."</option>";
				} else { echo "<option value=\"4-$b\">$b - ".monthName(4)."</option>"; }

				if ($showMonthYear=="3-$b") {
					 echo "<option value=\"3-$b\"  selected=\"selected\">$b - ".monthName(3)."</option>";
				} else { echo "<option value=\"3-$b\">$b - ".monthName(3)."</option>"; }

				if ($showMonthYear=="2-$b") {
					 echo "<option value=\"2-$b\"  selected=\"selected\">$b - ".monthName(2)."</option>";
				} else { echo "<option value=\"2-$b\">$b - ".monthName(2)."</option>"; }

				if ($showMonthYear=="1-$b") {
					 echo "<option value=\"1-$b\"  selected=\"selected\">$b - ".monthName(1)."</option>";
				} else { echo "<option value=\"1-$b\">$b - ".monthName(1)."</option>"; }

			}


		} else {

			// List only the months since he registered this year

			for ($d=12; $d>=$userMonth; $d--) {
				if ($showMonthYear=="$d-$b") {
					echo "<option value=\"$d-$b\"  selected=\"selected\">$b - ".monthName($d)."</option>";
				} else {
					echo "<option value=\"$d-$b\">$b - ".monthName($d)."</option>";
				}
			}

		}

	}

}

?>
</select>

</form>

<table width="520" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="110"><b><?=$lang["affliates_sales_table_date"]?></b></td>
		<td width="310"><b><?=$lang["affliates_sales_table_client"]?></b></td>
		<td width="100"><b><?=$lang["affliates_sales_table_value"]?></b></td>
		<td width="100"><b><?=$lang["affliates_sales_table_comission"]?></b></td>
	</tr>
</table>
<table width="520" border="0" cellspacing="0" cellpadding="4" style="border: 1px #888888 solid">
<?

$sql = "SELECT * FROM transfers_affliates WHERE affliateId = '$affliate_logged_user' and buyMonth = $showMonth and buyYear = $showYear";
$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i=0;

	$percentValueTotal = 0;
	$valueTotal = 0;

	while ($row = mysql_fetch_array($result)) {

		if($i%2 == 0) {
			$color = "#F7F7F7";
			$i++;
		} else {
			$color = "#FFFFFF";
			$i++;
		}

		$id = $row["id"];
		$userId = $row["userId"];
		$transferDate = changeMysqlTime($row["buyDate"]);
		$value = $row["totalValue"];
		$percentValue = $row["affliateValue"];
		
		$username = GetRow("SELECT username FROM users WHERE id = '$userId'");
		
		?>
		<tr>
			<td width="110" bgcolor="<?=$color?>"><b><?=$transferDate?></b></td>
			<td width="310" bgcolor="<?=$color?>"><b><?=$username?></b></td>
			<td width="100" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=formatMoney($value)?><?=$lang["currency_2"]?></b></td>
			<td width="100" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=formatMoney($percentValue)?><?=$lang["currency_2"]?></b></td>
		</tr>
		<?

		$percentValueTotal = $percentValueTotal + $percentValue;
		$valueTotal = $valueTotal + $value;

	}

	mysql_free_result($result);

}

if($i==0) {
	?>
		<tr>
			<td colspan="4" bgcolor="#F7F7F7"><?=$lang["affliates_sales_table_nosales"]?></td>
		</tr>
	<?

} else {

	if (!$valueTotal) {
		$valueTotal = 0;
	}

	if (!$percentValueTotal) {
		$percentValueTotal = 0;
	}

	if ($color=="#F7F7F7") {
		$color = "#FFFFFF";
	} else {
		$color = "#F7F7F7";
	}

	?>
			<tr>
				<td colspan="2" bgcolor="<?=$color?>" align="right"><b><?=$lang["affliates_sales_table_total"]?>:&nbsp;</b></td>
				<td width="100" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=formatMoney($valueTotal)?><?=$lang["currency_2"]?></b></td>
				<td width="100" bgcolor="<?=$color?>"><b><?=$lang["currency_1"]?><?=formatMoney($percentValueTotal)?><?=$lang["currency_2"]?></b></td>
			</tr>
<? } ?>
</table>
<br /><a href="<?=$links["AFFILIATES"]?>" class="blink"><?=$lang["affliates_back"]?></a>