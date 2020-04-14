<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Resumo de emails", "../");

gui_tabletop(array($lang_emailoverview_table_name), 1);

$result = mysql_query("SELECT code FROM emails ORDER BY code", $mysql_link);

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

		$code = $row["code"];

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="email_edit.php?code=<?=$code?>" class="link"><?=$code?></a></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="email_edit.php?code=<?=$code?>"><img src="../images/icons/edit.gif" alt="<?=$lang_emailoverview_table_edit?>" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

?>
</table>
<? gui_bottom(); ?>