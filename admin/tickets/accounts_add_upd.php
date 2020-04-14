<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$server = $_POST["server"];
$port = $_POST["port"];
$username = $_POST["username"];
$password = $_POST["password"];
$from_email = $_POST["from_email"];
$from_name = $_POST["from_name"];

SqlQuery("INSERT INTO tickets_accounts (server,port,username,password,from_email,from_name) VALUE ('$server', '$port', '$username', '$password', '$from_email', '$from_name')");

Header("Location: accounts_overview.php?update=yes");

?>