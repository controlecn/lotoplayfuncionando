<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);

gui_header("Admin Log", "../");

$username = $_POST["username"];
$view_users = $_POST["view_users"];

?>
<form method="post" action="admin_log.php">
Ver usuario:
<select name="username">
<?
$result = mysql_query("SELECT DISTINCT username FROM admin_log ORDER BY id DESC", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {
		$username2 = $row["username"];
		if ($username==$username2) {
			echo "<option value=\"$username2\" selected>$username2</option>";
		} else {
			echo "<option value=\"$username2\">$username2</option>";
		}
	}

mysql_free_result($result);

}
?>
</select>
<input type="submit" value="Mostrar" name="view_users">
</form>
<?

gui_tabletop(array("Usuario", "Hora", "Operação"), 0);

if ($view_users) {
	$sql = "SELECT * FROM admin_log WHERE username = '$username' ORDER BY id DESC";
} else {
	$sql = "SELECT * FROM admin_log ORDER BY id DESC";
}

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
		$username = $row["username"];
		$actionDate = $row["actionDate"];
		$action = $row["action"];
			
		$actionDate = substr($actionDate,8,2)."/".substr($actionDate,5,2)." ".substr($actionDate,11,5);

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="5"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$username?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$actionDate?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$action?></td>
  </tr>

		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"5\" class=\"tabletext\" height=\"20\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table>
<? gui_bottom(); ?>