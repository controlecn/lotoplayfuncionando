<?

function showError($code) {
	global $lang;	
	echo "<br /><font color=\"#FF0000\">".$lang["account_change_error_".$code].".</font>";
}

$updated = 0;

$errors = array();

if (($_GET["cmd"]=="update")&&(form_key_verify("ACCOUNT_CHANGE", sql_injection_check($_POST["code"])))) {

	$cpf = sql_injection_check($_POST["cpf"]);
	$zip = sql_injection_check($_POST["zip"]);
	$telephone = sql_injection_check($_POST["telephone"]);
	$day = sql_injection_check($_POST["day"]);
	$month = sql_injection_check($_POST["month"]);
	$year = sql_injection_check($_POST["year"]);
	$sex = sql_injection_check($_POST["sex"]);
	
	$value_cpf = $cpf;
	$value_zip = $zip;
	$value_telephone = $telephone;
	$value_day = $day;
	$value_month = $month;
	$value_year = $year;
	$value_sex = $sex;
	
	$has_errors = 0;
	
	/*** Validate CPF ***/
	$cpf_validate = $cpf;
	$cpf_validate = str_replace(".", "", $cpf_validate);
	$cpf_validate = str_replace("-", "", $cpf_validate);

	if ((strlen($cpf_validate)!=11)||(!is_numeric($cpf_validate))||(verify_cpf($cpf)==0)) {
		$has_errors = 1;
		array_push($errors, "cpf_notvalid");
	}
	
	/*** Validate ZIP ***/
	$zip_validate = $zip;
	$zip_validate = str_replace("-", "", $zip_validate);

	if ((strlen($zip_validate)!=8)||(!is_numeric($zip_validate))) {
		$has_errors = 1;
		array_push($errors, "zip_notvalid");
	}

	/*** Validate Telephone ***/
	$telephone_validate = $telephone;
	$telephone_validate = str_replace("(", "", $telephone_validate);
	$telephone_validate = str_replace(")", "", $telephone_validate);
	$telephone_validate = str_replace("-", "", $telephone_validate);
	
	if ((strlen($telephone_validate)!=10)||(!is_numeric($telephone_validate))) {
		$has_errors = 1;
		array_push($errors, "telephone_notvalid");
	}
	
	/*** Validate Day ***/
	if (($day<1)||($day>31)) {
		$day = 1;
	}
	
	/*** Validate Month ***/
	if (($month<1)||($month>12)) {
		$month = 1;
	}
	
	/*** Validate Year ***/
	if (($year<1900)||($year>=date("Y"))) {
		$year = 1990;
	}
	
	/*** Validate Birthday ***/
	if (!checkdate($month, $day, $year)) {
	
		$has_errors = 1;
		array_push($errors, "date_notvalid");
		
	} else {
		
		if (birthday($year, $month, $day)<18) {
			$has_errors = 1;
			array_push($errors, "date_notvalid");
		}
		
	}
	
	/*** Validate Sex ***/
	if (($sex!=1)&&($sex!=2)) {
		$sex = 1;
	}
	
	if ($has_errors==0) {
		SqlQuery("UPDATE users SET ssn = '$cpf', zipcode = '$zip', telephone = '$telephone', day = '$day', month = '$month', year = '$year', sex = '$sex' WHERE id = '".$user_data["id"]."'");
		$updated = 1;
	}
	
	
} else {

	$value_cpf = $user_data["ssn"];
	$value_zip = $user_data["zipcode"];
	$value_telephone = $user_data["telephone"];
	$value_day = $user_data["day"];
	$value_month = $user_data["month"];
	$value_year = $user_data["year"];
	$value_sex = $user_data["sex"];

}

?>
<script type="text/javascript">
jQuery(function($){
   $("#cpf").mask("999.999.999-99");
   $("#zip").mask("99999-999");
   $("#telephone").mask("(99)9999-9999");
});
</script>
<h1><?=$lang["account_change_title"]?></h1>
<? if ($updated==1) { ?>
<font color="#00b032"><b><?=$lang["account_change_updated"]?></b></font>
<? } ?>
<form method="post" action="<?=$links["ACCOUNT_CHANGE"]?><?=$qr?>cmd=update" onsubmit="return verify_form_change_user();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="170" class="registration_text"><?=$lang["account_change_name"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text"><?=$user_data["fullname"]?></td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="170" class="registration_text"><?=$lang["account_change_nick"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text"><?=$user_data["username"]?></td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="170" class="registration_text"><?=$lang["account_change_email"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text"><?=$user_data["email"]?></td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="170" class="registration_text"><?=$lang["account_change_password"]?>:</td>
		<td width="20">&nbsp;</td>
		<td><a href="<?=$links["ACCOUNT_CHANGEPASSWORD"]?>" class="blink"><?=$lang["account_change_password_change"]?></a></td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("cpf_notvalid")?>"><?=$lang["account_change_cpf"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="cpf" id="cpf" type="text" size="12" class="registration_text" maxlength="14" value="<?=$value_cpf?>" />
			<?
			
			if (in_array("cpf_notvalid", $errors)) {
				showError("cpf_notvalid");
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("zip_notvalid")?>"><?=$lang["account_change_zip"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="zip" id="zip" type="text" size="7" class="registration_text" maxlength="9" value="<?=$value_zip?>" />
			<?

			if (in_array("zip_notvalid", $errors)) {
				showError("zip_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("telephone_notvalid")?>"><?=$lang["account_change_telephone"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="telephone" id="telephone" type="text" size="10" maxlength="13" class="registration_text" value="<?=$value_telephone?>" />
			<?

			if (in_array("telephone_notvalid", $errors)) {
				showError("telephone_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("date_notvalid")?>"><?=$lang["register_birthday"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<input name="day" id="day" type="text" style="width: 30px" maxlength="2" class="registration_text" value="<?=$value_day?>" />
			<select name="month" class="registration_text">
				<option value="1"<? if ($value_month==1) echo " selected=\"selected\""; ?>><?=$lang["month_1"]?></option>
				<option value="2"<? if ($value_month==2) echo " selected=\"selected\""; ?>><?=$lang["month_2"]?></option>
				<option value="3"<? if ($value_month==3) echo " selected=\"selected\""; ?>><?=$lang["month_3"]?></option>
				<option value="4"<? if ($value_month==4) echo " selected=\"selected\""; ?>><?=$lang["month_4"]?></option>
				<option value="5"<? if ($value_month==5) echo " selected=\"selected\""; ?>><?=$lang["month_5"]?></option>
				<option value="6"<? if ($value_month==6) echo " selected=\"selected\""; ?>><?=$lang["month_6"]?></option>
				<option value="7"<? if ($value_month==7) echo " selected=\"selected\""; ?>><?=$lang["month_7"]?></option>
				<option value="8"<? if ($value_month==8) echo " selected=\"selected\""; ?>><?=$lang["month_8"]?></option>
				<option value="9"<? if ($value_month==9) echo " selected=\"selected\""; ?>><?=$lang["month_9"]?></option>
				<option value="10"<? if ($value_month==10) echo " selected=\"selected\""; ?>><?=$lang["month_10"]?></option>
				<option value="11"<? if ($value_month==11) echo " selected=\"selected\""; ?>><?=$lang["month_11"]?></option>
				<option value="12"<? if ($value_month==12) echo " selected=\"selected\""; ?>><?=$lang["month_12"]?></option>
			</select>
			<input name="year" id="year" type="text" style="width: 60px" maxlength="4" value="<?=$value_year?>" class="registration_text" />
			<?

			if (in_array("date_notvalid", $errors)) {
				showError("date_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="170" class="registration_text"><?=$lang["register_sex"]?>:</td>
		<td width="20">&nbsp;</td>
		<td>
			<select name="sex" class="registration_text">
				<option value="1"<? if ($value_sex==1) echo " selected=\"selected\""; ?>><?=$lang["register_sex_1"]?></option>
				<option value="2"<? if ($value_sex==2) echo " selected=\"selected\""; ?>><?=$lang["register_sex_2"]?></option>
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td width="170"></td>
		<td width="20">&nbsp;</td>
		<td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["account_friends_submit"]?>" class="registration_text" /></td>
	</tr>
</table>
<input type="hidden" name="code" value="<?=form_key_create("ACCOUNT_CHANGE")?>" />
</form>

<br />
<a href="<?=$config["support_url"]?>" class="blink_small"><?=$lang["account_change_update_other"]?></a>

<br /><br /><a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_transfers_back"]?></a>