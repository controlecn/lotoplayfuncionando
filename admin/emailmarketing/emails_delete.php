<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM newsletter_emails WHERE id = $id");

Header("Location: emails_overview.php?update=yes");

?>