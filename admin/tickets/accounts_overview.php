<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Emails - Contas para tickets", "../");

?>
<script>
function confirmDelete() {
    return confirm('Tem certeza?');
}
</script>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font><br><br>
<? } ?>
<a href="accounts_add.php" class="link">Adicionar...</a><br><br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#F7F7F7" height="23" width="40">&nbsp;</td>
	<td bgcolor="#F7F7F7" height="23" width="5"></td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Server</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">Email</td>
	<td bgcolor="#F7F7F7" height="23" align="center" width="80" class="tabletop"><?=$lang_global_operation?></td>
  </tr>
  <tr>
    <td bgcolor="#F7F7F7" height="1" colspan="7" background="../images/table_dots2.png"></td>
  </tr>
<?

$sql = "SELECT id,server,from_email FROM tickets_accounts";

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
		$server = $row["server"];
		$from_email = $row["from_email"];

		?>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$server?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$from_email?></td>
	<td bgcolor="<?=$color?>" height="23" align="center" valign="middle"><a href="accounts_edit.php?id=<?=$id?>"><img src="../images/icons/edit.gif" alt="<?=$lang_paymentforms_view_table_change?>" border="0"></a>&nbsp;&nbsp;<a href="accounts_delete.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_paymentforms_view_table_delete?>" border="0"></a></td>
  </tr>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="5"></td>
  </tr>
  <?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"5\" class=\"smalltext\" height=\"20\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>