<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$id = $_POST["id"];
$name = addslashes($_POST["name"]);
$description = addslashes($_POST["description"]);

$sql = "Update faq_categories Set name = '$name', description = '$description' Where id = $id";

SqlQuery($sql);

Header("Location: categories.php?update=yes");

?>