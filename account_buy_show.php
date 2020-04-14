<?

$cmd = $_GET["cmd"];

$show = 0;

if (($cmd=="add")||($cmd=="show")) {

	if ($cmd=="show") {
	
		$id = sql_injection_check($_GET["id"]);
	
		if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE id = '$id' AND userId = '".$user_data["id"]."' AND status = '0'")!=0) {

			$show = 1;
			$numeroP = $id;
			
			$value = GetRow("SELECT value FROM transfers_buy WHERE id = $id");
			$cents = GetRow("SELECT cents FROM transfers_buy WHERE id = $id");
			
			if (strlen($cents)==1) {
				$cents = "0$cents";
			}

			$valor = "$value,$cents";
			
			$points = GetRow("SELECT value FROM setup_vars WHERE name = 'payment_points'") * $value;
			
			$forma = GetRow("SELECT bankId FROM transfers_buy WHERE id = $id");

		}
	
	} else {
	
		$clickandbuy = 0;
	
		if ((form_key_verify("ACCOUNT_BUY", sql_injection_check($_POST["code"])))&&($banned==0)&&(GetRow("SELECT COUNT(id) FROM transfers_buy WHERE userId = '".$user_data["id"]."' AND status = '0'")==0)) {
			
			$valueId = sql_injection_check($_POST["add_payment_value"]);
			$forma = sql_injection_check($_POST["add_payment_form"]);
		
			$moneyValue = GetRow("SELECT moneyValue FROM buy_values WHERE id = $valueId");
			$creditValue = GetRow("SELECT value FROM buy_values WHERE id = $valueId");
			$points = GetRow("SELECT value FROM setup_vars WHERE name = 'payment_points'") * $moneyValue;
			
			$affliate_id = 0;
				
			if ($user_data["affliateId"]) {
				$affliate_id = $user_data["affliateId"];
			}

			
			if ($forma=="clickandbuy") {
			
				$clickandbuy = 1;
			
			} else {
			
				$show = 1;
			
				$cents = getCents ($moneyValue, $forma);

				$numeroP = sqlQuery("INSERT INTO transfers_buy (userId,bankId,value,cents,affliateId,boughtWhen) VALUES ('".$user_data["id"]."','$forma','$moneyValue','$cents','$affliate_id',NOW())");
				
				$valor = formatMoney($moneyValue);

				$paymentformname = GetRow("SELECT name FROM buy_paymentforms WHERE id = $forma");

				if (strlen($cents)==1) {
					$cents = "0$cents";
				}

				$valor = "$moneyValue,$cents";
					
			}
				

		} else {
		
			if ($banned==1) {
			
				showContent("ERROR_404");
			
			}
		
		}
	
	}


}

if ($show==1) { ?>
	<h1><?=$lang["account_buy_title"]?></h1>
	<br />
	<h3><?=$lang["account_buy_id"]?>: <?=$numeroP?></h3>
	<br />
	<table width="620" border="0" cellspacing="0" cellpadding="0" style="border: 2px #000000 solid;">
		<tr>
			<td style="padding: 10px" height="50"><i><b><?=$lang["account_buy_pagpro_text"]?></b></i></td>
			<td style="padding: 10px" height="50" align="right"><img src="img/<?=$global_lang?>/banktransfer.jpg" border="0" alt="<?=$alt["account_buy_banktransfer"]?>" /></td>
		</tr>
		<tr>
			<td height="1" bgcolor="#000000" colspan="2"></td>
		</tr>
		<tr>
			<td style="padding: 10px" colspan="2">
				<h3><?=$lang["account_buy_pagpro_instructions"]?>:</h3>
				<br />
				<?=str_replace("<br>", "<br />", GetRow("SELECT information FROM buy_paymentforms WHERE id = '$forma'"))?>
				<br /><br />
				<h3><?=$lang["account_buy_value"]?>: <?=$lang["currency_1"]?><?=$valor?><?=$lang["currency_2"]?></h3>
				<br />
				<a class="blink" href="<?=GetRow("SELECT onlinebankurl FROM buy_paymentforms WHERE id = '$forma'")?>" target="_blank"><?=GetRow("SELECT onlinebanktext FROM buy_paymentforms WHERE id = '$forma'")?></a>
			</td>
		</tr>
	</table>
	<br />
	<?=str_replace("%%POINTS%%", $points, $lang["account_buy_points"])?>
<? } else if ($clickandbuy==1) { ?>
<h1><?=$lang["account_buy_title"]?></h1>
<? showContent("BUY_CLICKANDBUY"); ?>
<?

if ($user_data["id"]==1) {

	// Generate a ClickandBuy purchase URL for online gaming and gambling purchase
	function gaming ($transfer_id, $value, $name, $surname, $address, $city, $zip) {
		// Configurable Variables
		$plink	 	= 'https://eu.clickandbuy.com/newauth/http://premium-6ejrs98t908ke1.eu.clickandbuy.com/clickandbuy_check.php';	// ClickandBuy Transaction URL
		$dynkey		= '6ceaaab98e18e37d9bcd42389f3d80d0';	// MD5 Encryption key

		// Defined purchase variables
		$price 		= $value . "00";
		$cb_currency	= 'BRL';
		$cb_content_name = urlencode('Compra de creditos. Pedido nr. ' . $transfer_id);
		$cb_content_info= urlencode('Por favor confirme o seu cartao de credito aqui em baixo');

		// Billing Datashare for fraud screening
		// NOTE: these parameters cannot be passed empty else payment will be prevented
		$cb_billing_FirstName	= urlencode($name);
		$cb_billing_LastName	= urlencode($surname);
		$cb_billing_Street	= urlencode($address);
		$cb_billing_City	= urlencode($city);
		$cb_billing_ZIP		= urlencode($zip);
		$cb_billing_Nation	= urlencode('BR');
		
		// Create ClickandBuy purchase Querystring
		$querystring	= '?price=' . $price . '&cb_currency=' . $cb_currency . '&externalBDRID=' . $transfer_id . '&cb_content_name_utf=' . $cb_content_name . '&cb_content_info_utf=' . $cb_content_info;
		$querystring	.= '&cb_billing_FirstName=' . $cb_billing_FirstName . '&cb_billing_LastName=' . $cb_billing_LastName . '&cb_billing_Street=' . $cb_billing_Street . '&cb_billing_City=' . $cb_billing_City . '&cb_billing_ZIP=' . $cb_billing_ZIP . '&cb_billing_Nation=' . $cb_billing_Nation;
		$url		= $plink . $querystring;
		
		// Generate MD5 hash to protect ClickandBuy URL
		$fgkey 		= md5($dynkey . "/" . basename($url));
		$purchase_url	= $url . '&fgkey=' . $fgkey;
		
		return $purchase_url;
	}
	
	$numeroP = sqlQuery("INSERT INTO transfers_buy (userId,bankId,value,cents,affliateId,boughtWhen) VALUES ('".$user_data["id"]."','1001','$moneyValue','0','$affliate_id',NOW())");

	$fullname = split($user_data["fullname"], " ");
	$name = $fullname[0];
	$surname = $fullname[1];
	$address = $user_data["address"];
	$city = $user_data["city"];
	$zip = $user_data["zipcode"];

	$purchase_url = gaming($numeroP, $moneyValue, $name, $surname, $address, $city, $zip);
	
	echo "<a href=\"$purchase_url\" class=\"blink\">Pagar com ClickAndBuy, Clique Aqui</a>";


}

// gerar pedido
?>
<? } ?>
<br /><br /><a href="<?=$links["ACCOUNT"]?>" class="blink"><?=$lang["account_back"]?></a>