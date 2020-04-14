<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM tickets_accounts WHERE id = $id");

Header("Location: accounts_overview.php?update=yes");

?>