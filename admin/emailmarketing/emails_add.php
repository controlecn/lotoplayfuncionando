<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Email Marketing", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="emails_add_upd.php">
<font class="tabletop">

Nome:<br>
<input class="tabletext" type="text" name="nome" style="width: 360px">
<br><br>

Conteúdo:<br>
<textarea name="email" cols="80" rows="12"></textarea>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>