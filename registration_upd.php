<?

include("include_settings.php");

if (!form_key_verify("REGISTRATION", sql_injection_check($_POST["code"]))) {
	Header("Location: registration.php");
}

$name = sql_injection_check($_POST["name"]);
$username = sql_injection_check($_POST["username"]);
$password1 = sql_injection_check($_POST["password1"]);
$password2 = sql_injection_check($_POST["password2"]);
$email = sql_injection_check($_POST["email"]);
$day = sql_injection_check($_POST["day"]);
$month = sql_injection_check($_POST["month"]);
$year = sql_injection_check($_POST["year"]);
$sex = sql_injection_check($_POST["sex"]);
$marketing = sql_injection_check($_POST["marketing"]);
$newsletter = sql_injection_check($_POST["newsletter"]);
$years18 = sql_injection_check($_POST["years18"]);
$rules = sql_injection_check($_POST["rules"]);
$submitbutton = sql_injection_check($_POST["submitbutton"]);

/*** Verification ***/

$has_errors = 0;
$errors = array();

	/*** Name ***/
if (strlen($name)<3) {
	$has_errors = 1;
	array_push($errors, "name_short");
}

if (strlen($name)>150) {
	$has_errors = 1;
	array_push($errors, "name_long");
}

	/*** Username ***/
if (strlen($username)==0) {
	$has_errors = 1;
	array_push($errors, "username_short");
}

if (strlen($username)>150) {
	$has_errors = 1;
	array_push($errors, "username_long");
}

if (GetRow("SELECT COUNT(id) FROM users WHERE username LIKE '$username'")!=0) {
	$has_errors = 1;
	array_push($errors, "username_exists");
}

if (eregi('[^A-Za-z0-9_&@.$*\-]', $username)) {
    $has_errors = 1;
	array_push($errors, "username_invalid");
}

	/*** Password ***/
if (strlen($password1)<5) {
	$has_errors = 1;
	array_push($errors, "password_short");
}

if (strlen($password1)>150) {
	$has_errors = 1;
	array_push($errors, "password_long");
}

if ($password1!=$password2) {
	$has_errors = 1;
	array_push($errors, "password_nomatch");
}

	/*** Email ***/
if (strlen($email)<3) {
	$has_errors = 1;
	array_push($errors, "email_short");
}

if (strlen($email)>150) {
	$has_errors = 1;
	array_push($errors, "email_long");
}

if (verify_email($email)!=1) {
	$has_errors = 1;
	array_push($errors, "email_notvalid");
}


if (GetRow("SELECT COUNT(id) FROM users WHERE email = '$email'")!=0) {
	$has_errors = 1;
	array_push($errors, "email_exists");
}

	/*** Day ***/
if (($day<1)||($day>31)) {
	$has_errors = 1;
	array_push($errors, "day_notvalid");
}
	
	/*** Month ***/
if (($month<1)||($month>12)) {
	$has_errors = 1;
	array_push($errors, "month_notvalid");
}

	/*** Year ***/
if (($year<1900)||($year>=date("Y"))) {
	$has_errors = 1;
	array_push($errors, "year_notvalid");
}

	/*** Birthdate ***/
if (!checkdate($month, $day, $year)) {
	array_push($errors, "date_notvalid");
}
	
	/*** Sex ***/
if (($sex!=1)&&($sex!=2)) {
	$has_errors = 1;
	array_push($errors, "sex");
}
	
	/*** 18 Years ***/
if ($years18!=1) {
	$has_errors = 1;
	array_push($errors, "18years");
} else {

	if (birthday($year, $month, $day)<18) {
		$has_errors = 1;
		array_push($errors, "18years");
	}

}

	/*** Rules ***/
if ($rules!=1) {
	$has_errors = 1;
	array_push($errors, "rules");
}
	
if ($has_errors==1) {

	$errors = implode($errors, ",");

	$cookie_expire = time()+(24*3600);
	setcookie("register_name", $name, $cookie_expire);
	setcookie("register_url", $url, $cookie_expire);
	setcookie("register_telephone", $telephone, $cookie_expire);
	setcookie("register_username", $username, $cookie_expire);
	setcookie("register_email", $email, $cookie_expire);
	setcookie("register_day", $day, $cookie_expire);
	setcookie("register_month", $month, $cookie_expire);
	setcookie("register_year", $year, $cookie_expire);
	setcookie("register_sex", $sex, $cookie_expire);
	setcookie("register_marketing", $marketing, $cookie_expire);
	setcookie("register_newsletter", $newsletter, $cookie_expire);
	setcookie("register_years18", $years18, $cookie_expire);
	setcookie("register_rules", $rules, $cookie_expire);
	setcookie("register_errors", $errors, $cookie_expire);
	
	Header("Location: registration.php");

} else {

	setcookie("register_name", "", 1);
	setcookie("register_username", "", 1);
	setcookie("register_email", "", 1);
	setcookie("register_day", "", 1);
	setcookie("register_month", "", 1);
	setcookie("register_year", "", 1);
	setcookie("register_sex", "", 1);
	setcookie("register_marketing", "", 1);
	setcookie("register_newsletter", "", 1);
	setcookie("register_years18", "", 1);
	setcookie("register_rules", "", 1);
	setcookie("register_errors", "", 1);
	
	$valid_code = md5(uniqid(rand()).$name);
	$user_ip = $_SERVER["REMOTE_ADDR"];
	
	if (($marketing!=0)&&($marketing!=1)&&($marketing!=2)&&($marketing!=3)&&($marketing!=4)&&($marketing!=5)&&($marketing!=6)) {
		$marketing = 0;
	}
	
	if ($newsletter!=1) {
		$newsletter = 0;
	}
	
	if ($_COOKIE["a"]) {
	
		$a = sql_injection_check($_COOKIE["a"]);
		
		if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE id = '$a'")==0) {
			$a = 0;
		}
		
	} else {
		$a = 0;
	}
	
	if ($_COOKIE["f"]) {
	
		$f = sql_injection_check($_COOKIE["f"]);
		
		if (GetRow("SELECT COUNT(id) FROM users_friends WHERE id = '$f'")==0) {
			$f = 0;
		}
		
	} else {
		$f = 0;
	}

	// Unset cookies
	setcookie("a", "", 1);
	setcookie("f", "", 1);

	// Detect friends
	if ($f==0) {
	
		if (GetRow("SELECT COUNT(id) FROM users_friends WHERE email = '$email' AND percentage = '0'")!=0) {
			$f = GetRow("SELECT id FROM users_friends WHERE email = '$email AND percentage = '0' LIMIT 1");
		}
	
	}

	// Detect if user is an afflite and a friend
	if (($f!=0)&&($a!=0)) {
		$f = 0;
	}

	if (GetRow("SELECT COUNT(id) FROM fraud_banip WHERE ip = '".$user_ip."'")!=0) {
		$banned = 1;
	}

	if (GetRow("SELECT COUNT(id) FROM fraud_banemail WHERE email = '$email'")!=0) {
		$banned = 1;
	}

	$user_id = SqlQuery("INSERT INTO `users` (`id`,`fullname`,`username`,`password`,`email`,`ssn`,`address`,`citypart`,`zipcode`,`telephone`,`day`,`month`,`year`,`sex`,`city`,`state`,`affliateId`,`friendId`,`joinedWhen`,`lastActive`,`ip`,`super`,`b75_voice`,`b75_avatar`,`b75_marker`,`credits`,`bonus`,`logged`,`captcha`,`marketing`,`newsletter`,`ban`,`delete`) VALUES (NULL,'$name','$username',MD5('$password1'),'$email',NULL,NULL,NULL,NULL,NULL,'$day','$month','$year','$sex',NULL,NULL,'$a','$f',NOW(),NOW(),'$user_ip','0','1','1','1','0','0','0','0','$marketing','$newsletter','$banned','0')");
	
	/** Start session **/
	
	$session = md5(uniqid(rand().generate_password(30)));
	
	while (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '$session'")!=0) {
		srand((double)microtime()*1000000);
		$session = md5(uniqid(rand()));
	}
	
	SqlQuery("INSERT INTO `sessions` (`sessionId`,`userId`,`sessionStart`,`lastACTIVE`,`userType`) VALUES ('$session', '$user_id', NOW(), NOW(),'1')");
	setcookie("session", $session, time()+86400);  /* expire in 24 hours */
	
	if ($banned==1) {
		setcookie("session2", md5(generate_password(30)), time()+31536000);  /* expire in 1 year */
	}

	Header("Location: ".$links["ACCOUNT"]);

}


?>