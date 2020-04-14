<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$username = $_POST["username"];
$message = addslashes($_POST["message"]);

$userid = GetRow("SELECT id FROM users WHERE username = '$username'");

SqlQuery("INSERT INTO messages (`userid`, `messagedate`, `message`, `read`) VALUES ('$userid', NOW(), '$message', '0')");

?>Mensagem enviada!