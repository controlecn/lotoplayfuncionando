<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Editar Conteudo", "../");

$code = $_REQUEST["code"];

$content = GetRow("SELECT content FROM content WHERE code = '$code'");

?>
<form action="content_edit_upd.php" method="post">
<textarea name="content" style="width: 90%; height: 600px"><?=$content?></textarea>
<input type="hidden" name="code" value="<?=$code?>"><br><br>
<input type="submit" value="Editar" name="submitbutton">
</form>
<? gui_bottom(); ?>