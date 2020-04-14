<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$name = addslashes($_POST["name"]);
$price = addslashes($_POST["price"]);
$image = addslashes($_POST["image"]);

SqlQuery("UPDATE points_products SET name = '$name', price = '$price', image = '$image' WHERE id = '$id'");

Header("Location: points.php?update=yes");

?>