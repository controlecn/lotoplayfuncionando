<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Adicionar Categoria", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="categories_add_upd.php">
<font class="tabletop">

<?=$lang_help_categories_view_table_name?>:<br>
<input class="tabletext" type="text" name="name" style="width: 360px">
<br><br>

<?=$lang_help_categories_view_table_description?>:<br>
<textarea class="tabletext" style="height: 80px; width: 360px" name="description"></textarea>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">
</font>
</form>
<? gui_bottom(); ?>