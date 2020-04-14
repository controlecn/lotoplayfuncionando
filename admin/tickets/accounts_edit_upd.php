<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$server = $_POST["server"];
$port = $_POST["port"];
$username = $_POST["username"];
$password = $_POST["password"];
$from_email = $_POST["from_email"];
$from_name = $_POST["from_name"];

SqlQuery("UPDATE tickets_accounts SET server = '$server', port = '$port', username = '$username', password = '$password', from_email = '$from_email', from_name = '$from_name' WHERE id = $id");

Header("Location: accounts_overview.php?update=yes");

?>