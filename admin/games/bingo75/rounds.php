<?

include('../../include_functions.php');
include('../../include_guifunctions.php');

checkAccess(1);

gui_header("Rodadas Passadas", "../../");

$showQt = $_POST["showQt"];

if (!$showQt) {
	$showQt = 25;
}

if ($showQt=="all") {

	$sql = "Select * from bingo75_results ORDER BY bingoDate DESC";
	
} else {

	$sql = "Select * from bingo75_results ORDER BY bingoDate DESC LIMIT $showQt";

}

?>
<form id="ChangeForm" name="ChangeForm" method="post" action="rounds.php">
<select name="showQt" onChange="ChangeForm.submit()">
<option value="25"<? if($showQt==25) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last25?></option>
<option value="50"<? if($showQt==50) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last50?></option>
<option value="100"<? if($showQt==100) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last100?></option>
<option value="200"<? if($showQt==200) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last200?></option>
<option value="all"<? if($showQt=="all") { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_all?></option>
</select>

</form>

<?

gui_tabletop(array($lang_bingorounds_passed_table_date, "Ganhador", $lang_bingorounds_passed_table_cards, $lang_bingorounds_passed_table_prize), 0);

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
		$bingoDate = changeMysqlTime($row["bingoDate"]);
		$prize = $row["jackpot"];
		$cards = $row["cards"];
		$user = $row["winnersId"];

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="6"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bingoDate?></td>
	<? if (substr_count($user, ",")==0) { ?>
	<? $userid = GetRow("SELECT id FROM users WHERE username = '$user'"); ?>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../../users/user_info.php?id=<?=$userid?>" class="link"><?=$user?></a></td>
	<? } else { ?>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$user?></td>
	<? } ?>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$cards?></td>
	<? if (is_numeric($prize)) { ?>
	<td bgcolor="<?=$color?>" height="23" class="tabletext">R$ <?=credits2money($prize)?></td>
	<? } else { ?>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$prize?></td>
	<? } ?>
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