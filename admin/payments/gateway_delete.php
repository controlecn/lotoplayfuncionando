<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

SqlQuery("DELETE FROM buy_paymentforms WHERE id = '".$_GET["id"]."'");

Header("Location: gateway.php?update=yes");

?>