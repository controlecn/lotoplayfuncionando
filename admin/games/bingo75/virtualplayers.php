<?

include('../../include_functions.php');
include('../../include_guifunctions.php');
checkAccess(2);
gui_header("Jogadores VIP", "../../");
    
$onoff = getSetupVar("bingo75_vip_onoff");
$minplayers = getSetupVar("bingo75_vip_players_min");
$maxplayers = getSetupVar("bingo75_vip_players_max");
$mincards = getSetupVar("bingo75_vip_cards_min");
$maxcards = getSetupVar("bingo75_vip_cards_max");

$error = $_GET["error"];

?>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<? } ?>
<form name="updateForm" id="updateForm" method="POST" action="virtualplayers_update.php">

<font class="tabletop">

<? if ($error==1) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_minplayers?>)</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_maxplayers?>)</b><br><br><? } ?>
<? if ($error==3) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_mincards?>)</b><br><br><? } ?>
<? if ($error==4) { ?><b>Erro: Valor errado! (<?=$lang_bingovirtualplayers_maxcards?>)</b><br><br><? } ?>

<?=$lang_bingovirtualplayers_onoff?>:<br>
<input type="radio" name="onoff" value="1"<? if($onoff==1) { echo " checked"; } ?>> <?=$lang_bingovirtualplayers_onoff_yes?> <input type="radio" name="onoff" value="0"<? if($onoff==0) { echo " checked"; } ?>> <?=$lang_bingovirtualplayers_onoff_no?>
<br><br>

<?=$lang_bingovirtualplayers_minplayers?>:<br>
<input class="tabletext" type="text" name="minplayers" value="<?=$minplayers?>" style="width: 360px">
<br><br>

<?=$lang_bingovirtualplayers_maxplayers?>:<br>
<input class="tabletext" type="text" name="maxplayers" value="<?=$maxplayers?>" style="width: 360px">
<br><br>

<?=$lang_bingovirtualplayers_mincards?>:<br>
<input class="tabletext" type="text" name="mincards" value="<?=$mincards?>" style="width: 360px">
<br><br>

<?=$lang_bingovirtualplayers_maxcards?>:<br>
<input class="tabletext" type="text" name="maxcards" value="<?=$maxcards?>" style="width: 360px">
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>