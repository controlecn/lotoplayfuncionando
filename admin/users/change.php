<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Alterar Cadastro", "../");

$id = $_GET["id"];
$error = $_GET["error"];

$fullname = GetRow("SELECT fullname FROM users WHERE id = '$id'");
$username = GetRow("SELECT username FROM users WHERE id = '$id'");
$email = GetRow("SELECT email FROM users WHERE id = '$id'");

?>

<? if ($_REQUEST["update"]=="yes") { ?>
<font class="smalltext"><b><?=$lang_global_changed?></b></font><br><br>
<? } ?>

<form name="updateForm" id="updateForm" method="POST" action="change_update.php">

<? if ($error==1) { ?><b>Erro: Apelido ja existe</b><br><br><? } ?>
<? if ($error==2) { ?><b>Erro: Email ja existe</b><br><br><? } ?>

<font class="tabletop">

Nome:<br>
<input class="tabletext" type="text" name="fullname" value="<?=$fullname?>" style="width: 250px">
<br><br>

Apelido:<br>
<input class="tabletext" type="text" name="username" value="<?=$username?>" style="width: 150px">
<br><br>

E-mail:<br>
<input class="tabletext" type="text" name="email" value="<?=$email?>" style="width: 250px">
<br><br>

<input type="hidden" value="<?=$id?>" name="id">

<input type="submit" value="Atualizar!" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>