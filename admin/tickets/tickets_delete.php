<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$id = $_GET["id"];

SqlQuery("DELETE FROM tickets WHERE id = $id");

$result = mysql_query("SELECT * FROM tickets_contents WHERE ticket_id = $id", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$content_id = $row["id"];
		
		SqlQuery("DELETE FROM tickets_attachments WHERE id = $content_id");

		
	}
	
	mysql_free_result($result);
	
}


SqlQuery("DELETE FROM tickets_contents WHERE id = $id");

Header("Location: tickets_abertos.php");


?>