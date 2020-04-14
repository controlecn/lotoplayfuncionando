<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Notícias - Adicionar", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="news_add_upd.php">
<font class="tabletop">

Titulo:<br>
<input class="tabletext" type="text" name="headline" style="width: 360px">
<br><br>

Noticia:<br>
<textarea class="tabletext" style="height: 140px; width: 360px" name="story"></textarea>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>