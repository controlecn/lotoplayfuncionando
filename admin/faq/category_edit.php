<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Editar perqunta", "../");

$categoryId = $_REQUEST["categoryId"];

$id = $_REQUEST["id"];

$sql = "Select * from faq_questions where id = $id";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);

	$question = $row["question"];
	$answer = $row["answer"];

	mysql_free_result($result);

}

?>
<form name="updateForm" id="updateForm" method="POST" action="category_edit_upd.php?categoryId=<?=$categoryId?>">
<font class="tabletop">

<?=$lang_help_category_view_table_question?>:<br>
<input class="tabletext" type="text" name="question" value="<?=$question?>" style="width: 360px">
<br><br>

<?=$lang_help_category_view_table_answer?>:<br>
<textarea class="tabletext" style="height: 80px; width: 360px" name="answer"><?=$answer?></textarea>
<br><br>

<input type="submit" value="Editar" name="submitbutton">
</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>