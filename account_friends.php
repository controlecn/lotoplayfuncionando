<?

function showError($code) {
	global $lang;	
	echo "<br /><font color=\"#FF0000\">".$lang["account_friends_error_".$code].".</font>";
}

$errors = array();

if (($_GET["cmd"]=="send")&&(form_key_verify("ACCOUNT_FRIENDS", sql_injection_check($_POST["code"])))) {

	$name = sql_injection_check($_POST["name"]);
	$email = sql_injection_check($_POST["email"]);
	$message = sql_injection_check($_POST["message"]);
	
	$value_name = $name;
	$value_email = $email;
	$value_message = $message;
	
	/*** Name ***/
	if (strlen($name)<3) {
		$has_errors = 1;
		array_push($errors, "name_notvalid");
	}
	
	/*** Email ***/
	if (verify_email($email)!=1) {
		$has_errors = 1;
		array_push($errors, "email_notvalid");
	}
	
	if (GetRow("SELECT COUNT(id) FROM users WHERE email = '$email'")!=0) {
		$has_errors = 1;
		array_push($errors, "email_exists");
	}
	
	/*** Message ***/
	if (strlen($message)<3) {
		$has_errors = 1;
		array_push($errors, "message_notvalid");
	}
	
	if ($has_errors==0) {
		$friendId = sqlQuery("INSERT INTO users_friends (userId,name,email,percentage,addedWhen) VALUES (".$user_data["id"].", '".addslashes($name)."', '".addslashes($email)."', 0, NOW())");
		$subject = GetRow("SELECT subject FROM emails WHERE code = 'FRIENDS_EMAIL'");
		$link = "http://www.reidobingo-net.umbler.net/?f=$friendId";
		
		$email_header = join("", file("templates/$global_lang/email_friends_header.txt"));
		$email_footer = join("", file("templates/$global_lang/email_friends_footer.txt"));
		
		$email_header = str_replace("%%REC_NAME%%", $name, $email_header);
		$email_header = str_replace("%%URL%%", $config["static_url"], $email_header);
		$email_footer = str_replace("%%SEND_NAME%%", $user_data["fullname"], $email_footer);
		$email_footer = str_replace("%%LINK%%", $link, $email_footer);
		
		$html_message = $email_header . prepareHTML($message) . $email_footer;
		
		send_email($email, $subject, $html_message, 3);

	}

} else {
	$value_message = GetRow("SELECT content FROM emails WHERE code = 'FRIENDS_EMAIL'");
}

?>
<div class="my_account_points_left">
	<h1><?=$lang["account_friends_title"]?></h1>
	
	<p><? showContent("FRIENDS_SEND"); ?></p>
	
	<form method="post" action="<?=$links["ACCOUNT_FRIENDS"]?><?=$qr?>cmd=send" onsubmit="return verify_form_friends();"?><?=$qr?>cmd=send" onsubmit="return verify_form_friends();"?><?=$qr?>cmd=send" onsubmit="return verify_form_friends();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="100" class="registration_&lt;?checkError(&quot;name_notvalid&quot;)?&gt;"?>"><?=$lang["account_friends_name"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="name" id="name" type="text" size="27" class="registration_text" value="<?=$value_name?>" />
			<?

			if (in_array("name_notvalid", $errors)) {
				showError("name_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="100" class="registration_&lt;?checkError(&quot;email_notvalid,email_exists&quot;)?&gt;"?>"><?=$lang["account_friends_email"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="email" id="email" type="text" size="27" class="registration_text" value="<?=$value_email?>" />
			<?

			if (in_array("email_notvalid", $errors)) {
				showError("email_notvalid");
			} else {
				if (in_array("email_exists", $errors)) {
					showError("email_exists");
				}
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="100" class="registration_&lt;?checkError(&quot;message_notvalid&quot;)?&gt;"?>"><?=$lang["account_friends_message"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<textarea name="message" id="message" class="registration_text" style="font-size: 12px;" cols="58" rows="15"><?=$value_message?></textarea>
			<?

			if (in_array("message_notvalid", $errors)) {
				showError("message_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td width="100"></td>
		<td width="20">&nbsp;</td>
		<td>
		<input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["account_friends_submit"]?>" class="registration_text"?>" class="registration_text"?>" class="registration_text" /></td>
	</tr>
	</table>
	<input type="hidden" name="code" value="<?=form_key_create("ACCOUNT_FRIENDS")?>"?>"?>" />
	</form>
	
	<br /><br />
	
	<h3><?=$lang["account_friends_yourfriends"]?>:</h3>
	
	<br />
	
	<?
		
	$result = mysql_query("SELECT id,name,percentage FROM users_friends WHERE userId = '".$user_data["id"]."'", $mysql_link);

	if ($result) {

		$a = 0;

		while ($row = mysql_fetch_array($result)) {
					
			$a++;

			$id = $row["id"];
			$name = shortString($row["name"], 18);
			$percentage = $row["percentage"];

			?>
			<div class="product_holder">
				<table width="146" border="0" cellspacing="0" cellpadding="0" style="border: #AFAFAF solid 1px;">
				  <tr>
					<td bgcolor="#F7F7F7" height="30" align="center"><?=$name?></td>
				  </tr>
				  <tr>
					<td bgcolor="#AFAFAF" height="1"></td>
				  </tr>
				  <tr>
					<td bgcolor="#FFFFFF" height="106" align="center">
					<img src="img/<?=$global_lang?>/friends/<?=$percentage?>.jpg" alt="<?=$alt["account_friends_".$percentage]?>"?>"?>" /></td>
				  </tr>
				  <tr>
					<td bgcolor="#AFAFAF" height="1"></td>
				  </tr>
				  <tr>
					<td bgcolor="#F7F7F7" height="30" align="center"><b><?=$lang["account_friends_status"]?>: <?=$percentage?>%</b></td>
				  </tr>
				</table>
			</div>
			<?
		}

		mysql_free_result($result);

		if ($a==0) {
			echo $lang["account_friends_nofriends"];
		}

	}
		
	?>
</div>
    
<div class="my_account_points_right">
	<div>
		<img src="img/<?=$global_lang?>/label_simulator.gif" alt="<?=$alt["account_friends_simulator"]?>"?>"?>" /><br />

		<p><? showContent("FRIENDS_SIMULATOR") ?></p>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td valign="top" align="right" width="170" class="registration_text"><?=$lang["account_friends_simulator_friends1"]?>:</td>
			<td width="20">&nbsp;</td>
			<td><input name="friends1" id="friends1" type="text" size="3" class="registration_text" maxlength="3" value="0" /></td>
		</tr>
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td valign="top" align="right" width="170" class="registration_text"><?=$lang["account_friends_simulator_friends2"]?>:</td>
			<td width="20">&nbsp;</td>
			<td><input name="friends2" id="friends2" type="text" size="3" class="registration_text" maxlength="3" value="0" /></td>
		</tr>
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td valign="top" align="right" width="170" class="registration_text"><?=$lang["account_friends_simulator_friends3"]?>:</td>
			<td width="20">&nbsp;</td>
			<td><input name="friends3" id="friends3" type="text" size="3" class="registration_text" maxlength="3" value="0" /></td>
		</tr>
		<tr>
			<td colspan="3" height="10"></td>
		</tr>
		<tr>
			<td width="170" align="right"><i><?=$lang["account_friends_simulator_click"]?> »</i></td>
			<td width="20">&nbsp;</td>
			<td>
			<input type="button" value="<?=$lang["account_friends_simulator_calculate"]?>" class="registration_text" onclick="simulator_calculate()"?>" class="registration_text" onclick="simulator_calculate()"?>" class="registration_text" onclick="simulator_calculate()" /></td>
		</tr>
		</table>
		
		<br />
		
		<div id="simulator_output" style="display:none;">
		
			<center>
				<h2><?=$lang["account_friends_simulator_youcanwin"]?>:</h2>
				<div id="simulator_value"></div>
			</center>
			
		</div>

	</div>
    
</div>

<div style="clear: both;"></div>

<br />

<a href="<?=$links["ACCOUNT"]?>" class="blink"?>" class="blink"?>" class="blink"><?=$lang["account_transfers_back"]?></a>