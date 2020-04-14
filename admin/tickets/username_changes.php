<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$email_content = "Olá %%NAME%%,<br><br>Estamos informado que mudamos regras sobre apelidos. A partir de agora serão apenas liberados caractericos sem acentos, e não liberamos espaços no apelido.<br><br>Seu novo apelido: %%USERNAME%%";

function changeUsername($username) {

	$username = str_replace("´", "", $username);
	$username = str_replace("[", "", $username);
	$username = str_replace("#", "", $username);
	$username = str_replace("(", "", $username);
	$username = str_replace(")", "", $username);
	$username = str_replace("Ã", "A", $username);
	$username = str_replace("ã", "a", $username);
	$username = str_replace(" ", "", $username);
	$username = str_replace("á", "a", $username);
	$username = str_replace("ç", "c", $username);
	$username = str_replace("â", "a", $username);
	$username = str_replace("é", "e", $username);
	$username = str_replace("ê", "e", $username);
	$username = str_replace("Ô", "O", $username);
	$username = str_replace("õ", "o", $username);
	$username = str_replace("Í", "I", $username);
	$username = str_replace(",", "", $username);
	$username = str_replace("!", "", $username);
	$username = str_replace("?", "", $username);

	return $username;

}

$sql = "SELECT id,username,email,fullname FROM users WHERE `ban` = '0' AND `delete` = '0'";

$result = mysql_query($sql, $mysql_link);

$i = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		$id = $row["id"];
		$username = $row["username"];
		$fullname = $row["fullname"];
		$email = $row["email"];
		
		if (eregi('[^A-Za-z0-9_&@.$*\-]', $username)) {
		
			$changed = 0;
		
			// Change username
			$username_new = changeUsername($username);
			
			// Check if the new username exists
			if (GetRow("SELECT COUNT(id) FROM users WHERE username LIKE '$username_new'")!=0) {
			
				// Print out and quit if the username exists
				$username_new = $username_new."1";
				
				if (GetRow("SELECT COUNT(id) FROM users WHERE username LIKE '$username_new'")==0) {
					$changed = 1;
				}
				
			} else{
			
				$changed = 1;
			}
			
			// If the new username doesnt exists, lets change it
			if ($changed==1) {
				SqlQuery("UPDATE users SET username = '$username_new' WHERE id = '$id'");
				
				// Send the email
				
				$this_email = str_replace("%%NAME%%", $fullname, $email_content);
				$this_email = str_replace("%%USERNAME%%", $username_new, $this_email);
				
				sendTicketEmail(1, $email, "Lotoplay informativo", $this_email);
				
				echo "CHANGED: $username - $username_new<br>";
				
			} else {
				echo "NOT CHANGED: $username - $username_new<br>";
			}

		
			
		}


	}

mysql_free_result($result);

}



?>