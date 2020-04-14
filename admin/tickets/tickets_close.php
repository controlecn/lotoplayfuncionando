<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$id = $_GET["id"];

SqlQuery("UPDATE tickets SET status = 2 WHERE id = $id");

Header("Location: tickets_abertos.php");


?>