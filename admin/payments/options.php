<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Bônus & Outros Opçoes", "../");

$error = $_GET["error"];

$forAffliates = getSetupVar("payment_forAffliates");
$creditValue = getSetupVar("server_creditvalue");
$points = getSetupVar("payment_points");

?>

<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font><br><br>
<? } ?>

<form name="updateForm" id="updateForm" method="POST" action="options_update.php">

<? if ($error==1) { ?><b>Erro: Valor errado (% de Afiliados)</b><br><br><? } ?>

<font class="tabletop">

<?=$lang_bonusoptions_affliatepercents?>:<br>
<input class="tabletext" type="text" name="forAffliates" value="<?=$forAffliates?>" style="width: 50px">
<br><br>

<?=$lang_bonusoptions_creditvalue?>:<br>
<input class="tabletext" type="text" name="creditValue" value="<?=$creditValue?>" style="width: 50px">
<br><br>

Qt Pontos para cada R$ 1:<br>
<input class="tabletext" type="text" name="points" value="<?=$points?>" style="width: 50px">
<br><br>

<input type="submit" value="Atualizar!" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>