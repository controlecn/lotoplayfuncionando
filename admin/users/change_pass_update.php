<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$pass1 = $_POST["pass1"];

SqlQuery("UPDATE users SET password = MD5('$pass1') WHERE id = '$id'");

?>Mudanca com successo!