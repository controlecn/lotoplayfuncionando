<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);

$code = $_POST["code"];
$subject = addslashes($_POST["subject"]);
$content = addslashes($_POST["email_content"]);

SqlQuery("UPDATE emails SET subject = '$subject', content = '$content' WHERE code = '$code'");

Header('Location: email_overview.php');

?>