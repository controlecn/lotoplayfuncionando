<?

include("include_settings.php");

if (form_key_verify("AFFLIATES_REGISTRATION", sql_injection_check($_POST["code"]))) {

	$name = sql_injection_check($_POST["name"]);
	$url = sql_injection_check($_POST["url"]);
	$telephone = sql_injection_check($_POST["telephone"]);
	$username = sql_injection_check($_POST["username"]);
	$password1 = sql_injection_check($_POST["password1"]);
	$password2 = sql_injection_check($_POST["password2"]);
	$email = sql_injection_check($_POST["email"]);
	$bank = sql_injection_check($_POST["bank"]);
	$bank_agent = sql_injection_check($_POST["bank_agent"]);
	$bank_account = sql_injection_check($_POST["bank_account"]);
	$bank_type = sql_injection_check($_POST["bank_type"]);
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

		/*** Url ***/
	if (strlen($url)<3) {
		$has_errors = 1;
		array_push($errors, "url_short");
	}

	if (strlen($url)>250) {
		$has_errors = 1;
		array_push($errors, "url_long");
	}

		/*** Telephone ***/
	if (strlen($telephone)<3) {
		$has_errors = 1;
		array_push($errors, "telephone_short");
	}

	if (strlen($telephone)>150) {
		$has_errors = 1;
		array_push($errors, "telephone_long");
	}

		/*** Username ***/
	if (strlen($username)<3) {
		$has_errors = 1;
		array_push($errors, "username_short");
	}

	if (strlen($username)>150) {
		$has_errors = 1;
		array_push($errors, "username_long");
	}

	if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE username = '$username'")!=0) {
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


	if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE email = '$email'")!=0) {
		$has_errors = 1;
		array_push($errors, "email_exists");
	}

		/*** Bank ***/
	if ($bank==0) {
		$has_errors = 1;
		array_push($errors, "bank_select");
	} else {

		if (GetRow("SELECT COUNT(id) FROM affliates_banks WHERE number = '$bank'")==0) {
			$has_errors = 1;
			array_push($errors, "bank_error");
		}

	}

		/*** Bank Agent ***/
	if (strlen($bank_agent)<2) {
		$has_errors = 1;
		array_push($errors, "bank_agent_short");
	}

	if (strlen($bank_agent)>20) {
		$has_errors = 1;
		array_push($errors, "bank_agent_long");
	}

		/*** Bank Account ***/
	if (strlen($bank_account)<2) {
		$has_errors = 1;
		array_push($errors, "bank_account_short");
	}

	if (strlen($bank_account)>30) {
		$has_errors = 1;
		array_push($errors, "bank_account_long");
	}

		/*** Bank Account Type ***/
	if (($bank_type!=1)&&($bank_type!=2)) {
		$has_errors = 1;
		array_push($errors, "bank_type_select");
	}

		/*** Rules ***/
	if ($rules!=1) {
		$has_errors = 1;
		array_push($errors, "rules");
	}
		
	if ($has_errors==1) {

		$errors = implode($errors, ",");
		
		$cookie_expire = time()+(24*3600);	
		setcookie("affliates_register_name", $name, $cookie_expire);
		setcookie("affliates_register_url", $url, $cookie_expire);
		setcookie("affliates_register_telephone", $telephone, $cookie_expire);
		setcookie("affliates_register_username", $username, $cookie_expire);
		setcookie("affliates_register_email", $email, $cookie_expire);
		setcookie("affliates_register_bank", $bank, $cookie_expire);
		setcookie("affliates_register_bank_agent", $bank_agent, $cookie_expire);
		setcookie("affliates_register_bank_account", $bank_account, $cookie_expire);
		setcookie("affliates_register_bank_type", $bank_type, $cookie_expire);
		setcookie("affliates_register_rules", $rules, $cookie_expire);
		setcookie("affliates_register_errors", $errors, $cookie_expire);
		
		Header("Location: ".$links["AFFILIATES_REGISTER"]);

	} else {

		setcookie("affliates_register_name", "", 1);
		setcookie("affliates_register_url", "", 1);
		setcookie("affliates_register_telephone", "", 1);
		setcookie("affliates_register_username", "", 1);
		setcookie("affliates_register_email", "", 1);
		setcookie("affliates_register_bank", "", 1);
		setcookie("affliates_register_bank_agent", "", 1);
		setcookie("affliates_register_bank_account", "", 1);
		setcookie("affliates_register_bank_type", "", 1);
		setcookie("affliates_register_rules", "", 1);
		setcookie("affliates_register_errors", "", 1);
	
		$user_id = SqlQuery("INSERT INTO `users_affliates` (`name`,`url`,`telephone`,`login`,`password`,`email`,`payType`,`payBank`,`payAgent`,`payAccount`,`payAccountType`,`registerDate`) VALUES ('$name','$url','$telephone','$username',MD5('$password'),'$email','1','$bank','$bank_agent','$bank_account','$bank_type',NOW())");
	
		/*** Start session ***/
		
		$session = md5(uniqid(rand()));
		
		while (GetRow("SELECT COUNT(id) FROM sessions WHERE sessionId = '$session'")!=0) {
			srand((double)microtime()*1000000);
			$session = md5(uniqid(rand()));
		}
		
		SqlQuery("INSERT INTO `sessions` (`sessionId`,`userId`,`sessionStart`,`lastACTIVE`,`userType`) VALUES ('$session', '$user_id', NOW(), NOW(),'2')");
		setcookie("affliate_session", $session, time()+(24*3600));  /* expire in 24 hours */

		Header("Location: ".$links["AFFILIATES_REGISTER_COMPLETE"]);

	}

}

?>