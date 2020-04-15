<?

function showError($code) {
	global $lang;	
	echo "<br /><font color=\"#FF0000\">".$lang["account_changepassword_error_".$code].".</font>";
}

$has_errors = 0;

$do_not_display = 0;

$errors = array();

if (($_GET["cmd"]=="update")&&(form_key_verify("ACCOUNT_CHANGEPASSWORD", sql_injection_check($_POST["code"])))) {

	$password_old = sql_injection_check($_POST["password_old"]);
	$password_new1 = sql_injection_check($_POST["password_new1"]);
	$password_new2 = sql_injection_check($_POST["password_new2"]);
	
	/*** Validate Old Password ***/
	if ($user_data["password"]!=md5($password_old)) {
		$has_errors = 1;
		array_push($errors, "oldpassword_incorrect");
	}
	
	/*** Validate New Password ***/
	if (strlen($password_new1)<3) {
		$has_errors = 1;
		array_push($errors, "newpassword_short");
	}
	
	if (strlen($password_new1)>150) {
		$has_errors = 1;
		array_push($errors, "newpassword_long");
	}
	
	/*** Validate New Password - Confirm ***/
	if ($password_new1!=$password_new2) {
		$has_errors = 1;
		array_push($errors, "newpassword_nomatch");
	}
	
	if ($has_errors==0) {
	
		$do_not_display = 1;
		
		$new_pass = md5($password_new1);
		
		$seed = generate_password(30);
		$timestamp = date("Ymdhis");
		$ip = $_SERVER['REMOTE_ADDR'];
		$key = md5($seed.$timestamp.$ip);

		SqlQuery("INSERT INTO users_changepassword (userid, newpassword, verifykey) VALUES ('".$user_data["id"]."', '$new_pass', '$key')");
			
		$emailSubject = GetRow("SELECT subject FROM emails WHERE code = 'CHANGE_PASSWORD'");
		$emailContent = GetRow("SELECT content FROM emails WHERE code = 'CHANGE_PASSWORD'");

		$emailContent = str_replace("%%LINK%%", "http://www.reidobingo-net.umbler.net/".$links["ACCOUNT_CONFIRM_CHANGEPASSWORD"].$qr."key=$key", $emailContent);

		send_email($user_data["email"], $emailSubject, $emailContent);	
		
		showContent("MYACCOUNT_CHANGEPASSWORD_EMAIL");
	
	}
	
}

if ($do_not_display==0) {

?>
<h1><?=$lang["account_changepassword_title"]?></h1>
<form method="post" action="<?=$links["ACCOUNT_CHANGEPASSWORD_UPD"]?>" onSubmit="return verify_form_change_password();"?>" onSubmit="return verify_form_change_password();"?>" onSubmit="return verify_form_change_password();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="190" class="registration_&lt;?checkError(&quot;oldpassword_incorrect&quot;)?&gt;"?>"><?=$lang["account_changepassword_old_password"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<input type="password" name="password_old" id="password_old" class="registration_text" />
			<?
			
			if (in_array("oldpassword_incorrect", $errors)) {
				showError("oldpassword_incorrect");
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="190" class="registration_&lt;?checkError(&quot;newpassword_short,newpassword_long&quot;)?&gt;"?>"><?=$lang["account_changepassword_new_password1"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<input type="password" name="password_new1" id="password_new1" class="registration_text" />
			<?
			
			if (in_array("newpassword_short", $errors)) {
				showError("newpassword_short");
			} else {
				if (in_array("newpassword_long", $errors)) {
					showError("newpassword_long");
				}
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="190" class="registration_&lt;?checkError(&quot;newpassword_nomatch&quot;)?&gt;"?>"><?=$lang["account_changepassword_new_password2"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<input type="password" name="password_new2" id="password_new2" class="registration_text" />
			<?
			
			if (in_array("newpassword_nomatch", $errors)) {
				showError("newpassword_nomatch");
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td width="170"></td>
		<td width="20">&nbsp;</td>
		<td>
		<input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["account_changepassword_submit"]?>" class="registration_text"?>" class="registration_text"?>" class="registration_text" /></td>
	</tr>
</table>
<input type="hidden" name="code" value="<?=form_key_create("ACCOUNT_CHANGEPASSWORD")?>"?>"?>" />
</form>

<? } ?>

<br /><br /><a href="<?=$links["ACCOUNT"]?>" class="blink"?>" class="blink"?>" class="blink"><?=$lang["account_transfers_back"]?></a>