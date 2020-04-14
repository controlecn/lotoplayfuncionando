<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Testemunhas - Editar", "../");

$id = $_GET["id"];

$sql = "SELECT * FROM testimonials WHERE id = '$id'";

$result = mysql_query($sql, $mysql_link);

if ($result) {
	$row = mysql_fetch_array($result);
	$username = $row["username"];
	$testimonial = $row["testimonial"];
	mysql_free_result($result);
}

?>
<form name="updateForm" id="updateForm" method="POST" action="testimonials_edit_upd.php">
<font class="tabletop">

Usuário:<br>
<input class="tabletext" type="text" name="username" style="width: 360px" value="<?=$username?>">
<br><br>

Testemunha:<br>
<textarea class="tabletext" style="height: 140px; width: 360px" name="testimonial"><?=$testimonial?></textarea>
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>