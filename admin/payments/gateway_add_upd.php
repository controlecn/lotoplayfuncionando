<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$name = $_POST["name"];
$name_short = $_POST["name_short"];
$information = $_POST["information"];
$onlinebankurl = $_POST["onlinebankurl"];
$onlinebanktext = $_POST["onlinebanktext"];
$disabled = $_POST["disabled"];

SqlQuery("Insert into buy_paymentforms (name,name_short,information,onlinebankurl,onlinebanktext,disabled) Values ('$name','$name_short','$information','$onlinebankurl','$onlinebanktext','$disabled')");

Header("Location: gateway.php?update=yes");

?>