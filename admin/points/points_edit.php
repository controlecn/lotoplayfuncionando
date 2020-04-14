<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Produtos - Editar", "../");

$id = $_GET["id"];

$sql = "SELECT * FROM points_products WHERE id = '$id'";

$result = mysql_query($sql, $mysql_link);

if ($result) {
	$row = mysql_fetch_array($result);
	$name = $row["name"];
	$price = $row["price"];
	$image = $row["image"];
	mysql_free_result($result);
}

?>
<form name="updateForm" id="updateForm" method="POST" action="points_edit_upd.php">
<font class="tabletop">

Nome:<br>
<input class="tabletext" type="text" name="headline" style="width: 360px" value="<?=$name?>">
<br><br>

Preço:<br>
<input class="tabletext" type="text" name="price" style="width: 360px" value="<?=$name?>">
<br><br>

Foto:<br>
<input class="tabletext" type="text" name="image" style="width: 360px" value="<?=$name?>">
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>