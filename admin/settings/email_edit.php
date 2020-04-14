<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Editar email", "../");

$code = $_GET["code"];

$subject = GetRow("SELECT subject FROM emails WHERE code = '$code'");
$content = GetRow("SELECT content FROM emails WHERE code = '$code'");


?>
<form action="email_edit_upd.php" method="post">
<font class="tabletop">

<?=$lang_emailoverview_subject?>:<br>
<input class="tabletext" type="text" name="subject" value="<?=$subject?>" style="width: 360px">
<br><br>

</font>
<textarea name="email_content" style="width: 90%; height: 400px"><?=$content?></textarea>
<input type="hidden" name="code" value="<?=$code?>"><br><br>
<input type="submit" value="Editar" name="submitbutton">
</form>
<? gui_bottom(); ?>