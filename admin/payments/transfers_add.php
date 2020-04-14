<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');
gui_header("Adicionar Transferência", "../");

$error = $_GET["error"];

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
<form name="updateForm" id="updateForm" method="POST" action="transfers_add_upd.php">
<font class="tabletop">

<? if ($error==1) { ?><b>Erro: Usuario invalido!</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Valor invalido!</b><br><br><? } ?>

<?=$lang_transfersadd_username?>:<br>
<input type="text" name="username" id="selectusername">
<br><br>

<?=$lang_transfersadd_value?>:<br>
<input class="tabletext" type="text" name="transfervalue" style="width: 360px">
<br><br>

<?=$lang_transfersadd_description?>:<br>
<input class="tabletext" type="text" name="description" style="width: 360px">
<br><br>

<input type="radio" name="transfertype2" value="bonus" checked><font class="tabletext"><?=$lang_transfersadd_bonus?></font>
<br>
<input type="radio" name="transfertype2" value="buy"><font class="tabletext"><?=$lang_transfersadd_buy?></font>
<br>
<input type="radio" name="transfertype2" value="bet"><font class="tabletext"><?=$lang_transfersadd_bet?></font>
<br>
<input type="radio" name="transfertype2" value="prize"><font class="tabletext"><?=$lang_transfersadd_prize?></font>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>