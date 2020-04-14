<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$name = $_POST["name"];
$size = $_POST["size"];
$code = $_POST["code"];

$sql = "INSERT INTO affliates_banners (size, name,code) VALUES ('$size', '$name', '$code')";

SqlQuery($sql);

Header("Location: banners.php");

?>