<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Editar Texto", "../");

$nome = $_GET["nome"];

$file = file("../../templates/pt_br/strings.php");

for ($b=0; $b<count($file); $b++) {

	$line = $file[$b];

	if (substr_count($line, "lang[\"$nome\"]")!=0) {
		$texto = $line;
		break;
	}

}

$texto = str_replace("\";", "", $texto);
$texto = str_replace("\$lang[\"$nome\"] = \"", "", $texto);
$texto = trim($texto);

?>
<form name="updateForm" id="updateForm" method="POST" action="strings_edit_upd.php">
<font class="tabletop">

Texto:<br>
<input type="text" name="texto" size="60" value="<?=$texto?>">
<br><br>

<input type="submit" value="Atualizar" name="submitbutton">

<input type="hidden" value="<?=$nome?>" name="nome">

</font>
</form>
<? gui_bottom(); ?>