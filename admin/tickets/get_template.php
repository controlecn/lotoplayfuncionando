<?

include('../include_functions.php');
echo GetRow("SELECT email FROM tickets_emails WHERE id = ".$_GET["id"]);

?>