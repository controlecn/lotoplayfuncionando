<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Afiliados Cadastrados", "../");

?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_affliateoverview_delete?>');
}
</script>

<?

gui_tabletop(array($lang_affliateoverview_table_login, $lang_affliateoverview_table_name, $lang_affliateoverview_table_city, $lang_affliateoverview_table_state, $lang_affliateoverview_table_transfers), 1);

$sql = "SELECT * FROM users_affliates";

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


		$tr = 0;

		$id = $row["id"];
		$login = $row["login"];
		$url = $row["url"];
		$name = $row["name"];
		$city = $row["city"];
		$state = $row["state"];

		$tr = GetRow("SELECT COUNT(id) FROM transfers_affliates WHERE affliateId = '$id'");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="8"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="info.php?id=<?=$id?>" class="link"><?=$login?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="http://anonym.to/?<?=$url?>" class="link" target="_blank"><?=$name?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$city?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$state?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$tr?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="info.php?id=<?=$id?>"><img src="../images/icons/info.gif" alt="<?=$lang_affliateoverview_table_view?>" border="0"></a>&nbsp;&nbsp;<a href="transfers_affliate.php?id=<?=$id?>"><img src="../images/icons/coins_info.gif" alt="<?=$lang_affliateoverview_table_viewtransfers?>" border="0"></a>&nbsp;&nbsp;<a href="delete.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_affliateoverview_table_delete?>" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}


if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"8\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>