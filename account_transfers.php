<?

if (!$_POST["view_qt"]) {
	$view_qt = 1;
} else {

	if (($_POST["view_qt"]!=1)&&($_POST["view_qt"]!=2)&&($_POST["view_qt"]!=3)&&($_POST["view_qt"]!=4)&&($_POST["view_qt"]!=5)) {
		$view_qt = 1;
	} else {
		$view_qt = $_POST["view_qt"];
	}

}

?><h1><?=$lang["account_transfers_title"]?></h1>

<form method="post" action="<?=$links["ACCOUNT_TRANSFERS"]?>" id="transfers_form">
<p><?=$lang["account_transfers_view"]?>:
<select name="view_qt" onchange="document.getElementById('transfers_form').submit()">
	<option value="1"<? if ($view_qt==1) echo " selected=\"selected\""; ?>><?=$lang["account_transfers_view_last10"]?></option>
	<option value="2"<? if ($view_qt==2) echo " selected=\"selected\""; ?>><?=$lang["account_transfers_view_last20"]?></option>
	<option value="3"<? if ($view_qt==3) echo " selected=\"selected\""; ?>><?=$lang["account_transfers_view_last50"]?></option>
	<option value="4"<? if ($view_qt==4) echo " selected=\"selected\""; ?>><?=$lang["account_transfers_view_last100"]?></option>
	<option value="5"<? if ($view_qt==5) echo " selected=\"selected\""; ?>><?=$lang["account_transfers_view_all"]?></option>
</select></p>
</form>
<br />
<table width="520" border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td width="110"><b><?=$lang["account_transfers_table_date"]?></b></td>
		<td width="310"><b><?=$lang["account_transfers_table_description"]?></b></td>
		<td width="100"><b><?=$lang["account_transfers_table_value"]?></b></td>
	</tr>
</table>
<table width="520" border="0" cellspacing="0" cellpadding="4" style="border: 1px #888888 solid">
<?

switch ($view_qt) {
	case 1:	$sql = "SELECT transferDate,value,transferType,information,bonus FROM transfers WHERE transferDate <= now() AND userId = '".$user_data["id"]."' ORDER BY transferDate DESC LIMIT 10"; break;
	case 2:	$sql = "SELECT transferDate,value,transferType,information,bonus FROM transfers WHERE transferDate <= now() AND userId = '".$user_data["id"]."' ORDER BY transferDate DESC LIMIT 20"; break;
	case 3:	$sql = "SELECT transferDate,value,transferType,information,bonus FROM transfers WHERE transferDate <= now() AND userId = '".$user_data["id"]."' ORDER BY transferDate DESC LIMIT 50"; break;
	case 4:	$sql = "SELECT transferDate,value,transferType,information,bonus FROM transfers WHERE transferDate <= now() AND userId = '".$user_data["id"]."' ORDER BY transferDate DESC LIMIT 100"; break;
	case 5:	$sql = "SELECT transferDate,value,transferType,information,bonus FROM transfers WHERE transferDate <= now() AND userId = '".$user_data["id"]."' ORDER BY transferDate DESC"; break;
}



$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i = 0;
	$a = 0;

	while ($row = mysql_fetch_array($result)) {
	
		$a++;
	
		if($i%2 == 0) {
			$color = "#F7F7F7";
			$i++;
		} else {
			$color = "#FFFFFF";
			$i++;
		}

		$transferDate = changeMysqlTime($row["transferDate"]);
		$value = $row["value"];
		$transferType = $row["transferType"];
		$information = $row["information"];
		$isBonus = $row["bonus"];

		if ($transferType==2) {
			$prefix = "+";
			$fcolor = "#3f7f00";
		} else {
			$prefix = "-";
			$fcolor = "#FF0000";
		}

		?>
		<tr>
			<td width="110" bgcolor="<?=$color?>"><font color="<?=$fcolor?>"><b><?=$transferDate?></b></font></td>
			<td width="310" bgcolor="<?=$color?>"><font color="<?=$fcolor?>"><b><?=$information?></b></font></td>
			<td width="100" bgcolor="<?=$color?>"><font color="<?=$fcolor?>"><b><?=$value?><?=$prefix?></b></font></td>
		</tr>
		<?
	}

	mysql_free_result($result);
	
	if ($a==0) {
		?>
		<tr>
			<td bgcolor="#F7F7F7"><?=$lang["account_transfers_nothing"]?></td>
		</tr>
		<?
	}

}

?>
</table>
<br />

<a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_transfers_back"]?></a>