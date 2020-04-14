<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$id = $_REQUEST["id"];
$categoryId = $_REQUEST["categoryId"];

$sql = "Delete from faq_questions Where id = $id";

SqlQuery($sql);

Header("Location: category.php?categoryId=$categoryId&update=yes");

?>