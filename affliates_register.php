<?

$errors = array();

if ($_COOKIE["affliates_register_errors"]) {
	$errors = explode(",", $_COOKIE["affliates_register_errors"]);
}

function showError($code) {
	global $lang;
	echo "<br /><font color=\"#FF0000\">".$lang["affliates_register_error_".$code]."</font>";
}

?>
<h1><?=$lang["affliates_register_title"]?></h1>
<script type="text/javascript">
jQuery(function($){
   $("#telephone").mask("(99)9999-9999");
});
</script>
<form method="post" action="<?=$links["AFFILIATES_REGISTER_UPD"]?>" onsubmit="return verify_form_aregistration();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("name_short,name_long")?>"><?=$lang["affliates_register_name"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="name" id="name" type="text" size="40" class="registration_text" value="<?=$_COOKIE["affliates_register_name"]?>" />
		<?
		if (in_array("name_short", $errors)) showError("name_short");
		if (in_array("name_long", $errors)) showError("name_long");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("url_short,url_long")?>"><?=$lang["affliates_register_url"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="url" id="url" type="text" size="35" class="registration_text" value="<?=$_COOKIE["affliates_register_url"]?>" /><br /><?=$lang["affliates_register_url_example"]?>
		<?
		if (in_array("url_short", $errors)) showError("url_short");
		if (in_array("url_long", $errors)) showError("url_long");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("telephone_short,telephone_long")?>"><?=$lang["affliates_register_telephone"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="telephone" id="telephone" type="text" size="15" class="registration_text" value="<?=$_COOKIE["affliates_register_telephone"]?>" />
		<?
		if (in_array("telephone_short", $errors)) showError("telephone_short");
		if (in_array("telephone_long", $errors)) showError("telephone_long");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("username_short,username_long,username_exists,username_invalid")?>"><?=$lang["affliates_register_username"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="username" id="username" type="text" size="20" class="registration_text" value="<?=$_COOKIE["affliates_register_username"]?>" />
		<?
		if (in_array("username_short", $errors)) showError("username_short");
		if (in_array("username_long", $errors)) showError("username_long");
		if (in_array("username_exists", $errors)) showError("username_exists");
		if (in_array("username_invalid", $errors)) showError("username_invalid");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("password_short,password_long,password_nomatch")?>"><?=$lang["affliates_register_password1"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="password1" id="password1" type="password" size="15" class="registration_text" />
		<?
		if (in_array("password_short", $errors)) showError("password_short");
		if (in_array("password_long", $errors)) showError("password_long");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("password_short,password_long,password_nomatch")?>"><?=$lang["affliates_register_password2"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="password2" id="password2" type="password" size="15" class="registration_text" />
		<?
		if (in_array("password_nomatch", $errors)) showError("password_nomatch");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("email_short,email_long,email_notvalid,email_exists")?>"><?=$lang["affliates_register_email"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="email" id="email" type="text" size="30" class="registration_text" value="<?=$_COOKIE["affliates_register_email"]?>" />
		<?
		if (in_array("email_short", $errors)) showError("email_short");
		if (in_array("email_long", $errors)) showError("email_long");
		if (in_array("email_exists", $errors)) showError("email_exists");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("bank_select,bank_error")?>"><?=$lang["affliates_register_bank"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<select name="bank" id="bank" class="registration_text">
				<option value="0"<? if (!$_COOKIE["affliates_register_bank"]) echo " selected=\"selected\""; ?>><?=$lang["affliates_register_bank_select"]?></option>
				<?

				$sql = "SELECT * FROM affliates_banks";
				$result = mysql_query($sql, $mysql_link);

				if ($result) {

					while ($row = mysql_fetch_array($result)) {

						$number = $row["number"];
						$name = $row["name"];

						if ($_COOKIE["affliates_register_bank"]==$number) {
							echo "<option value=\"$number\" selected=\"selected\">$name</option>";
						} else {
							echo "<option value=\"$number\">$name</option>";
						}

					}

					mysql_free_result($result);

				}

				?>
			</select>
		<?
		if (in_array("bank_select", $errors)) showError("bank_select");
		if (in_array("bank_error", $errors)) showError("bank_error");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("bank_agent_short,bank_agent_long")?>"><?=$lang["affliates_register_bank_agent"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="bank_agent" id="bank_agent" type="text" size="6" class="registration_text" value="<?=$_COOKIE["affliates_register_bank_agent"]?>" />
		<?
		if (in_array("bank_agent_short", $errors)) showError("bank_agent_short");
		if (in_array("bank_agent_long", $errors)) showError("bank_agent_long");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("bank_account_short,bank_account_long")?>"><?=$lang["affliates_register_bank_account"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><input name="bank_account" id="bank_account" type="text" size="10" class="registration_text" value="<?=$_COOKIE["affliates_register_bank_account"]?>" />
		<?
		if (in_array("bank_account_short", $errors)) showError("bank_account_short");
		if (in_array("bank_account_long", $errors)) showError("bank_account_long");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("bank_type_select")?>"><?=$lang["affliates_register_bank_type"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="bank_type" type="radio" id="bank_type_1" value="1"<? if ($_COOKIE["affliates_register_bank_type"]==1) echo " checked=\"checked\""; ?> /><label for="bank_type_1"><?=$lang["affliates_register_bank_type_1"]?></label>
			<input name="bank_type" type="radio" id="bank_type_2" value="2"<? if ($_COOKIE["affliates_register_bank_type"]==2) echo " checked=\"checked\""; ?> /><label for="bank_type_2"><?=$lang["affliates_register_bank_type_2"]?></label>
			<?
			if (in_array("bank_type_select", $errors)) showError("bank_type_select");
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td width="170"></td>
		<td width="20">&nbsp;</td>
		<td><input name="rules" type="checkbox" id="rules" value="1"<? if ($_COOKIE["affliates_register_rules"]==1) echo " checked"; ?> /><label for="rules" class="registration_<?checkError("rules")?>"><?=$lang["affliates_register_agree"]?></label>
		<?
		if (in_array("rules", $errors)) showError("rules");
		?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td width="170"></td>
		<td width="20">&nbsp;</td>
		<td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["affliates_register_submit"]?>" class="registration_text" /></td>
	</tr>
</table>
<input type="hidden" name="code" value="<?=form_key_create("AFFLIATES_REGISTRATION")?>" />
</form>