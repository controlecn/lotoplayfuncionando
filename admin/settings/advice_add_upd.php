<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$headline = $_POST["headline"];
$story = $_POST["story"];

SqlQuery("INSERT INTO advice (headline, story, newsdate) VALUES ('$headline', '$story', NOW())");

Header("Location: advice.php?update=yes");

?>