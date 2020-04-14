<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Banners", "../");

?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_affliatebanners_view_delete?>');
}

</script>
<a href="banners_add.php" class="link"><?=$lang_affliatebanners_view_add?></a>
<br><br>

<?

gui_tabletop(array($lang_affliatebanners_view_table_description, "Tamanho"), 1);

$sql = "SELECT id,name,size FROM affliates_banners";

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
		$name = $row["name"];
		$size = $row["size"];
		
		switch($size) {
			case 1:	$sizeName = "Banners em flash: 468 x 60"; break;
			case 2:	$sizeName = "Banners em flash: 392 x 72"; break;
			case 3:	$sizeName = "Banners em flash: 120 x 240"; break;
			case 4:	$sizeName = "Banners em gif e jpeg: 120 x 90"; break;
			case 5:	$sizeName = "Banners em gif e jpeg: 88 x 31"; break;
			case 6:	$sizeName = "Banners em flash: 160 x 600"; break;
		}

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="5"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$name?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$sizeName?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="banners_edit.php?id=<?=$id?>"><img src="../images/icons/edit.gif" alt="<?=$lang_affliatebanners_view_table_change?>" border="0"></a>&nbsp;&nbsp;<a href="banners_delete.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_affliatebanners_view_table_delete?>" border="0"></a></td>
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