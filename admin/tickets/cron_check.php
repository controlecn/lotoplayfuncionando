<?php

set_time_limit(0);
error_reporting(E_ALL);

include('../include_functions.php');
include('functions_imap.php');

$result = mysql_query("SELECT id FROM tickets_accounts ORDER BY id DESC", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {
		$id = $row["id"];
		getEmails($id);
	}

mysql_free_result($result);

}

?>