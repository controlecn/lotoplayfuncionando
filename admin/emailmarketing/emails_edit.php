<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Email Marketing", "../");

$id = $_REQUEST["id"];

$sql = "SELECT * FROM newsletter_emails WHERE id = $id";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);
    
	$nome = $row["nome"];
	$email = $row["email"];

	mysql_free_result($result);

}

?>
<form name="updateForm" id="updateForm" method="POST" action="emails_edit_upd.php">
<font class="tabletop">

Nome:<br>
<input class="tabletext" type="text" name="nome" style="width: 360px" value="<?=$nome?>">
<br><br>

Conteúdo:<br>
<textarea name="email" cols="80" rows="12"><?=$email?></textarea>
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>