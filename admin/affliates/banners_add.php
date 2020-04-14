<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Banners - Adicionar", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="banners_add_upd.php">
<font class="tabletop">

<?=$lang_affliatebanners_add_name?>:<br>
<input class="tabletext" type="text" name="name" style="width: 360px">
<br><br>

Tamanho:<br>
<select name="size">
	<option value="1">Banners em flash: 468 x 60</option>
	<option value="2">Banners em flash: 392 x 72</option>
	<option value="3">Banners em flash: 120 x 240</option>
	<option value="4">Banners em gif e jpeg: 120 x 90</option>
	<option value="5">Banners em gif e jpeg: 88 x 31</option>
	<option value="6">Banners em flash: 160 x 600</option>
</select>
<br><br>

<?=$lang_affliatebanners_add_code?>:<br>
<textarea class="tabletext" style="height: 80px; width: 360px" name="code"></textarea>
<br><br>

<input type="submit" name="submitbutton" value="Adicionar">
</font>
</form>
<? gui_bottom(); ?>