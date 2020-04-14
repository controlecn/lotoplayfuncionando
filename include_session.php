<?

$banned = 0;

/*** Friends Cookie (OLD) ***/
if ($_GET["friendId"]) {

	if (!$_COOKIE["a"]) {

		$f = sql_injection_check($_GET["friendId"]);
		
		if (GetRow("SELECT COUNT(id) FROM users_friends WHERE id = '$f'")!=0) {
			setcookie("f", $f, time()+31536000);
		}
		
	}

}

/*** Friends Cookie ***/
if ($_GET["f"]) {

	if (!$_COOKIE["a"]) {

		$f = sql_injection_check($_GET["f"]);
		
		if (GetRow("SELECT COUNT(id) FROM users_friends WHERE id = '$f'")!=0) {
			setcookie("f", $f, time()+31536000);
		}
		
	}

}

/*** Affiliate Cookie ***/
if ($_GET["affliateId"]) {

	if (!$_COOKIE["f"]) {

		$a = sql_injection_check($_GET["affliateId"]);
		
		if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE id = '$a'")!=0) {
			setcookie("a", $a, time()+31536000);
		}
		
	}

}

/*** Affiliate Cookie ***/
if ($_GET["a"]) {

	if (!$_COOKIE["f"]) {

		$a = sql_injection_check($_GET["a"]);
		
		if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE id = '$a'")!=0) {
			setcookie("a", $a, time()+31536000);
		}
		
	}

}

if ($_COOKIE["session2"]) {
	$banned = 1;
} else {

	if (GetRow("SELECT COUNT(id) FROM fraud_banip WHERE ip = '".$_SERVER["REMOTE_ADDR"]."'")!=0) {
		$banned = 1;
	}

}



if (($_COOKIE["session"]) && (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '".$_COOKIE["session"]."' AND userType = '1' AND userId != '0'")!=0)) {
	$logged = 1;
	$logged_user = GetRow("SELECT userId FROM sessions WHERE sessionId = '".$_COOKIE["session"]."' AND userType = '1' AND userId != '0'");
} else {
	$logged = 0;
	$logged_user = 0;
}

if (($_COOKIE["affliate_session"]) && (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '".$_COOKIE["affliate_session"]."' AND userType = '2' AND userId != '0'")!=0)) {
	$affliate_logged = 1;
	$affliate_logged_user = GetRow("SELECT userId FROM sessions WHERE sessionId = '".$_COOKIE["affliate_session"]."' AND userType = '2' AND userId != '0'");
} else {
	$affliate_logged = 0;
	$affliate_logged_user = 0;
}

if ($logged==1) {
	$result = mysql_query("SELECT * FROM users WHERE id = '$logged_user'", $mysql_link);
	$user_data = mysql_fetch_array($result);
	mysql_free_result($result);
	SqlQuery("UPDATE users SET lastActive = NOW() WHERE id = '$logged_user'");
	
	if ($user_data["ban"]==1) {
		$banned = 1;
	}

	if (GetRow("SELECT COUNT(id) FROM fraud_banemail WHERE email = '".$user_data["email"]."'")!=0) {
		$banned = 1;
	}

}

if (($banned==1)&&(!$_COOKIE["session2"])) {
	setcookie("session2", md5(generate_password(30)), time()+31536000);
}

?>