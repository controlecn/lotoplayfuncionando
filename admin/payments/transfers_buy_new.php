<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');
gui_header("Novo pedido", "../");

?>
<script src="../js/jquery-1.2.3.min.js"></script>
<script src="../js/jquery.suggest.js"></script>
<link href="../css/jquery.suggest.css" rel="stylesheet" type="text/css" />
<script>
jQuery(function() {
jQuery("#selectusername").suggest("../autocomplete_users.php",{
onSelect: function() {}});
});
</script>
<form method="post" action="transfers_buy_new_upd.php">
<font class="tabletop">

<?=$lang_transfersadd_username?>:<br>
<input type="text" name="username" id="selectusername">
<br><br>

Valor:<br>
<select name="valueId">
<option value="0" selected>Escolhe...</option>
<?

	$sql = "SELECT * FROM buy_values";
	$result = mysql_query($sql,$mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$value = $row["value"];
			$name = $row["name"];

			echo "<option value=\"$id\">$name</option>";

		}

	mysql_free_result($result);

	}

?>
</select>
<br><br>
Forma de pagamento:<br>
<select name="forma" class="inputField">
<option value="0" selected>Escolhe...</option>
<?

	$sql = "SELECT * FROM buy_paymentforms";
	$result = mysql_query($sql, $mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$name = $row["name"];

			echo "<option value=\"$id\">$name</option>";

		}

	mysql_free_result($result);

	}

?></select><br><br>

<input type="submit" value="Adicionar" name="submitbutton">
</form>
<? gui_bottom(); ?>