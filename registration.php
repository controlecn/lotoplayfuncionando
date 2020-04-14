<?

$html_title = "registration";
$openTab = "registration";

include("include_header.php");

if ($logged==0) {

	$errors = array();

	if ($_COOKIE["register_errors"]) {
		$errors = explode(",", $_COOKIE["register_errors"]);
	}

?>

	<div class="registration_left">
      <div class="registration_panel">
            <div>
            	<h1><?=$lang["register_title"]?></h1>
                <form method="post" action="<?=$links["REGISTRATION_UPD"]?>" onsubmit="return verify_form_registration();">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("name_short,name_long")?>"><?=$lang["register_name"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="name" id="name" type="text" size="40" class="registration_text" value="<?=$_COOKIE["register_name"]?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("username_short,username_long,username_exists,username_invalid")?>"><?=$lang["register_nick"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="username" id="username"  type="text" size="25" class="registration_text" value="<?=$_COOKIE["register_username"]?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("password_short,password_long,password_nomatch")?>"><?=$lang["register_password1"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="password1" id="password1"  type="password" size="15" class="registration_text" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("password_short,password_long,password_nomatch")?>"><?=$lang["register_password2"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="password2" id="password2" type="password" size="15" class="registration_text" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("email_short,email_long,email_notvalid,email_exists")?>"><?=$lang["register_email"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="email" id="email" type="text" size="30" class="registration_text" value="<?=$_COOKIE["register_email"]?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("day_notvalid,month_notvalid,year_notvalid,date_notvalid")?>"><?=$lang["register_birthday"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td>
					<input name="day" id="day" type="text" style="width: 30px" maxlength="2" class="registration_text" value="<? if ($_COOKIE["register_day"]) { echo $_COOKIE["register_day"]; } else { echo $lang["register_day"]; } ?>" onfocus="if (this.value=='<?=$lang["register_day"]?>') { this.value='' }" />
					<select name="month" id="month" class="registration_text">
					<option value="0"<? if ((!$_COOKIE["register_month"])||($_COOKIE["register_month"]==0)) echo " selected=\"selected\""; ?>><?=$lang["month"]?></option>
					<option value="1"<? if ($_COOKIE["register_month"]==1) echo " selected=\"selected\""; ?>><?=$lang["month_1"]?></option>
					<option value="2"<? if ($_COOKIE["register_month"]==2) echo " selected=\"selected\""; ?>><?=$lang["month_2"]?></option>
					<option value="3"<? if ($_COOKIE["register_month"]==3) echo " selected=\"selected\""; ?>><?=$lang["month_3"]?></option>
					<option value="4"<? if ($_COOKIE["register_month"]==4) echo " selected=\"selected\""; ?>><?=$lang["month_4"]?></option>
					<option value="5"<? if ($_COOKIE["register_month"]==5) echo " selected=\"selected\""; ?>><?=$lang["month_5"]?></option>
					<option value="6"<? if ($_COOKIE["register_month"]==6) echo " selected=\"selected\""; ?>><?=$lang["month_6"]?></option>
					<option value="7"<? if ($_COOKIE["register_month"]==7) echo " selected=\"selected\""; ?>><?=$lang["month_7"]?></option>
					<option value="8"<? if ($_COOKIE["register_month"]==8) echo " selected=\"selected\""; ?>><?=$lang["month_8"]?></option>
					<option value="9"<? if ($_COOKIE["register_month"]==9) echo " selected=\"selected\""; ?>><?=$lang["month_9"]?></option>
					<option value="10"<? if ($_COOKIE["register_month"]==10) echo " selected=\"selected\""; ?>><?=$lang["month_10"]?></option>
					<option value="11"<? if ($_COOKIE["register_month"]==11) echo " selected=\"selected\""; ?>><?=$lang["month_11"]?></option>
					<option value="12"<? if ($_COOKIE["register_month"]==12) echo " selected=\"selected\""; ?>><?=$lang["month_12"]?></option>
					
					</select>
					<input name="year" id="year" type="text" style="width: 60px" maxlength="4" value="<? if ($_COOKIE["register_year"]) { echo $_COOKIE["register_year"]; } else { echo $lang["register_year"]; } ?>" class="registration_text" onfocus="if (this.value=='<?=$lang["register_year"]?>') { this.value='' }" />
					</td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_<?checkError("sex")?>"><?=$lang["register_sex"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td>
					<select name="sex" id="sex" class="registration_text">
					<option value="0"<? if ((!$_COOKIE["register_sex"])||($_COOKIE["register_sex"]==0)) echo " selected=\"selected\""; ?>><?=$lang["register_sex_0"]?></option>
					<option value="1"<? if ($_COOKIE["register_sex"]==1) echo " selected=\"selected\""; ?>><?=$lang["register_sex_1"]?></option>
					<option value="2"<? if ($_COOKIE["register_sex"]==2) echo " selected=\"selected\""; ?>><?=$lang["register_sex_2"]?></option>
					</select>
					</td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_text"><?=$lang["register_marketing"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td>
					<select name="marketing" id="marketing" class="registration_text">
					<option value="0"<? if ((!$_COOKIE["register_marketing"])||($_COOKIE["register_marketing"]==0)) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_0"]?></option>
					<option value="1"<? if ($_COOKIE["register_marketing"]==1) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_1"]?></option>
					<option value="2"<? if ($_COOKIE["register_marketing"]==2) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_2"]?></option>
					<option value="3"<? if ($_COOKIE["register_marketing"]==3) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_3"]?></option>
					<option value="4"<? if ($_COOKIE["register_marketing"]==4) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_4"]?></option>
					<option value="5"<? if ($_COOKIE["register_marketing"]==5) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_5"]?></option>
					<option value="6"<? if ($_COOKIE["register_marketing"]==6) echo " selected=\"selected\""; ?>><?=$lang["register_marketing_6"]?></option>
					</select>
					</td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td width="170"></td>
                    <td width="20">&nbsp;</td>
                    <td><input name="newsletter" id="newsletter" type="checkbox" value="1" checked="checked" /><label for="newsletter" class="registration_text"><?=$lang["register_newsletter"]?></label></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td width="170"></td>
                    <td width="20">&nbsp;</td>
                    <td><input name="years18" id="years18" type="checkbox" value="1"<? if ($_COOKIE["register_years18"]==1) echo " checked=\"checked\""; ?> /><label for="years18" class="registration_<?checkError("18years")?>"><?=$lang["register_agree1"]?></label></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td width="170"></td>
                    <td width="20">&nbsp;</td>
                    <td><input name="rules" id="rules" type="checkbox" value="1"<? if ($_COOKIE["register_rules"]==1) echo " checked=\"checked\""; ?> /><label for="rules" class="registration_<?checkError("rules")?>"><?=$lang["register_agree2"]?></label></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td width="170"></td>
                    <td width="20">&nbsp;</td>
                    <td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["register_submit"]?>" class="registration_text" /></td>
                  </tr>
                </table>
				<input type="hidden" name="code" value="<?=form_key_create("REGISTRATION")?>" />
                </form>
            </div>
      </div>
	</div>
    <div class="registration_right">
	
		<? if (count($errors)!=0) { ?>
		
    	<img src="img/<?=$global_lang?>/label_verify.gif" alt="<?=$lang["register_verify"]?>" alt="<?=$alt["register_verify"]?>" /><br />

		<?
		
			$error_count = 0;
			
			function showError($code) {
			
				global $global_lang, $lang, $alt;
			
			?>
			
				<div class="registration_why">
				  <div class="check"><img src="img/<?=$global_lang?>/icon_error.gif" alt="<?=$alt["register_error"]?>" /></div>
				  <div class="text1"><?=$lang["register_error_".$code]?></div>
				</div>
		
			<?
			
			}
		
			// Name
			
			if ($error_count!=9) {
			
				if (in_array("name_short", $errors)) {
					showError("name_short");
					$error_count++;
				} else {
				
					if (in_array("name_long", $errors)) {
						showError("name_long");
						$error_count++;
					}

				}
				
			}
			
			// Nickname
			
			if ($error_count!=9) {
			
				if (in_array("username_short", $errors)) {
					showError("username_short");
					$error_count++;
				} else {
				
					if (in_array("username_long", $errors)) {
						showError("username_long");
						$error_count++;
					} else {
					
						if (in_array("username_exists", $errors)) {
							showError("username_exists");
							$error_count++;
						} else {
						
							if (in_array("username_invalid", $errors)) {
								showError("username_invalid");
								$error_count++;
							}
						
						}
					
					}

				}
				
			}
			
			// Password
			
			if ($error_count!=9) {
			
				if (in_array("password_short", $errors)) {
					showError("password_short");
					$error_count++;
				} else {
				
					if (in_array("password_long", $errors)) {
						showError("password_long");
						$error_count++;
					} else {
					
						if (in_array("password_nomatch", $errors)) {
							showError("password_nomatch");
							$error_count++;
						}
					
					}

				}
				
			}
			
			// Email
			
			if ($error_count!=9) {

				if (in_array("email_short", $errors)) {
					showError("email_short");
					$error_count++;
				} else {
				
					if (in_array("email_long", $errors)) {
						showError("email_long");
						$error_count++;
					} else {
					
						if (in_array("email_notvalid", $errors)) {
							showError("email_notvalid");
							$error_count++;
						} else {
						
							if (in_array("email_exists", $errors)) {
								showError("email_exists");
								$error_count++;
							}
						
						}
					
					}

				}

			}
			
			// Day
			
			if ($error_count!=9) {

				if (in_array("day_notvalid", $errors)) {
					showError("day_notvalid");
					$error_count++;
				}

			}
			
			// Month

			if ($error_count!=9) {

				if (in_array("month_notvalid", $errors)) {
					showError("month_notvalid");
					$error_count++;
				}

			}
			
			// Year

			if ($error_count!=9) {

				if (in_array("year_notvalid", $errors)) {
					showError("year_notvalid");
					$error_count++;
				}

			}
			
			// Birthdate

			if ($error_count!=9) {

				if (in_array("date_notvalid", $errors)) {
					showError("date_notvalid");
					$error_count++;
				}

			}
			
			// Sex
			
			if ($error_count!=9) {

				if (in_array("sex", $errors)) {
					showError("sex");
					$error_count++;
				}
				
			}
			
			// 18 years
			
			if ($error_count!=9) {

				if (in_array("18years", $errors)) {
					showError("18years");
					$error_count++;
				}
				
			}
			
			// Rules
			
			if ($error_count!=9) {

				if (in_array("rules", $errors)) {
					showError("rules");
					$error_count++;
				}
				
			}
		
		
		?>
		
		<? } else { ?>
	
    	<img src="img/<?=$global_lang?>/label_whylotoplay.gif" alt="<?=$lang["register_why"]?>" /><br />
        
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text1"><?=$lang["register_reason1"]?></div>
        </div>
		
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text1"><?=$lang["register_reason2"]?></div>
        </div>
		
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text2"><?=$lang["register_reason3"]?></div>
        </div>
        
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text1"><?=$lang["register_reason4"]?></div>
        </div>

        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text2"><?=$lang["register_reason5"]?></div>
        </div>
        
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text2"><?=$lang["register_reason6"]?></div>
        </div>
        
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text1"><?=$lang["register_reason7"]?></div>
        </div>
        
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text1"><?=$lang["register_reason8"]?></div>
        </div>
        
        <div class="registration_why">
      	  <div class="check"><img src="img/<?=$global_lang?>/icon_check.gif" alt="<?=$alt["register_whylotoplay"]?>" /></div>
          <div class="text1"><?=$lang["register_reason9"]?></div>
        </div>
		
		<? } ?>
       
    </div>
    <div style="clear: both;"></div>
<? }

include("include_bottom.php"); ?>