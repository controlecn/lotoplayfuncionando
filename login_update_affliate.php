<?

include("include_settings.php");

$username = sql_injection_check($_POST["username"]);
$password = sql_injection_check($_POST["password"]);

if (!form_key_verify("AFFLIATE_LOGIN", sql_injection_check($_POST["code"]))) {
	setcookie("username2", $username, time()+86400);
	Header("Location: ".$links["AFFILIATES_LOGIN"].$qr."?error=1");
}

if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE login LIKE '$username' AND password = MD5('$password')")==1) {

	$user_id = GetRow("SELECT id FROM users_affliates WHERE login LIKE '$username'");

	$session = md5(uniqid(rand()));
	
	while (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '$session'")!=0) {
		srand((double)microtime()*1000000);
		$session = md5(uniqid(rand()));
	}
	
	SqlQuery("INSERT INTO `sessions` (`sessionId`,`userId`,`sessionStart`,`lastACTIVE`,`userType`) VALUES ('$session', '$user_id', NOW(), NOW(),'2')");
	setcookie("affliate_session", $session, time()+(24*3600));  /* expire in 24 hours */
	setcookie("username2", "", 1);
	
	Header("Location: ".$links["AFFILIATES"]);

} else {

	Header("Location: ".$links["AFFILIATES_LOGIN"].$qr."error=1");

}


?>