<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$id = $_POST["id"];
$headline = addslashes($_POST["headline"]);
$story = addslashes($_POST["story"]);

SqlQuery("UPDATE advice SET headline = '$headline', story = '$story', newsdate = NOW() WHERE id = '$id'");

Header("Location: advice.php?update=yes");

?>