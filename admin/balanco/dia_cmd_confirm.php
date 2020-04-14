<?

include('../include_functions.php');
checkAccess(1);

$id = $_GET["id"];
$dia = $_GET["dia"];
$result = $_GET["result"];

SqlQuery("UPDATE balanco_vendas SET confirmed = '$result' WHERE id = '$id'");

if (GetRow("SELECT COUNT(id) FROM balanco_vendas WHERE confirmed = '0' AND dia = '$dia'")==0) {
	echo "ALLOK";
} else {
	echo "OK";
}




?>