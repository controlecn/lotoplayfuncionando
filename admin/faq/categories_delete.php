<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

$sql = "Delete from faq_categories Where id = $id";

SqlQuery($sql);

Header("Location: categories.php?update=yes");

?>