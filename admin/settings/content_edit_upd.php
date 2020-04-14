<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);

$code = $_POST["code"];
$content = stripslashes($_POST["content"]);
$content = addslashes($content);

SqlQuery("UPDATE content SET content = '$content' WHERE code = '$code'");

Header('Location: content_overview.php');

?>