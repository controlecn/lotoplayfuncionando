<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

$sql = "Delete from fraud_banemail Where id = $id";

SqlQuery($sql);

Header("Location: ban_email.php?update=yes");

?>