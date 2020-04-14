<?

$html_title = "forgot_password";

$affliate = &$_GET["affliate"];

if ($affliate==1) {
	$openTab = "affliates";
} else {
	$openTab = "account";
}

include("include_header.php");

$affliate = sql_injection_check($_GET["affliate"]);

if ($affliate!=1) {
	$affliate = 0;
}


$cmd = sql_injection_check($_GET["cmd"]);

echo "<h1>".$lang["forgot_password_title"]."</h1>";

if (($cmd=="update")&&(form_key_verify("FORGOT_PASSWORD", sql_injection_check($_POST["code"])))) {

	$email = sql_injection_check($_POST["email"]);
	
	if ($affliate!=1) {

		if (GetRow("SELECT COUNT(id) FROM users WHERE email = '$email'")!=0) {

			$newpass = addslashes(generate_password(8));
			
			sqlQuery ("UPDATE users SET password = MD5('$newpass') WHERE email = '$email'");
			
			$username = GetRow("SELECT username FROM users WHERE email = '$email'");
			
			$emailSubject = GetRow("SELECT subject FROM emails WHERE code = 'FORGOT_PASSWORD'");
			$emailContent = GetRow("SELECT content FROM emails WHERE code = 'FORGOT_PASSWORD'");

			$emailContent = str_replace("%%USERNAME%%", $username, $emailContent);
			$emailContent = str_replace("%%PASSWORD%%", $newpass, $emailContent);

			send_email($email, $emailSubject, $emailContent);		

		}

	} else {
	
		if (GetRow("SELECT COUNT(id) FROM users_affliates WHERE email = '$email'")!=0) {

			$newpass = addslashes(generate_password(8));
			
			sqlQuery ("UPDATE users_affliates SET password = MD5('$newpass') WHERE email = '$email'");
			
			$username = GetRow("SELECT login FROM users_affliates WHERE email = '$email'");
			
			$emailSubject = GetRow("SELECT subject FROM emails WHERE code = 'FORGOT_PASSWORD'");
			$emailContent = GetRow("SELECT content FROM emails WHERE code = 'FORGOT_PASSWORD'");

			$emailContent = str_replace("%%USERNAME%%", $username, $emailContent);
			$emailContent = str_replace("%%PASSWORD%%", $newpass, $emailContent);

			send_email($email, $emailSubject, $emailContent);		

		}
	
	}
		
	echo "<p>".$lang["forgot_password_sent"]."</p>";

} else {

	?>

	<p><?=$lang["forgot_password_content"]?></p>

	<? if ($affliate==1) { ?>
	<form method="post" action="<?=$links["FORGOT_PASSWORD"]?>?cmd=update&affliate=1" onsubmit="return verify_form_forgotpassword();">
	<? } else { ?>
	<form method="post" action="<?=$links["FORGOT_PASSWORD"]?>?cmd=update" onsubmit="return verify_form_forgotpassword();">
	<? } ?>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" height="40"></td>
		</tr>
		<tr>
			<td valign="top" align="right" width="170" class="registration_text"><?=$lang["forgot_password_email"]?>:</td>
			<td width="20">&nbsp;</td>
			<td><input name="email" id="email" type="text" size="40" class="registration_text" value="" /></td>
		</tr>
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td width="170"></td>
			<td width="20">&nbsp;</td>
			<td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["forgot_password_submit"]?>" class="registration_text" /></td>
		</tr>
		<tr>
			<td colspan="3" height="40"></td>
		</tr>
	</table>
	<input type="hidden" name="code" value="<?=form_key_create("FORGOT_PASSWORD")?>" />
	</form>
	<?

}

include("include_bottom.php"); ?>