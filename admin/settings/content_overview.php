<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Conteúdo", "../");

?>
<table width="80%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#F7F7F7" height="23" class="tabletop"><?=$lang_content_table_name?></td>
  </tr>
<?

$result = mysql_query("SELECT code FROM content ORDER BY code", $mysql_link);

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
    <td bgcolor="#F7F7F7" height="1" background="../images/table_dots2.png"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="content_edit.php?code=<?=$code?>" class="link"><?=$code?></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

?>
</table><br><br>
<? gui_bottom(); ?>