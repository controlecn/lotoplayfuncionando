<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Editar Categoria", "../");

$id = $_REQUEST["id"];

$sql = "Select * from faq_categories where id = $id";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);

	$name = $row["name"];
	$description = $row["description"];

	mysql_free_result($result);

}

?>
<form name="updateForm" id="updateForm" method="POST" action="categories_edit_upd.php">

<font class="tabletop">

<?=$lang_help_categories_view_table_name?>:<br>
<input class="tabletext" type="text" name="name" value="<?=$name?>" style="width: 360px">
<br><br>

<?=$lang_help_categories_view_table_description?>:<br>
<textarea class="tabletext" style="height: 80px; width: 360px" name="description"><?=$description?></textarea>
<br><br>

<input type="submit" value="Editar" name="submitbutton">
</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>