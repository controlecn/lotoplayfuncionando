<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM points_products WHERE id = '$id'");

Header("Location: points.php?update=yes");

?>