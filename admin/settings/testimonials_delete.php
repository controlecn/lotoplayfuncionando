<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_REQUEST["id"];

SqlQuery("DELETE FROM testimonials WHERE id = '$id'");

Header("Location: testimonials.php?update=yes");

?>