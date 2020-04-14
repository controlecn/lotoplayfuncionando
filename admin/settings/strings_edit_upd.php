<?

include('../include_functions.php');
checkAccess(2);

$nome = $_POST["nome"];
$texto = $_POST["texto"];
$texto = trim($texto);

$file = file("../../templates/pt_br/strings.php");

$line_nr = 0;

for ($b=0; $b<count($file); $b++) {

	$line = $file[$b];

	if (substr_count($line, "lang[\"$nome\"]")!=0) {
		$line_nr = $b;
		break;
	}

}

if ($line_nr!=0) {
	$file[$line_nr] = "\$lang[\"$nome\"] = \"$texto\";\n";
}

$file = implode("", $file);

$handle = fopen("../../templates/pt_br/strings.php", "w");
fwrite($handle, $file);
fclose($handle);

Header("Location: strings.php");

?>