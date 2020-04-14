<?

require_once("include_functions.php");

$q = strtolower($_REQUEST["q"]);

if (!$q) return;

$sql = "SELECT username FROM users WHERE username LIKE '%$q%' ORDER BY username";

$result = mysql_query($sql, $mysql_link);

if (($result) && (@mysql_num_rows($result) != 0)) {
	
	while ($row = mysql_fetch_array($result)) {
		
		$username = $row["username"];
			
		echo "$username\n";
		
	}
	
}

?>