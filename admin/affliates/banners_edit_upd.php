<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$id = $_POST["id"];
$size = $_POST["size"];
$name = $_POST["name"];
$code = $_POST["code"];

$sql = "Update affliates_banners Set size = '$size', name = '$name', code = '$code' Where id = $id";

SqlQuery($sql);

Header("Location: banners.php");

?>