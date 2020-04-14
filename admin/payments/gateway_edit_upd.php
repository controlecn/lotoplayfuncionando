<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$name = addslashes($_POST["name"]);
$name_short = addslashes($_POST["name_short"]);
$information = addslashes($_POST["information"]);
$onlinebankurl = addslashes($_POST["onlinebankurl"]);
$onlinebanktext = addslashes($_POST["onlinebanktext"]);
$disabled = addslashes($_POST["disabled"]);

$sql = "UPDATE buy_paymentforms SET name = '$name', name_short = '$name_short', information = '$information', onlinebankurl = '$onlinebankurl', onlinebanktext = '$onlinebanktext', disabled = '$disabled' WHERE id = $id";

SqlQuery($sql);

Header("Location: gateway.php?update=yes");

?>