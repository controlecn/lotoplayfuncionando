<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Configuração de Amigos", "../");

$friend1 = getSetupVar("friend_friend1");
$friend2 = getSetupVar("friend_friend2");
$friend3 = getSetupVar("friend_friend3");

$error = $_GET["error"];

?>
<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font>
<? } ?>
<form name="updateForm" id="updateForm" method="POST" action="options_update.php">
<font class="tabletop">

<? if ($error==1) { ?><b>Erro: Valor errado! (<?=$lang_friendsoptions_friends1?>)</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Valor errado! (<?=$lang_friendsoptions_friends2?>)</b><br><br><? } ?>
<? if ($error==3) { ?><b>Erro: Valor errado! (<?=$lang_friendsoptions_friends3?>)</b><br><br><? } ?>

<?=$lang_friendsoptions_friends1?>:<br>
<input class="tabletext" type="text" name="friend1" value="<?=$friend1?>" style="width: 360px">
<br><br>

<?=$lang_friendsoptions_friends2?>:<br>
<input class="tabletext" type="text" name="friend2" value="<?=$friend2?>" style="width: 360px">
<br><br>

<?=$lang_friendsoptions_friends3?>:<br>
<input class="tabletext" type="text" name="friend3" value="<?=$friend3?>" style="width: 360px">
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>