<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
$categoryId = $_REQUEST["categoryId"];

$name = GetRow("SELECT name FROM faq_categories WHERE id = $categoryId");

gui_header("Perguntas Frequentes", "../");


?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_help_category_view_delete?>');
}
</script>
<a href="category_add.php?categoryId=<?=$categoryId?>" class="link"><?=$lang_help_category_view_add?></a>
<br><br>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<?

}

gui_tabletop(array($lang_help_category_view_table_question), 1);

$sql = "SELECT id,question FROM faq_questions WHERE categoryId = $categoryId";

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
		$question = $row["question"];

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$question?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="category_edit.php?id=<?=$id?>&categoryId=<?=$categoryId?>"><img src="../images/icons/edit.gif" alt="<?=$lang_help_category_view_table_edit?>" border="0"></a>&nbsp;&nbsp;<a href="category_delete.php?id=<?=$id?>&categoryId=<?=$categoryId?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_help_category_view_table_delete?>" border="0"></a></td>
  </tr>

		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"4\" class=\"tabletext\" height=\"20\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>