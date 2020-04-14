<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Banners - Editar", "../");

$id = $_REQUEST["id"];

$sql = "Select * from affliates_banners where id = $id";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);
    
	$size = $row["size"];
	$name = $row["name"];
	$code = $row["code"];

	mysql_free_result($result);

}

?>
<form name="updateForm" id="updateForm" method="POST" action="banners_edit_upd.php">
<font class="tabletop">

<?=$lang_affliatebanners_edit_name?>:<br>
<input class="tabletext" type="text" name="name" value="<?=$name?>" style="width: 360px">
<br><br>

Tamanho:<br>
<select name="size">
	<option value="1"<? if($size==1) echo " selected"; ?>>Banners em flash: 468 x 60</option>
	<option value="2"<? if($size==2) echo " selected"; ?>>Banners em flash: 392 x 72</option>
	<option value="3"<? if($size==3) echo " selected"; ?>>Banners em flash: 120 x 240</option>
	<option value="4"<? if($size==4) echo " selected"; ?>>Banners em gif e jpeg: 120 x 90</option>
	<option value="5"<? if($size==5) echo " selected"; ?>>Banners em gif e jpeg: 88 x 31</option>
	<option value="6"<? if($size==6) echo " selected"; ?>>Banners em flash: 160 x 600</option>
</select>
<br><br>

<?=$lang_affliatebanners_edit_code?>:<br>
<textarea class="tabletext" style="height: 80px; width: 360px" name="code"><?=$code?></textarea>
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">
</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>