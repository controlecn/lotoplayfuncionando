<?

include('../include_functions.php');
include('../include_guifunctions.php');

checkAccess(1);

gui_header("Resultos de Bonus Surpresa", "../");

$showQt = $_POST["showQt"];

if (!$showQt) {
	$showQt = 25;
}

if ($showQt=="all") {

	$sql = "Select * from bonus_results ORDER BY resultdate DESC";
	
} else {

	$sql = "Select * from bonus_results ORDER BY resultdate DESC LIMIT $showQt";

}

?>
<form id="ChangeForm" name="ChangeForm" method="post" action="results.php">
<select name="showQt" onChange="ChangeForm.submit()">
<option value="25"<? if($showQt==25) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last25?></option>
<option value="50"<? if($showQt==50) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last50?></option>
<option value="100"<? if($showQt==100) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last100?></option>
<option value="200"<? if($showQt==200) { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_last200?></option>
<option value="all"<? if($showQt=="all") { echo " selected"; } ?>><?=$lang_bingorounds_passed_show_all?></option>
</select>

</form>

<?

gui_tabletop(array($lang_bingorounds_passed_table_date, "Ganhador", "Quantidade"), 0);

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
		$userid = $row["userid"];
		$qt = credits2money($row["qt"]);
		$resultdate = changeMysqlTime($row["resultdate"]);
		
		$username = GetRow("SELECT username FROM users WHERE id = '$userid'");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="6"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$resultdate?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userid?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext">R$ <?=$qt?></td>
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