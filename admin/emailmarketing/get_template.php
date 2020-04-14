<?

include('../include_functions.php');
echo GetRow("SELECT email FROM newsletter_emails WHERE id = ".$_GET["id"]);

?>