	<h1><?=$lang["account_login_title"]?></h1>
    
    <p><?=$lang["account_login_content"]?></p>

	<br />

	<div class="my_account_login_left">
      <div class="my_account_login_panel">
      	<div>
        <img src="img/<?=$global_lang?>/label_do_login.gif" alt="<?=$alt["account_login_label"]?>" width="146" height="29" />
        <form method="post" action="<?=$links["LOGIN_UPDATE"]?>" onsubmit="return verify_form_login()">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<? if ($_GET["error"]==1) { ?>
          <tr>
            <td colspan="3" height="15"></td>
          </tr>
          <tr>
            <td colspan="3" height="25" align="center"><font style="color: #FF0000"><b><?=$lang["account_login_error"]?></b></font></td>
          </tr>
          <tr>
            <td colspan="3" height="15"></td>
          </tr>
		<? } else {?>
          <tr>
            <td colspan="3" height="25"></td>
          </tr>
		<? } ?>
          <tr>
            <td width="100" align="right"><b><?=$lang["account_login_username"]?>:</b>&nbsp;&nbsp;</td>
            <td><input type="text" name="username" id="username1" tabindex="1" style="width: 150px;" value="<?=$_COOKIE["username1"]?>" /></td>
            <td><a href="<?=$links["FORGOT_PASSWORD"]?>" class="blink_small" tabindex="4"><?=$lang["account_login_forgot_username"]?></a></td>
          </tr>
          <tr>
            <td colspan="3" height="15"></td>
          </tr>
          <tr>
            <td width="100" align="right"><b><?=$lang["account_login_password"]?>:</b>&nbsp;&nbsp;</td>
            <td><input type="password" name="password" id="password1" tabindex="2" style="width: 150px;" /></td>
            <td><a href="<?=$links["FORGOT_PASSWORD"]?>" class="blink_small"  tabindex="5"><?=$lang["account_login_forgot_password"]?></a></td>
          </tr>
          <tr>
            <td colspan="3" height="35"></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["account_login_submit"]?>" class="registration_text" tabindex="3" /></td>
            <td></td>
          </tr>
        </table>
		<input type="hidden" name="code" value="<?=form_key_create("ACCOUNT_LOGIN")?>" />
		</form>
        </div>
      </div>
	</div>
    
	<div class="my_account_login_right">
    	<br /><br /><br /><br />
    	<a href="<?=$links["REGISTRATION"]?>"><img src="img/<?=$global_lang?>/btn_register.jpg" alt="<?=$lang["account_login_save_button_register"]?>" width="316" height="36" border="0" /></a>
        <br /><br />
	</div>
    
    <div style="clear: both"></div>
	
	<img src="img/<?=$global_lang?>/px.gif" width="1" height="10" alt="<?=$alt["px"]?>" />