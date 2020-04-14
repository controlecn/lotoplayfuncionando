<?

include('../../include_functions.php');
include('../../include_guifunctions.php');

checkAccess(2);

gui_header("Rodadas Especiais", "../../");

?>
<a href="special_rounds_add.php" class="link">Adicionar uma Rodada Especial</a><br><br>
<?

gui_tabletop(array("Data/Hora", "Tipo", "Prêmio", "VIP", "Ganhadores"), 0);

$result = mysql_query("SELECT * FROM bingo75_rounds ORDER BY round_time", $mysql_link);

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
		$round_time = changeMysqlTime($row["round_time"]);
		$round_type = $row["round_type"];
		$round_object = $row["round_object"];
		$round_prize = $row["round_prize"];
		$round_vip = $row["round_vip"];
		$round_winners = $row["round_winners"];
		
		if ($round_type==2) $round_prize = $round_object;
		
		switch ($round_type) {
			case 1:	$round_type = "Prêmio Fixo em créditos"; break;
			case 2: $round_type = "Prêmio Fixo em objeto"; break;
		}
		
		switch ($round_vip) {
			case 0:	$round_vip = "Ganhador NÃO pode ser VIP"; break;
			case 1: $round_vip = "Ganhador pode ser VIP"; break;
			case 2: $round_vip = "Ganhador deve ser VIP"; break;
		}
		
		switch ($round_winners) {
			case 0:	$round_winners = "Um"; break;
			case 1:	$round_winners = "Muitos"; break;
		}

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="7"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$round_time?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$round_type?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$round_prize?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$round_vip?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$round_winners?></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"7\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>