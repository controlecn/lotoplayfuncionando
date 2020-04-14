<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Forma de pagamento - Adicionar", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="gateway_add_upd.php">
<font class="tabletop">

<?=$lang_paymentforms_add_name?>:<br>
<input class="tabletext" type="text" name="name" style="width: 360px">
<br><br>

Nome (Pequeno):<br>
<input class="tabletext" type="text" name="name_short" style="width: 360px">
<br><br>

<?=$lang_paymentforms_add_internetbanking_url?>:<br>
<input class="tabletext" type="text" name="onlinebankurl" style="width: 360px">
<br><br>

<?=$lang_paymentforms_add_internetbanking_text?>:<br>
<input class="tabletext" type="text" name="onlinebanktext" style="width: 360px">
<br><br>


<?=$lang_paymentforms_add_information?>:<br>
<textarea class="tabletext" style="height: 140px; width: 360px" name="information"></textarea>
<br><br>

Desabilitado:<br>
<input type="radio" name="disabled" value="1"> Sim
<input type="radio" name="disabled" value="0" checked="checked"> Não
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>