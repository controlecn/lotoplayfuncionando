<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Produtos - Adicionar", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="points_add_upd.php">
<font class="tabletop">

Nome:<br>
<input class="tabletext" type="text" name="name" style="width: 360px">
<br><br>

Preço:<br>
<input class="tabletext" type="text" name="price" style="width: 360px">
<br><br>

Foto:<br>
<input class="tabletext" type="text" name="image" style="width: 360px">
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>