<?

$cmd = sql_injection_check($_GET["cmd"]);
$id = sql_injection_check($_GET["id"]);

if ($cmd=="cancel") {

	if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE status = '0' AND userId = '".$user_data["id"]."' AND id = '$id'")!=0) {
		SqlQuery("UPDATE transfers_buy SET status = '2' WHERE id = '$id'");
	}

}

?><h1><?=$lang["account_buy_title"]?></h1>

<? showContent("BUY_CREDITS_MAIN") ?>

<?

/*** Active credit buys ***/

if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE status = 0 AND userId = '".$user_data["id"]."'")!=0) {

	echo "<br /><b>".$lang["account_buy_active_title"].":</b>";
	
	?>
	<table width="520" border="0" cellspacing="0" cellpadding="3" style="border: 1px #888888 solid">
	<?

	$result = mysql_query("SELECT * FROM transfers_buy WHERE status = 0 AND userId = '".$user_data["id"]."'", $mysql_link);

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

			$id = $row["id"];
			$value = $row["value"];
			$cents = $row["cents"];
			$bankId = $row["bankId"];
			$data = changeMysqlTime($row["boughtWhen"]);
			
			if (strlen($cents)==1) {
				$cents = "0$cents";
			}

			$valor = "$value,$cents";
		
			$bank = GetRow("SELECT name FROM buy_paymentforms WHERE id = $bankId");

			?>
			<tr>
				<td bgcolor="<?=$color?>"><?=$id?></td>
				<td bgcolor="<?=$color?>"><?=$bank?></td>
				<td bgcolor="<?=$color?>"><?=$lang["currency_1"]?><?=$valor?><?=$lang["currency_2"]?></td>
				<td bgcolor="<?=$color?>" align="right"><a href="<?=$links["ACCOUNT_BUY_SHOW"]?><?=$qr?>cmd=show&id=<?=$id?>" class="blink_small">Mostrar</a> - <a href="<?=$links["ACCOUNT_BUY"]?><?=$qr?>cmd=cancel&id=<?=$id?>" class="blink_small">Cancelar</a>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<?

		}

		mysql_free_result($result);

	}

	?>
	</table>
	<?

}


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

?>

<br /><br />
<? if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE status = 0 AND userId = '".$user_data["id"]."'")==0) { ?>
<form method="post" action="<?=$links["ACCOUNT_BUY_SHOW"]?><?=$qr?>cmd=add" onsubmit="return verify_form_buy();">
<b><?=$lang["account_buy_selectvalue"]?>:</b>
<select name="add_payment_value" id="add_payment_value" class="registration_text">
<option value="0" selected="selected"><?=$lang["account_buy_selectvalue_selectbox"]?></option>
<?

	$sql = "SELECT * FROM buy_values";
	$result = mysql_query($sql,$mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$value = $row["value"];
			$name = $row["name"];

			echo "<option value=\"$id\">$name</option>";

		}

	mysql_free_result($result);

	}

?>
</select>
<br /><br />
<b><?=$lang["account_buy_selectform"]?>:</b>
<select name="add_payment_form" id="add_payment_form" class="registration_text">
<option value="0" selected="selected"><?=$lang["account_buy_selectform_selectbox"]?></option>
<?

	$sql = "SELECT * FROM buy_paymentforms WHERE disabled = '0'";
	$result = mysql_query($sql, $mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {

			$id = $row["id"];
			$name = $row["name"];

			echo "<option value=\"$id\">$name</option>";

		}

	mysql_free_result($result);

	}

	
	
?>
<option value="clickandbuy"><?=$lang["account_buy_clickandbuy"]?></option>
</select>
<br /><br />

<input type="submit" name="submitbutton" id="submitbutton" value="<?=$lang["account_buy_submit"]?>" class="registration_text" /><br />
<input type="hidden" name="code" value="<?=form_key_create("ACCOUNT_BUY")?>" />
</form>

<br /><br /><a href="<?=$links["SUPPORT_CONTACTUS"]?>" class="blink_small"><?=$lang["account_buy_notlisted"]?></a>
<? } ?>


<br /><br /><a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_back"]?></a>