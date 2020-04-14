<?

include("include_settings.php");

$username = sql_injection_check($_POST["username"]);
$password = sql_injection_check($_POST["password"]);

if (!form_key_verify("ACCOUNT_LOGIN", sql_injection_check($_POST["code"]))) {
	setcookie("username1", $username, time()+86400);
	Header("Location: ".$links["ACCOUNT"]."?error=1");
}

if (GetRow("SELECT COUNT(id) FROM users WHERE username LIKE '$username' AND password = MD5('$password') AND `delete` = '0' AND `super` = '0'")==1) {

	SqlQuery("UPDATE users SET captcha = '0' WHERE username LIKE '$username'");

	$user_id = GetRow("SELECT id FROM users WHERE username LIKE '$username'");
	$user_ban = GetRow("SELECT ban FROM users WHERE username LIKE '$username'");
	$referer = $_SERVER["HTTP_REFERER"];

	$session = md5(uniqid(rand().generate_password(30)));
	
	while (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '$session'")!=0) {
		srand((double)microtime()*1000000);
		$session = md5(uniqid(rand()));
	}
	
	SqlQuery("INSERT INTO `sessions` (`sessionId`,`userId`,`sessionStart`,`lastACTIVE`,`userType`) VALUES ('$session', '$user_id', NOW(), NOW(),'1')");
	setcookie("session", $session, time()+86400);  /* expire in 24 hours */
	setcookie("username1", "", 1);
	
	if ($user_ban==1) {
		setcookie("session2", md5(generate_password(30)), time()+31536000);  /* expire in 1 year */
	}

	Header("Location: ".$links["ACCOUNT"]);

} else {

	if (GetRow("SELECT COUNT(id) FROM users WHERE username LIKE '$username' AND `delete` = '0'")!=0) {
		$captcha = GetRow("SELECT captcha FROM users WHERE username LIKE '$username'");
		$captcha++;
		SqlQuery("UPDATE users SET captcha = '$captcha' WHERE username LIKE '$username'");
	}
	
	if ($captcha>=5) {
		sleep(rand(1,10));
	}

	setcookie("username1", $username, time()+86400);
	Header("Location: ".$links["ACCOUNT"]."?error=1");
}


?>