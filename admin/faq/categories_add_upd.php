<?

include('../include_functions.php');
checkAccess(2);
error_reporting(0);

$name = addslashes($_POST["name"]);
$description = addslashes($_POST["description"]);

$sql = "Insert into faq_categories (name,description) Values ('$name', '$description')";

SqlQuery($sql);

Header("Location: categories.php?update=yes");

?>