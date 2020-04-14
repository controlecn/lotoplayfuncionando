<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Dicas - Editar", "../");

$id = $_GET["id"];

$sql = "SELECT * FROM advice WHERE id = '$id'";

$result = mysql_query($sql, $mysql_link);

if ($result) {
	$row = mysql_fetch_array($result);
	$headline = $row["headline"];
	$story = $row["story"];
	mysql_free_result($result);
}

?>
<form name="updateForm" id="updateForm" method="POST" action="advice_edit_upd.php">
<font class="tabletop">

Titulo:<br>
<input class="tabletext" type="text" name="headline" style="width: 360px" value="<?=$headline?>">
<br><br>

Dica:<br>
<textarea class="tabletext" style="height: 140px; width: 360px" name="story"><?=$story?></textarea>
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>