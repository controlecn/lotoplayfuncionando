<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM advice WHERE id = '$id'");

Header("Location: advice.php?update=yes");

?>