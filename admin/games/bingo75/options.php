<?

include('../../include_functions.php');
include('../../include_guifunctions.php');

checkAccess(2);

gui_header("Configuração de Bingo Tradicional", "../../");

$cardprice1 = getSetupVar("bingo75_norm_cardprice");
$cardprice2 = getSetupVar("bingo75_mega_cardprice");
$megaNumbers = getSetupVar("bingo75_meganumbers");
$prize_percents = getSetupVar("bingo75_prize_percents");
$jackpot_percents = getSetupVar("bingo75_jackpot_percents");
$jackpot = GetRow("SELECT jackpot FROM games WHERE game = 'bingo75'");

$error = $_GET["error"];

?>

<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<? } ?>
<form name="updateForm" id="updateForm" method="POST" action="options_update.php">
<font class="tabletop">

<? if ($error==1) { ?><b>Erro: Valor errado! (<?=$lang_bingooptions_jackpot?>)</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Valor errado! (<?=$lang_bingooptions_megaballs?>)</b><br><br><? } ?>
<? if ($error==3) { ?><b>Erro: Valor errado! (<?=$lang_bingooptions_cardpricenormal?>)</b><br><br><? } ?>
<? if ($error==4) { ?><b>Erro: Valor errado! (<?=$lang_bingooptions_cardpricemega?>)</b><br><br><? } ?>
<? if ($error==5) { ?><b>Erro: Valor errado! (<?=$lang_bingooptions_percentsprize?>)</b><br><br><? } ?>
<? if ($error==6) { ?><b>Erro: Valor errado! (<?=$lang_bingooptions_percentsmegaprize?>)</b><br><br><? } ?>

<?=$lang_bingooptions_jackpot?>:<br>
<input class="tabletext" type="text" name="jackpot" value="<?=$jackpot?>" style="width: 360px">
<br><br>

<?=$lang_bingooptions_megaballs?>:<br>
<input class="tabletext" type="text" name="megaNumbers" value="<?=$megaNumbers?>" style="width: 360px">
<br><br>

<?=$lang_bingooptions_cardpricenormal?>:<br>
<input class="tabletext" type="text" name="cardprice1" value="<?=$cardprice1?>" style="width: 360px">
<br><br>

<?=$lang_bingooptions_cardpricemega?>:<br>
<input class="tabletext" type="text" name="cardprice2" value="<?=$cardprice2?>" style="width: 360px">
<br><br>

<?=$lang_bingooptions_percentsprize?>:<br>
<input class="tabletext" type="text" name="prize_percents" value="<?=$prize_percents?>" style="width: 360px">%
<br><br>

<?=$lang_bingooptions_percentsmegaprize?>:<br>
<input class="tabletext" type="text" name="jackpot_percents" value="<?=$jackpot_percents?>" style="width: 360px">%
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>