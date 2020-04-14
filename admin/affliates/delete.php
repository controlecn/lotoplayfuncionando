<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$id = $_REQUEST["id"];

$sql = "Delete from users_affliates Where id = $id";

SqlQuery($sql);

Header("Location: overview.php?update=yes");

?>