<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Dicas", "../");

?>
<a class="link" href="advice_add.php">Adicionar nova dica!</a>
<script>
function confirmDelete() {
    return confirm('<?=$lang_paymentforms_view_delete?>');
}
</script>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<?
} 

gui_tabletop(array("Dica"), 1);

$sql = "SELECT id,headline FROM advice ORDER BY headline";

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
		$headline = $row["headline"];

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$headline?></td>
	<td bgcolor="<?=$color?>" height="23" align="center" valign="middle"><a href="advice_edit.php?id=<?=$id?>"><img src="../images/icons/edit.gif" alt="<?=$lang_paymentforms_view_table_change?>" border="0"></a>&nbsp;&nbsp;<a href="advice_delete.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_paymentforms_view_table_delete?>" border="0"></a></td>
  </tr>
	<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"4\" class=\"smalltext\" height=\"20\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>