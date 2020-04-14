<?

include('../../include_functions.php');
include('../../include_guifunctions.php');
checkAccess(2);
gui_header("Editar Horarios dos VIP", "../../");

$hours = $_REQUEST["hours"];

$active = GetRow("SELECT active FROM cron_vip WHERE hours = $hours");
$players_min = GetRow("SELECT players_min FROM cron_vip WHERE hours = $hours");
$players_max = GetRow("SELECT players_max FROM cron_vip WHERE hours = $hours");
$cards_min = GetRow("SELECT cards_min FROM cron_vip WHERE hours = $hours");
$cards_max = GetRow("SELECT cards_max FROM cron_vip WHERE hours = $hours");
$prize_percents = GetRow("SELECT prize_percents FROM cron_vip WHERE hours = $hours");

$error = $_GET["error"];

?>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<? } ?>
<form name="updateForm" id="updateForm" method="POST" action="vip_hours_edit_update.php">

<h1>Horario: <?=$hours?>:00</h1>

<? if ($error==1) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_minplayers?>)</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_maxplayers?>)</b><br><br><? } ?>
<? if ($error==3) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_mincards?>)</b><br><br><? } ?>
<? if ($error==4) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_maxcards?>)</b><br><br><? } ?>
<? if ($error==5) { ?><b>Erro: Valor errado! (Premio)</b><br><br><? } ?>

<font class="tabletop">

Ativo:<br>
<input type="radio" name="active" value="1"<? if($active==1) { echo " checked"; } ?>> <?=$lang_bingovirtualplayers_onoff_yes?> <input type="radio" name="active" value="0"<? if($active==0) { echo " checked"; } ?>> <?=$lang_bingovirtualplayers_onoff_no?>
<br><br>

<?=$lang_bingovirtualplayers_minplayers?>:<br>
<input class="tabletext" type="text" name="players_min" value="<?=$players_min?>" style="width: 360px">
<br><br>

<?=$lang_bingovirtualplayers_maxplayers?>:<br>
<input class="tabletext" type="text" name="players_max" value="<?=$players_max?>" style="width: 360px">
<br><br>

<?=$lang_bingovirtualplayers_mincards?>:<br>
<input class="tabletext" type="text" name="cards_min" value="<?=$cards_min?>" style="width: 360px">
<br><br>

<?=$lang_bingovirtualplayers_maxcards?>:<br>
<input class="tabletext" type="text" name="cards_max" value="<?=$cards_max?>" style="width: 360px">
<br><br>

Premio:<br>
<input class="tabletext" type="text" name="prize_percents" value="<?=$prize_percents?>" style="width: 360px">
<br><br>

<input type="hidden" name="hours" value="<?=$hours?>">

<input type="submit" value="Editar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>