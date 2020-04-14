<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);

gui_header("PHPLive Log", "../");

mysql_select_db("lotoplay_chat", $mysql_link);

$login = $_POST["login"];
$view_users = $_POST["view_users"];

$users = array();

?>
<form method="post" action="phplive_log_eventos.php">
Ver usuario:
<select name="login">
<?
$result = mysql_query("SELECT userID,login FROM chat_admin ORDER BY login DESC", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {
		$login2 = $row["login"];
		$userID = $row["userID"];
		$users[$userID] = $login2;
		if ($login==$userID) {
			echo "<option value=\"$userID\" selected>$login2</option>";
		} else {
			echo "<option value=\"$userID\">$login2</option>";
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

$time_now = time();
$time_3days = $time_now - 259200;

if ($view_users) {
	$sql = "SELECT * FROM chat_adminstatus WHERE userID = '$login' ORDER BY created";
} else {
	$sql = "SELECT * FROM chat_adminstatus ORDER BY created";
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
		
		$logID = $row["logID"];
		$userID = $row["userID"];
		$created = $row["created"];
		$status = $row["status"];
			
		$actionDate = date("d/m H:i", $created);
		
		if ($status==1) {
			$action = "Entrou";
		} else {
			$action = "Saiu";
		}
		
		$username = $users[$userID];
		$id = $logID;

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