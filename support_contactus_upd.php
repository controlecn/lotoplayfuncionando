<?

if (form_key_verify("SUPPORT_CONTACT", sql_injection_check($_POST["code"]))) {

	if ($logged==1) {
		$name = $user_data["fullname"];
		$email = $user_data["email"];
		$user_id = $user_data["id"];
	} else {
		$name = sql_injection_check($_POST["name"]);
		$email = sql_injection_check($_POST["email"]);
		$user_id = 0;
	}
	
	$subject = sql_injection_check($_POST["subject"]);
	
	if (($subject!=0)&&($subject!=1)&&($subject!=2)&&($subject!=3)&&($subject!=4)) {
		$subject = 0;
	}

	$message = sql_injection_check($_POST["message"]);
	$message = strip_tags($message, "<p><br><hr><b><font><i><u>");
	
	if (GetRow("SELECT COUNT(id) FROM tickets WHERE userid = '$user_id' AND email = '$email' AND status = '1'")==0) {
		$ticket_id = SqlQuery("INSERT INTO tickets (account_id, subject, status, userid, email, ticket_type, ticket_date) VALUES ('1', '".$lang["support_contactus_subject_".$subject]."', '1', '$user_id', '$email', '1', NOW())");
	} else {
		$ticket_id = GetRow("SELECT id FROM tickets WHERE userid = '$user_id' AND email = '$email' AND status = '1' LIMIT 1");
	}
	
	$content_id = SqlQuery("INSERT INTO tickets_contents (ticket_id, content_time, content_type, contents) VALUES ('$ticket_id', NOW(), '1', '$name:<br><br>$message')");

	?>
	<h1><?=$lang["support_contactus"]?></h1>
	<p><?=$lang["support_contactus_thanks"]?></p>

	<br /><a href="<?=$links["SUPPORT"]?>" class="blink"><?=$lang["support_back"]?></a>

<? } ?>