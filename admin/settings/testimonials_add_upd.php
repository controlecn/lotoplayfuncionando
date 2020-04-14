<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$username = $_POST["username"];
$testimonial = $_POST["testimonial"];

SqlQuery("INSERT INTO testimonials (username, testimonial) VALUES ('$username', '$testimonial')");

Header("Location: testimonials.php?update=yes");

?>