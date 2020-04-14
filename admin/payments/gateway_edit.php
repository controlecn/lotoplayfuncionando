<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Forma de pagamento - Editar", "../");

$id = $_REQUEST["id"];

$sql = "SELECT * FROM buy_paymentforms WHERE id = '$id'";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);
    
	$name = $row["name"];
	$name_short = $row["name_short"];
	$information = $row["information"];
	$onlinebankurl = $row["onlinebankurl"];
	$onlinebanktext = $row["onlinebanktext"];
	$disabled = $row["disabled"];

	mysql_free_result($result);

}

?>
<form name="updateForm" id="updateForm" method="POST" action="gateway_edit_upd.php">
<font class="tabletop">

<?=$lang_paymentforms_edit_name?>:<br>
<input class="tabletext" type="text" name="name" style="width: 360px" value="<?=$name?>">
<br><br>

Nome (Pequeno):<br>
<input class="tabletext" type="text" name="name_short" style="width: 360px" value="<?=$name_short?>">
<br><br>

<?=$lang_paymentforms_edit_internetbanking_url?>:<br>
<input class="tabletext" type="text" name="onlinebankurl" style="width: 360px" value="<?=$onlinebankurl?>">
<br><br>

<?=$lang_paymentforms_edit_internetbanking_text?>:<br>
<input class="tabletext" type="text" name="onlinebanktext" style="width: 360px" value="<?=$onlinebanktext?>">
<br><br>


<?=$lang_paymentforms_edit_information?>:<br>
<textarea class="tabletext" style="height: 140px; width: 360px" name="information"><?=$information?></textarea>
<br><br>

Desabilitado:<br>
<input type="radio" name="disabled" value="1"<? if ($disabled==1) echo " checked=\"checked\""; ?>> Sim
<input type="radio" name="disabled" value="0"<? if ($disabled==0) echo " checked=\"checked\""; ?>> Não
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>