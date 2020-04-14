<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Balanço do dia - Passo 1", "../");

?>
<form method="post" action="dia_step2.php">
<b>Escolhe o dia: </b>
<select name="dia">
<?

$result = mysql_query("SELECT * FROM `balanco_dias` WHERE `confirmado` = '0'", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$id = $row["id"];
		$dia = $row["dia"];
		
		$dia_year = substr($dia, 0, 4);
		$dia_month = substr($dia, 5, 2);
		$dia_day = substr($dia, 8, 2);

		echo "<option value=\"$id\">$dia_day / $dia_month / $dia_year</option>";

	}

mysql_free_result($result);

}
?>
	
</select>
<input type="submit" name="submitbutton" value="Fazer o Balanço">
</form>

<h2>Antes de comercar, faça a Planilha de Excel!</h2>
<? gui_bottom(); ?>