<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Ban IP", "../");

if ($_GET["cmd"]=="add") {

	SqlQuery("INSERT INTO fraud_banip (ip) VALUES ('".$_POST["ip"]."')");

}

?>
<form method="post" action="ban_ip.php?cmd=add">
<input type="text" name="ip" size="50">
<input type="submit" name="submitbutton" value="Adicionar">
</form>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<?

}

gui_tabletop(array($lang_help_categories_view_table_name), 1);

$sql = "SELECT * FROM fraud_banip";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		$i++;

		$id = $row["id"];
		$ip = $row["ip"];

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$ip?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="ban_ip_delete.php?id=<?=$id?>"><img src="../images/icons/delete.gif" alt="Deletar" border="0"></a></td>
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