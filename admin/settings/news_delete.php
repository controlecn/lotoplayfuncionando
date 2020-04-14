<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM news WHERE id = '$id'");

Header("Location: news.php?update=yes");

?>