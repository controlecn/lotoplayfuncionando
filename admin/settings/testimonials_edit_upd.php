<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$username = addslashes($_POST["username"]);
$testimonial = addslashes($_POST["testimonial"]);

SqlQuery("UPDATE testimonials SET username = '$username', testimonial = '$testimonial' WHERE id = '$id'");

Header("Location: testimonials.php?update=yes");

?>