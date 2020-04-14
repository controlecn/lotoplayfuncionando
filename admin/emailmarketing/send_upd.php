<?

include('../include_functions.php');
checkAccess(1);
include('functions_imap.php');

$subject = $_POST["subject"];
$message = $_POST["message"];

$result = mysql_query("SELECT fullname,email FROM users WHERE `ban` = '0' AND `delete` = '0' AND super = 0", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$fullname = $row["fullname"];
		$email = $row["email"];

		sendTicketEmail(1, $email, $subject, str_replace("%%NAME%%", $fullname, $message));
		
	}

mysql_free_result($result);

}

echo "Emails enviados com successo!"

?>