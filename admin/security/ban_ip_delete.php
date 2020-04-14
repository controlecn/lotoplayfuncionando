<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

$sql = "Delete from fraud_banip Where id = $id";

SqlQuery($sql);

Header("Location: ban_ip.php?update=yes");

?>