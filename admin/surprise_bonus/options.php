<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Configuração de bonus surpresa", "../");

$onoff = getSetupVar("surprise_bonus_active");
$min = getSetupVar("surprise_bonus_min");
$max = getSetupVar("surprise_bonus_max");

$error = $_GET["error"];

?>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<? } ?>
<form name="updateForm" id="updateForm" method="POST" action="options_update.php">
<font class="tabletop">

<? if ($error==1) { ?><b>Erro: Valor errado! (Min)</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Valor errado! (Max)</b><br><br><? } ?>

Ativo:<br>
<input type="radio" name="onoff" value="1"<? if($onoff==1) { echo " checked"; } ?>> Sim <input type="radio" name="onoff" value="0"<? if($onoff==0) { echo " checked"; } ?>> Não
<br><br>

Minimo:<br>
<input class="tabletext" type="text" name="min" value="<?=$min?>" style="width: 360px">
<br><br>

Maximo:<br>
<input class="tabletext" type="text" name="max" value="<?=$max?>" style="width: 360px">
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>