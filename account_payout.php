<h1><?=$lang["account_payout_title"]?></h1>

<?

function showError($code) {
	global $lang;	
	echo "<br /><font color=\"#FF0000\">".$lang["account_payout_error_".$code].".</font>";
}

$show_success = 0;
$errors = array();

if ($_GET["cmd"]=="update") {

	if (form_key_verify("ACCOUNT_PAY", sql_injection_check($_POST["code"]))) {

		$howmuch = sql_injection_check($_POST["howmuch"]);
		$bank = sql_injection_check($_POST["bank"]);
		$agent = sql_injection_check($_POST["agent"]);
		$account = sql_injection_check($_POST["account"]);
		$account_type = sql_injection_check($_POST["account_type"]);
		$cpf = sql_injection_check($_POST["cpf"]);
		$zip = sql_injection_check($_POST["zip"]);
		$telephone = sql_injection_check($_POST["telephone"]);

		$value_howmuch = $howmuch;
		$value_bank = $bank;
		$value_agent = $agent;
		$value_account = $account;
		$value_account_type = $account_type;
		$value_cpf = $cpf;
		$value_zip = $zip;
		$value_telephone = $telephone;

		$has_errors = 0;
		
		/*** Validate Value ***/
		
		$howmuch = str_replace(".", "", $howmuch);
		$howmuch = str_replace(",", ".", $howmuch);
		
		if (verify_payout($howmuch)!=1) {
			$has_errors = 1;
			array_push($errors, "howmuch_notvalid");
		} else {
		
			$howmuch_credits = money2credits($howmuch);
			
			if ($credits<$howmuch_credits) {
				$has_errors = 1;
				array_push($errors, "howmuch_notvalid");
			}
		
		}
		
		/*** Validate Bank ***/
		
		if ($bank==0) {
			$has_errors = 1;
			array_push($errors, "bank_select");
		} else {
			
			if (GetRow("SELECT COUNT(id) FROM affliates_banks WHERE number = '$bank'")==0) {
				array_push($errors, "bank_select");
			}
			
		}
		
		/*** Verify Agent ***/
		
		if (strlen($agent)<2) {
			$has_errors = 1;
			array_push($errors, "agent_notvalid");
		}
		
		/*** Verify Account ***/
		
		if (strlen($account)<2) {
			$has_errors = 1;
			array_push($errors, "account_notvalid");
		}
		
		/*** Verify Account Type ***/
		
		if (($account_type!=1)&&($account_type!=2)) {
			$has_errors = 1;
			array_push($errors, "account_type_notvalid");
		}
		
		/*** Verify CPF ***/
		
		if (!$user_data["ssn"]) {
			
			/*** Validate CPF ***/
			$cpf_validate = $cpf;
			$cpf_validate = str_replace(".", "", $cpf_validate);
			$cpf_validate = str_replace("-", "", $cpf_validate);

			if ((strlen($cpf_validate)!=11)||(!is_numeric($cpf_validate))||(verify_cpf($cpf)==0)) {
				$has_errors = 1;
				array_push($errors, "cpf_notvalid");
			}
		
		}
		
		/*** Verify Zipcode ***/
		
		if (!$user_data["zipcode"]) {
			
			$zip_validate = $zip;
			$zip_validate = str_replace("-", "", $zip_validate);

			if ((strlen($zip_validate)!=8)||(!is_numeric($zip_validate))) {
				$has_errors = 1;
				array_push($errors, "zip_notvalid");
			}
		
		}
		
		/*** Verify Telefone ***/
		
		if (!$user_data["telephone"]) {
			
			$telephone_validate = $telephone;
			$telephone_validate = str_replace("(", "", $telephone_validate);
			$telephone_validate = str_replace(")", "", $telephone_validate);
			$telephone_validate = str_replace("-", "", $telephone_validate);
			
			if ((strlen($telephone_validate)!=10)||(!is_numeric($telephone_validate))) {
				$has_errors = 1;
				array_push($errors, "telephone_notvalid");
			}
		
		}
		
		if ($has_errors==0) {
		
			/*** Update user data ***/
			SqlQuery("UPDATE users SET payout_bank = '$bank', payout_agent = '$agent', payout_account = '$account', payout_type = '$account_type' WHERE id = '".$user_data["id"]."'");
			
//			echo "UPDATE users SET 'payout_bank' = '$bank', payout_agent = '$agent', payout_account = '$account', payout_type = '$account_type' WHERE id = '".$user_data["id"]."'";
		
			if (!$user_data["ssn"]) {
				SqlQuery("UPDATE users SET ssn = '$cpf' WHERE id = '".$user_data["id"]."'");
			}
			
			if (!$user_data["zipcode"]) {
				SqlQuery("UPDATE users SET zipcode = '$zip' WHERE id = '".$user_data["id"]."'");
			}
			
			if (!$user_data["telephone"]) {
				SqlQuery("UPDATE users SET telephone = '$telephone' WHERE id = '".$user_data["id"]."'");
			}
		
		
			$show_success = 1;
		
			SqlQuery("Insert into transfers_payout (userId,payDate,payValue,payBank,payAccount,payAgent,payAccountType,status) values ('".$user_data["id"]."',now(),'$howmuch_credits', '$bank','$account','$agent','$account_type', '1')");
			SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,payout) values ('".$user_data["id"]."', now(), '$howmuch_credits', '1', '".$lang["transfers_payout"]."', '0','1')");

			// Zerar o bonus
			SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,payout) values ('".$user_data["id"]."', now(), '$bonus', '1', '".$lang["transfers_bonuszero"]."', '0','1')");

			// Tirar os pontos

			$payment_points = GetRow("SELECT value FROM setup_vars WHERE name = 'payment_points'");
			$creditvalue = GetRow("SELECT value FROM setup_vars WHERE name = 'server_creditvalue'");
			
			$takeout_points = ($howmuch_credits * $creditvalue) * $payment_points;
			
			$already_points = GetRow("SELECT points FROM users WHERE id = '".$user_data["id"]."'");
			$total_points = $already_points - $takeout_points;
			
			if ($total_points<0) {
				$total_points = 0;
			}
			
			SqlQuery("UPDATE users SET points = '$total_points' WHERE id = '".$user_data["id"]."'");
			SqlQuery("INSERT INTO points_transfers (userid, transfertype, transferdate, points, description) VALUES ('".$user_data["id"]."', '2', NOW(), '$takeout_points', '".$lang["transfers_payout_points"]."')");		

			// Zerar saldo,bonus
			$credits_bonus = getCredits($user_data["id"]);
			$credits = $credits_bonus[0];
			$bonus = $credits_bonus[1];
			$credits = $credits - $howmuch_credits;
			SqlQuery("UPDATE users SET credits = '$credits', bonus = '0' WHERE id = '".$user_data["id"]."'");
			
			// Update client
			update_credits($user_data["id"]);
		
		}

	}
	
} else {

	$value_howmuch = credits2money($credits);
	$value_bank = $user_data["payout_bank"];
	$value_agent = $user_data["payout_agent"];
	$value_account = $user_data["payout_account"];
	$value_account_type = $user_data["payout_type"];

}

if (($credits==0)&&($show_success==0)) {

	showContent("PAYOUT_NOCREDITS");
	
	/*** Active Payouts ***/

	if (GetRow("SELECT COUNT(id) FROM transfers_payout WHERE status = '1' AND userId = '".$user_data["id"]."'")!=0) {

		echo "<br /><b>".$lang["account_buy_payment_title"].":</b>";
		
		?>
		<table width="340" border="0" cellspacing="0" cellpadding="3" style="border: 1px #888888 solid">
		<?

		$result = mysql_query("SELECT * FROM transfers_payout WHERE status = '1' AND userId = '".$user_data["id"]."'", $mysql_link);

		if ($result) {

			$i=0;

			while ($row = mysql_fetch_array($result)) {

				if($i%2 == 0) {
					$color = "#F7F7F7";
					$i++;
				} else {
					$color = "#FFFFFF";
					$i++;
				}

				$data = changeMysqlTime($row["payDate"]);
				$valor = credits2money($row["payValue"]);

				?>
				<tr>
					<td bgcolor="<?=$color?>"><?=$data?></td>
					<td bgcolor="<?=$color?>"><?=$lang["currency_1"]?><?=$valor?><?=$lang["currency_2"]?></td>
					<td bgcolor="<?=$color?>" align="right"><? if ($user_data["id"]!=20485) { ?><a href="<?=$links["ACCOUNT_PAYOUT_REVERT"]?><?=$qr2?>id=<?=$row["id"]?>" class="blink_small"><?=$lang["account_buy_payment_revert"]?></a>&nbsp;&nbsp;&nbsp;<? } ?></td>
				</tr>
				<?

			}

			mysql_free_result($result);

		}

		?>
		</table>
		<?

	}

} else {

	if ($show_success==1) {
	
		showContent("PAYOUT_SUCCESS");
	
	} else {

		showContent("PAYOUT");

?>
<form method="post" action="<?=$links["ACCOUNT_PAYOUT"]?><?=$qr?>cmd=update" onsubmit="return verify_form_payout();">
<? if ((!$user_data["ssn"])||(!$user_data["zipcode"])||(!$user_data["telephone"])) { ?>
<script>
jQuery(function($){
   <? if (!$user_data["ssn"]) { ?>$("#cpf").mask("999.999.999-99");<? } ?>
   <? if (!$user_data["zipcode"]) { ?>$("#zip").mask("99999-999");<? } ?>
   <? if (!$user_data["telephone"]) { ?>$("#telephone").mask("(99)9999-9999");<? } ?>
});
</script>
<? } ?>
<?
/*** Active Payouts ***/

if (GetRow("SELECT COUNT(id) FROM transfers_payout WHERE status = '1' AND userId = '".$user_data["id"]."'")!=0) {

	echo "<br /><b>".$lang["account_buy_payment_title"].":</b>";
	
	?>
	<table width="340" border="0" cellspacing="0" cellpadding="3" style="border: 1px #888888 solid">
	<?

	$result = mysql_query("SELECT * FROM transfers_payout WHERE status = '1' AND userId = '".$user_data["id"]."'", $mysql_link);

	if ($result) {

		$i=0;

		while ($row = mysql_fetch_array($result)) {

			if($i%2 == 0) {
				$color = "#F7F7F7";
				$i++;
			} else {
				$color = "#FFFFFF";
				$i++;
			}

			$data = changeMysqlTime($row["payDate"]);
			$valor = credits2money($row["payValue"]);

			?>
			<tr>
				<td bgcolor="<?=$color?>"><?=$data?></td>
				<td bgcolor="<?=$color?>"><?=$lang["currency_1"]?><?=$valor?><?=$lang["currency_2"]?></td>
				<td bgcolor="<?=$color?>" align="right"><a href="<?=$links["ACCOUNT_PAYOUT_REVERT"]?><?=$qr2?>id=<?=$row["id"]?>" class="blink_small"><?=$lang["account_buy_payment_revert"]?></a>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<?

		}

		mysql_free_result($result);

	}

	?>
	</table>
	<?

}

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td align="right" width="170" class="registration_text"><?=$lang["account_payout_credits"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text"><?=$lang["currency_1"]?><?=credits2money($credits)?><?=$lang["currency_2"]?></td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<? if (!$user_data["ssn"]) { ?>
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
	<? } ?>
	<? if (!$user_data["zipcode"]) { ?>
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
	<? } ?>
	<? if (!$user_data["telephone"]) { ?>
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
	<? } ?>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("credits_notvalid")?>"><?=$lang["account_payout_howmuch"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<?=$lang["currency_1"]?><input name="howmuch" type="text" size="8" class="registration_text" maxlength="14" value="<?=$value_howmuch?>" /><?=$lang["currency_2"]?>
			<i><?=$lang["account_payout_howmuch_description"]?></i>
			<?
			
			if (in_array("howmuch_notvalid", $errors)) {
				showError("howmuch_notvalid");
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("bank_select")?>"><?=$lang["account_payout_bank"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<select name="bank" id="bank" class="registration_text">
				<option value="0"><?=$lang["account_payout_bank_select"]?></option>
				<?

				$sql = "SELECT * FROM affliates_banks";
				$result = mysql_query($sql, $mysql_link);

				if ($result) {

					while ($row = mysql_fetch_array($result)) {

						$numero = $row["number"];
						$nome = $row["name"];

						if ($value_bank==$numero) {
							echo "<option value=\"$numero\" selected>$nome</option>";
						} else {
							echo "<option value=\"$numero\">$nome</option>";
						}

					}

					mysql_free_result($result);

				}

				?>
			</select>
			<?
			
			if (in_array("bank_select", $errors)) {
				showError("bank_select");
			}
			
			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("agent_notvalid")?>"><?=$lang["account_payout_agent"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<input name="agent" id="agent" type="text" size="6" class="registration_text" maxlength="14" value="<?=$value_agent?>" />
			<?

			if (in_array("agent_notvalid", $errors)) {
				showError("agent_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_<?checkError("account_notvalid")?>"><?=$lang["account_payout_account"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<input name="account" id="account" type="text" size="8" class="registration_text" maxlength="14" value="<?=$value_account?>" />
			<?

			if (in_array("account_notvalid", $errors)) {
				showError("account_notvalid");
			}

			?>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="10"></td>
	</tr>
	<tr>
		<td valign="top" align="right" width="170" class="registration_text"><?=$lang["account_payout_type"]?>:</td>
		<td width="20">&nbsp;</td>
		<td class="registration_text">
			<input type="radio" name="account_type" id="account_type_1" value="1"<? if ($value_account_type==1) echo " checked"; ?> /><label for="account_type_1"><?=$lang["account_payout_type_checking"]?></label>
			<input type="radio" name="account_type" id="account_type_2" value="2"<? if ($value_account_type==2) echo " checked"; ?> /><label for="account_type_2"><?=$lang["account_payout_type_savings"]?></label>
			<?

			if (in_array("account_type_notvalid", $errors)) {
				showError("account_type_notvalid");
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
		<td><input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["account_payout_submit"]?>" class="registration_text" /></td>
	</tr>
</table>
<input type="hidden" name="code" value="<?=form_key_create("ACCOUNT_PAY")?>" />
</form>
	<?
	}
}
		
	
?>

<br /><br /><a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_transfers_back"]?></a>