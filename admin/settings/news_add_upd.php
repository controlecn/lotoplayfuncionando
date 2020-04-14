<?

include('../include_functions.php');
checkAccess(2);

error_reporting(0);

$headline = $_POST["headline"];
$story = $_POST["story"];

SqlQuery("INSERT INTO news (headline, story, newsdate) VALUES ('$headline', '$story', NOW())");

Header("Location: news.php?update=yes");

?>