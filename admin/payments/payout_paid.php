<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');
gui_header("Saques Pagos", "../");

$showQt = $_REQUEST["showQt"];

if (!$showQt) $showQt = "today";

if ($showQt=="today") {
	// Today
	$timeperiod = "AND payDate BETWEEN '".date("Y-m-d")." 00:00:00' AND '".date("Y-m-d")." 23:59:59' ";
} else if ($showQt=="week") {
	// This week
	$timeperiod = "AND payDate > DATE_SUB('".date("Y-m-d")."', INTERVAL DAYOFWEEK('".date("Y-m-d")."') DAY) ";
} else if ($showQt=="month") {
	// This Month
	$timeperiod = "AND payDate BETWEEN DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(NOW())-1 DAY) AND LAST_DAY(NOW()) ";
} else {
	// All
	$timeperiod = "";
}


?>
<form id="ChangeForm" name="ChangeForm" action="payout_paid.php">
<select name="showQt" class="tabletext">
<option value="today"<? if($showQt=="today") { echo " selected"; } ?>>Hoje</option>
<option value="week"<? if($showQt=="week") { echo " selected"; } ?>>Esta semana</option>
<option value="month"<? if($showQt=="month") { echo " selected"; } ?>>Este mes</option>
<option value="all"<? if($showQt=="all") { echo " selected"; } ?>>Todos</option>
</select>
<input type="submit" name="submitbutton" value="Mostra">
</form>
<?

gui_tabletop(array($lang_payout_table_username, $lang_payout_table_paymenttype, $lang_payout_table_value), 1);

$sql = "Select * from transfers_payout WHERE status = 2 $timeperiod";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		$id = $row["id"];
		$userId = $row["userId"];
		$sacarDate = $row["payDate"];
		$quanto = $row["payValue"];
		$valid = $row["valid"];
		$recebervia_banco = $row["payBank"];

		$quantoReals = credits2money($row["payValue"]);

		$username = GetRow("Select username From users Where id = $userId");

		$bank = GetRow("Select name From affliates_banks Where number = $recebervia_banco");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="6"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userId?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bank?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$quantoReals?> <?=$lang_system_moneyafter?>&nbsp;(<?=$quanto?>)</td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="payout_info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_payout_table_info?>" border="0"></a></td>
  </tr>

		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"6\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>