<? showContent("INDEX") ?>

				<p>
				<? if ($logged==0) { ?>
                <a href="<?=$links["REGISTRATION"]?>" class="blink"><?=$lang["index_register"]?></a>
				<? } else { ?>
				<a href="javascript:open_games();" class="blink"><?=$lang["index_opengames"]?></a>
				<? } ?>
				</p>


<?

if ($logged==1) {
	$value_name = $user_data["fullname"];
	$value_email = $user_data["email"];
} else {
	$value_name = "";
	$value_email = "";
}


?><div class="contact_left">
      <div class="contact_panel">
            <div>
            	<h1><?=$lang["support_contactus"]?></h1>
                <form method="post" action="<?=$links["SUPPORT_CONTACTUSUPD"]?>" onsubmit="return verify_form_contactus();">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_text"><?=$lang["support_contactus_name"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="name" id="name" type="text" size="40" class="registration_text" value="<?=$value_name?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_text"><?=$lang["support_contactus_email"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><input name="email" id="email" type="text" size="25" class="registration_text" value="<?=$value_email?>" /></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_text"><?=$lang["support_contactus_subject"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td>
						<select name="subject" id="subject" class="registration_text">
							<option value="0"><?=$lang["support_contactus_subject_0"]?></option>
							<option value="1"><?=$lang["support_contactus_subject_1"]?></option>
							<option value="2"><?=$lang["support_contactus_subject_2"]?></option>
							<option value="3"><?=$lang["support_contactus_subject_3"]?></option>
							<option value="4"><?=$lang["support_contactus_subject_4"]?></option>
							<option value="5"><?=$lang["support_contactus_subject_5"]?></option>
						</select>
					</td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td valign="top" align="right" width="170" class="registration_text"><?=$lang["support_contactus_message"]?>:</td>
                    <td width="20">&nbsp;</td>
                    <td><textarea name="message" id="message" class="registration_text" cols="40" rows="8"></textarea></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td align="right" width="170" class="registration_text"></td>
                    <td width="20">&nbsp;</td>
                    <td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["support_contactus_submit"]?>" class="registration_text" /></td>
                  </tr>
                </table>
				<input type="hidden" name="code" value="<?=form_key_create("SUPPORT_CONTACT")?>" />
                </form>
            </div>
      </div>
	</div>
    <div style="clear: both;"></div>
	
	<br /><a href="<?=$links["SUPPORT"]?>" class="blink"><?=$lang["support_back"]?></a>