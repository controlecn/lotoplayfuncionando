<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');
gui_header("Resumo de Transferências", "../");

$sql = "";

$showQt = $_REQUEST["showQt"];
$showTp = $_REQUEST["showTp"];
$username = $_REQUEST["username"];

if (!$username) {
	$showUser = "all";
} else {
	$showUser = GetRow("SELECT id FROM users WHERE username = '$username'");
	
	if (!$showUser) {
		$showUser = "all";
	}

}

if (!$showQt) {
	$showQt = "u25";
}

if (!$showUser) {
	$showUser = "all";
}

if (!$showTp) {
	$showTp = "all";
}

	if ($showQt=="all") {

		$limit = "";
		$timeperiod = "";

	} else if (substr($showQt, 0, 1)=="u") {

		$limit = " LIMIT ".substr($showQt, 1, strlen($showQt)-1);
		$timeperiod = "";

	} else {

		$limit = "";

		if ($showQt=="today") {
			// Today
			$timeperiod = " AND transferDate BETWEEN '".date("Y-m-d")." 00:00:00' AND '".date("Y-m-d")." 23:59:59'";

		} else if ($showQt=="week") {
			// This week
			$timeperiod = " AND transferDate > DATE_SUB('".date("Y-m-d")."', INTERVAL DAYOFWEEK('".date("Y-m-d")."') DAY)";

		} else {
			// This Month
			$timeperiod = " AND transferDate BETWEEN DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(NOW())-1 DAY) AND LAST_DAY(NOW())";
		}

	}

	switch ($showTp) {
	
		case "all":	$typeSql = "";
			break;

		case "buy":	$typeSql = " AND buy = 1";
			break;

		case "payout":	$typeSql = " AND payout = 1";
			break;

		case "bet":	$typeSql = " AND bet = 1";
			break;

		case "prize":	$typeSql = " AND prize = 1";
			break;

	}

	if ($showUser=="all") {
		$userSql = "";
	} else {
		$userSql = " AND userId = $showUser";

	}

	$sqlpart = "$timeperiod$typeSql$userSql";

	if (substr($sqlpart,0,4)==" AND") {
		$sqlpart = " WHERE " . substr($sqlpart, 5, strlen($sqlpart)-5);
	}

	$sql = "SELECT id,userId,affliateId,transferDate,value,transferType,information FROM transfers $sqlpart ORDER BY transferDate DESC$limit";


?>
<script src="../js/jquery-1.2.3.min.js"></script>
<script src="../js/jquery.suggest.js"></script>
<link href="../css/jquery.suggest.css" rel="stylesheet" type="text/css" />
<script>
jQuery(function() {
jQuery("#selectusername").suggest("../autocomplete_users.php",{
onSelect: function() {}});
});
function confirmDelete() {
    return is_confirmed = confirm('<?=$lang_transfers_delete?>');
}

</script>

<form id="ChangeForm" name="ChangeForm" action="transfers.php">
<select name="showQt" class="tabletext">
<option value="u25"<? if($showQt=="u25") { echo " selected"; } ?>><?=$lang_transfers_show_last25?></option>
<option value="u50"<? if($showQt=="u50") { echo " selected"; } ?>><?=$lang_transfers_show_last50?></option>
<option value="u100"<? if($showQt=="u100") { echo " selected"; } ?>><?=$lang_transfers_show_last100?></option>
<option value="u200"<? if($showQt=="u200") { echo " selected"; } ?>><?=$lang_transfers_show_last200?></option>
<option value="-">---------------------------</option>
<option value="today"<? if($showQt=="today") { echo " selected"; } ?>><?=$lang_transfers_show_today?></option>
<option value="week"<? if($showQt=="week") { echo " selected"; } ?>><?=$lang_transfers_show_thisweek?></option>
<option value="month"<? if($showQt=="month") { echo " selected"; } ?>><?=$lang_transfers_show_thismonth?></option>
<option value="-">---------------------------</option>
<option value="all"<? if($showQt=="all") { echo " selected"; } ?>><?=$lang_transfers_show_all?></option>
</select>
<font class="tabletop"><?=$lang_transfers_show_type?>:</font>
<select name="showTp" class="tabletext">
<option value="all"<? if($showTp=="all") { echo " selected"; } ?>><?=$lang_transfers_show_type_all?></option>
<option value="buy"<? if($showTp=="buy") { echo " selected"; } ?>><?=$lang_transfers_show_type_buy?></option>
<option value="payout"<? if($showTp=="payout") { echo " selected"; } ?>><?=$lang_transfers_show_type_payout?></option>
<option value="bet"<? if($showTp=="bet") { echo " selected"; } ?>><?=$lang_transfers_show_type_bet?></option>
<option value="prize"<? if($showTp=="prize") { echo " selected"; } ?>><?=$lang_transfers_show_type_prize?></option>
</select>

<font class="tabletop"><?=$lang_transfers_show_username?>:</font>
<input type="text" name="username" id="selectusername" value="<?=$username?>">
<input type="submit" name="submitbutton" value="<?=$lang_transfers_show_submitbutton?>" class="tabletext">
</form>
<?

gui_tabletop(array($lang_transfers_table_date, $lang_transfers_table_username, $lang_transfers_table_description, $lang_transfers_table_quantity), 1);

$id = $_REQUEST["id"];

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i=0;
	$a=0;

	while ($row = mysql_fetch_array($result)) {

			if($a%2 == 0) {
				$color = "#FFFFFF";
				$a++;
			} else {
 				$color = "#F7F7F7";
 				$a++;
			}

			$i++;

			$userId = $row["userId"];
			$socioId = $row["affliateId"];
			$id = $row["id"];
			$transferDate = changeMysqlTime($row["transferDate"]);
			$value = credits2money($row["value"]);
			$value_cr = $value / 0.25;
			$transferType = $row["transferType"];
			$information = $row["information"];
			$username = GetRow("Select username from users where id = $userId");

			if ($transferType==1) { $prFx = "-"; $fColor = "#ff0000"; }
			if ($transferType==2) { $prFx = "+"; $fColor = "#2b6501"; }

			?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="7"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$transferDate?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userId?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$information?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><font color="<?=$fColor?>">R$ <?=$value?><?=$prFx?></font></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="transfers_delete.php?id=<?=$id?>&showQt=<?=$showQt?>&showTp=<?=$showTp?>&showUser=<?=$showUser?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_transfers_table_delete?>" border="0"></a></td>
  </tr><?

	}

	mysql_free_result($result);

}

if ($i==0) {
		echo "<tr>
			<td class=\"label4\" align=\"center\" bgcolor=\"#FFFFFF\" colspan=\"7\">$lang_global_emptytable</td>
		      </tr>";
}

?>
</table>
<? gui_bottom(); ?>