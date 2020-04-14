<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Produtos Comprados", "../");

?>
<script>
function confirmDelete() {
    return confirm('Tem certeza?');
}
</script>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<?
} 

gui_tabletop(array("Usuario", "Produto"), 1);

$sql = "SELECT * FROM points_bought WHERE productid != 1 ORDER BY id";

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
		$productid = $row["productid"];
		
		$username = GetRow("SELECT username FROM users WHERE id = '$userid'");
		$productname = GetRow("SELECT name FROM points_products WHERE id = '$productid'");
		
		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="6"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userid?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$productname?></td>
	<td bgcolor="<?=$color?>" height="23" align="center" valign="middle"><a href="produtos_upd.php?id=<?=$id?>"><img src="../images/icons/check.gif" alt="Liberar" border="0"></a></td>
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