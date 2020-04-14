<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Prevenção de Fraude", "../");

SqlQuery("TRUNCATE `fraud_detection`");

$result = mysql_query("SELECT user_id FROM fraud_alerts", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {
	
		$user_id = $row["user_id"];
		

	
		if (GetRow("SELECT COUNT(user_id) FROM fraud_detection WHERE user_id = '$user_id'")==0) {
			SqlQuery("INSERT INTO fraud_detection (user_id, alerts) VALUES ('$user_id', 1)");
		} else {
			$alerts = GetRow("SELECT alerts FROM fraud_detection WHERE user_id = '$user_id'");
			$alerts++;
			SqlQuery("UPDATE fraud_detection SET alerts = '$alerts' WHERE user_id = '$user_id'");
		}
	
		
	}
	mysql_free_result($result);
}



?>
<script>
function showInfo(username, alerts) {

	texto = "Usuário: "+username+"\n";

	if (alerts!=0) {
		texto += "Ele tem "+alerts+" alertas de tapiação.\n\n";
	}
	
	alert(texto);
}
</script>
<?

gui_tabletop(array("Apelido", "Informações"), 0);

$result = mysql_query("SELECT * FROM fraud_detection ORDER BY alerts DESC", $mysql_link);

$a=0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		$user_id = $row["user_id"];
		$alerts = $row["alerts"];

		$username = GetRow("Select username from users where id = $user_id");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="4"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$user_id?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$user_id?>" class="link"><?=$username?></a></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><a href="#" onClick="showInfo('<?=$username?>', '<?=$alerts?>')"><img src="../images/icons/info.gif" alt="Por que..." border="0"></a></td>

  </tr>
		<?

		$i++;

	}

	mysql_free_result($result);

}

?>
</table><br>
<?

SqlQuery("TRUNCATE `fraud_detection`");

gui_bottom();

?>