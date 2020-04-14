<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM tickets_emails WHERE id = $id");

Header("Location: respostas_overview.php?update=yes");

?>