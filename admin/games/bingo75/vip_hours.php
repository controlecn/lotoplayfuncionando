<?

include('../../include_functions.php');
include('../../include_guifunctions.php');
checkAccess(2);
gui_header("Horários dos VIP", "../../");

gui_tabletop(array("Hora", "Jogadores MIN", "Jogadores MAX", "Cartelas MIN", "Cartelas MAX", "Prêmio"), 1);

$result = mysql_query("SELECT * FROM cron_vip ORDER BY hours", $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		$id = $row["id"];
		$active = $row["active"];
		$hours = $row["hours"];
		$players_min = $row["players_min"];
		$players_max = $row["players_max"];
		$cards_min = $row["cards_min"];
		$cards_max = $row["cards_max"];
		$prize_percents = $row["prize_percents"];
		
		if ($active==1) {
			$color = "#c6ffa3";
		} else {
			$color = "#ffbaba";
		}

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="9"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><b><?=$hours?>:00</b></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><b><?=$players_min?></b></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><b><?=$players_max?></b></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><b><?=$cards_min?></b></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><b><?=$cards_max?></b></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><b><?=$prize_percents?></b></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="vip_hours_edit.php?hours=<?=$hours?>"><img src="../../images/icons/info.gif" alt="<?=$lang_accountsoverview_table_showinfo?>" border="0"></a></td>

  </tr>
		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"9\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?> 