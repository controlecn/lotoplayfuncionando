<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Adicionar perqunta", "../");

$categoryId = $_REQUEST["categoryId"];

?>
<form name="updateForm" id="updateForm" method="POST" action="category_add_upd.php">
<font class="tabletop">

<?=$lang_help_category_view_table_question?>:<br>
<input class="tabletext" type="text" name="question" style="width: 360px">
<br><br>

<?=$lang_help_category_view_table_answer?>:<br>
<textarea class="tabletext" style="height: 80px; width: 360px" name="answer"></textarea>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">
</font>
<input type="hidden" name="categoryId" value="<?=$categoryId?>">
</form>
<? gui_bottom(); ?>