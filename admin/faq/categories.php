<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Categorias", "../");

?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_help_categories_view_delete?>');
}
</script>
<a href="categories_add.php" class="link"><?=$lang_help_categories_view_add?></a>
<br><br>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<?

}

gui_tabletop(array($lang_help_categories_view_table_name), 1);

$sql = "Select id,name from faq_categories";

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
		$name = $row["name"];

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="category.php?categoryId=<?=$id?>" class="link"><?=$name?></a></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="categories_edit.php?id=<?=$id?>"><img src="../images/icons/edit.gif" alt="<?=$lang_help_categories_view_table_edit?>" border="0"></a>&nbsp;&nbsp;<a href="categories_delete.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_help_categories_view_table_delete?>" border="0"></a></td>
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