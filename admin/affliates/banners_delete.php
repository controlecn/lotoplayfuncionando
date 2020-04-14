<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$id = $_REQUEST["id"];

$sql = "Delete from affliates_banners Where id = $id";

SqlQuery($sql);

Header("Location: banners.php");

?>