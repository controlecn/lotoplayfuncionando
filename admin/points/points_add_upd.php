<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$name = $_POST["name"];
$price = $_POST["price"];
$image = $_POST["image"];

SqlQuery("INSERT INTO points_products (name,price,image) VALUES ('$name', '$price', '$image')");

Header("Location: points.php?update=yes");

?>