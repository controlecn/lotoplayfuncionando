<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Testemunhas - Adicionar", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="testimonials_add_upd.php">
<font class="tabletop">

Usuário:<br>
<input class="tabletext" type="text" name="username" style="width: 360px">
<br><br>

Testemunha:<br>
<textarea class="tabletext" style="height: 140px; width: 360px" name="testimonial"></textarea>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>