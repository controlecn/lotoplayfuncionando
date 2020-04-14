<?

function update_credits($userId) {

	global $config;

	$fp = fsockopen("reidobingo-net.umbler.net", $config["server_port"], $errno, $errstr, 3);
		
	if ($fp) {
		fputs($fp,"ROOT update_credits $userId\0");
		$rec_credit_info = fread($fp, 2048);		
		fclose($fp);
	}

}

function form_key_create($code) {

	do {
		$seed = generate_password(30);
		$timestamp = date("Ymdhis");
		$ip = $_SERVER['REMOTE_ADDR'];
		$key = md5($seed.$timestamp.$ip);
	} while (GetRow("SELECT COUNT(id) FROM `form_keys` WHERE `key` = '$key' AND `code` = '$code'")!=0);


	SqlQuery("INSERT INTO form_keys (`created`, `code`, `key`) VALUES (NOW(), '$code', '$key')");
	
	return $key;
}

function form_key_verify($code, $key) {

	if (GetRow("SELECT COUNT(id) FROM `form_keys` WHERE `key` = '$key' AND `code` = '$code'")!=0) {
		SqlQuery("DELETE FROM `form_keys` WHERE `key` = '$key' AND `code` = '$code'");
		return true;
	}

	return false;

}

function getCredits($userId) {

	global $mysql_link, $config;
	
	$result = mysql_query("SELECT credits,bonus FROM users WHERE id = '$userId'", $mysql_link);

	if ($result) {
		$row = mysql_fetch_array($result);
		$credits = $row["credits"];
		$bonus = $row["bonus"];
	}

	$returnstuff = array();
	$returnstuff[0] = $credits;
	$returnstuff[1] = $bonus;

	return $returnstuff;

}

function shortString($string, $howshort) {

	if (strlen($string)>$howshort) {
		$string = substr($string, 0, $howshort-3) . "...";
	}

	return $string;
}

function credits2money($credits) {
	$creditvalue = GetRow("SELECT value FROM setup_vars WHERE name = 'server_creditvalue'");
	$credits_money = $credits * $creditvalue;
	return formatMoney($credits_money);
}

function money2credits($money) {
	$creditvalue = GetRow("SELECT value FROM setup_vars WHERE name = 'server_creditvalue'");
	$credits = $money/$creditvalue;
	return $credits;
}

function formatMoney($money) {

	if (substr_count($money, ".")==0) {

		$length = strlen($money);

		switch ($length) {

			case 4:		$return = substr($money,0,1).".".substr($money,1,3).",00";
					break;
	
			case 5:		$return = substr($money,0,2).".".substr($money,2,3).",00";
					break;

			case 6:		$return = substr($money,0,3).".".substr($money,3,3).",00";
					break;

			default:	$return = $money.",00";
					break;
		}

	} else {

		$money = round($money, 2);

		if (substr_count($money, ".")==0) {
			$money = $money . ".00";
		}

		$money = str_replace(".", ",", $money);
		$kommaPos = strpos($money, ",");

		$reals = substr($money, 0, $kommaPos);
		$centsPos = $kommaPos+1;
		$cents = substr($money, $centsPos, strlen($money)-$centsPos);

		/** Prepare reals and add dots **/
	
		$realsLen = strlen($reals);

		switch ($realsLen) {

			case 4:		$reals = substr($reals,0,1).".".substr($reals,1,3);
					break;
	
			case 5:		$reals = substr($reals,0,2).".".substr($reals,2,3);
					break;

			case 6:		$reals = substr($reals,0,3).".".substr($reals,3,3);
					break;

			default:	$reals = $reals;
					break;
		}

		/** Prepare cents and zero if needed **/

		if (strlen($cents)==1) {
			$cents = $cents."0";
		}
	
		$return = $reals.",".$cents;

	}
	
	if ($return==",00") {
		$return = "0,00";
	}

	return $return;

}

function getCents($value, $bankId) {

	for ($a=1;$a<=99;$a++) {
		if (!$return) {
			if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE value = '$value' AND bankId = '$bankId' AND cents = '$a' AND status = '0'")==0) {
				$return = $a;
			}
		}
	}

	return $return;

}

function changeMysqlTime ($mysql_time) {

	// MySQL TimeFormat: 2005-06-12 15:47:49

	$mysql_year = substr($mysql_time, 0, 4);
	$mysql_month = substr($mysql_time, 5, 2);
	$mysql_day = substr($mysql_time, 8, 2);

	$mysql_hours = substr($mysql_time, 11, 2);
	$mysql_minutes = substr($mysql_time, 14, 2);
	$mysql_seconds = substr($mysql_time, 17, 2);

	$return = $mysql_day . "/" . $mysql_month . " " . $mysql_hours . ':' . $mysql_minutes;

	return $return;
}

function Sqlquery($sql) {
	global $mysql_link;
	mysql_query($sql, $mysql_link);
	$id = mysql_insert_id();
	return $id;
}

function GetRow($sql) {
	global $mysql_link;
	$result345 = mysql_query($sql, $mysql_link);
	if ($result345) {
		$row = mysql_fetch_row($result345);
		$return345 = $row[0];
		mysql_free_result($result345);
	}
	return $return345;
}

function showContent($code) {
	echo GetRow("SELECT content FROM content WHERE code = '$code'");
}

function getJackpot($game, $currency) {
	$jackpot = GetRow("SELECT jackpot FROM games WHERE game = '$game'");

	if (($game=="circus")||($game=="cb2009")||($game=="halloween")) {
		$creditvalue = "0.01";
	} else {
		$creditvalue = GetRow("SELECT value FROM setup_vars WHERE name = 'server_creditvalue'");
	}
	
	$jackpot_money = floor($jackpot * $creditvalue);
	return formatMoney($jackpot_money);
}

function getMonth($game, $currency) {
	$day_of_month = (int)date("d");
	$month = GetRow("SELECT SUM($game) FROM `prizecounter` WHERE day <= $day_of_month");
	$creditvalue = GetRow("SELECT value FROM setup_vars WHERE name = 'server_creditvalue'");
	$month_money = floor($month * $creditvalue);
	return formatMoney($month_money);
}

function sql_injection_check($variable) {
	$varibale = strip_tags($variable);
	$variable = str_replace("<", "", $variable);
	$variable = str_replace(">", "", $variable);
	$variable = str_replace("script", "", $variable);
	$variable = str_replace("document", "", $variable);
	$variable = addslashes($variable);
	return $variable;
}

function verify_email($email) {
	$return = 1;
	if(substr_count($email, "@")==0) { $return = 0; }
	if(substr_count($email, ".")==0) { $return = 0; }
	return $return;
}

function verify_cpf($cpf) {

	$return = 1;

	$s="";

	for ($x=1; $x<=strlen($cpf); $x=$x+1) {
		$ch = substr($cpf,$x-1,1);
		if (ord($ch)>=48 && ord($ch)<=57) {
			$s=$s.$ch;
		}
	}
   
	$cpf=$s;

	if (strlen($cpf)!=11) {
		$return = 0;
	} else if ($cpf=="00000000000") {
		$return = 0;
	} else {

		$Numero[1]=intval(substr($cpf,1-1,1));
		$Numero[2]=intval(substr($cpf,2-1,1));
		$Numero[3]=intval(substr($cpf,3-1,1));
		$Numero[4]=intval(substr($cpf,4-1,1));
		$Numero[5]=intval(substr($cpf,5-1,1));
		$Numero[6]=intval(substr($cpf,6-1,1));
		$Numero[7]=intval(substr($cpf,7-1,1));
		$Numero[8]=intval(substr($cpf,8-1,1));
		$Numero[9]=intval(substr($cpf,9-1,1));
		$Numero[10]=intval(substr($cpf,10-1,1));
		$Numero[11]=intval(substr($cpf,11-1,1));

		$soma=10*$Numero[1]+9*$Numero[2]+8*$Numero[3]+7*$Numero[4]+6*$Numero[5]+5*
		$Numero[6]+4*$Numero[7]+3*$Numero[8]+2*$Numero[9];
		$soma=$soma-(11*(intval($soma/11)));

		if ($soma==0 || $soma==1) {
			$resultado1=0;
		} else {
			$resultado1=11-$soma;
		}

		if ($resultado1==$Numero[10]) {

			$soma=$Numero[1]*11+$Numero[2]*10+$Numero[3]*9+$Numero[4]*8+$Numero[5]*7+$Numero[6]*6+$Numero[7]*5+
			$Numero[8]*4+$Numero[9]*3+$Numero[10]*2;
			$soma=$soma-(11*(intval($soma/11)));

			if ($soma==0 || $soma==1) {
				$resultado2=0;
			} else {
				$resultado2=11-$soma;
			}

			if ($resultado2==$Numero[11]) {
				$return = 1;
			} else {
				$return = 0;
			}

    	} else {
			$return = 0;
		}
	}

	return $return;
}

function verify_payout($inData) {

	$IntValue = floatval($inData);
	$StrValue = strval($IntValue);
	
	if($StrValue == $inData) {
		$is_good = 1;
	} else {
		$is_good = 0;
	}

	return $is_good;

}

function checkError($strings) {
	
	global $errors;
		
	if (count($errors)!=0) {
		
		$found = 0;
		$strings = explode(",", $strings);
	
		for ($a=0; $a<count($strings); $a++) {
			
			if (in_array($strings[$a], $errors)) {
				$found = 1;
			}
		
		}

		if ($found==1) {
			echo "error";
		} else {
			echo "text";
		}
			
	} else {
		echo "text";
	}

}

 function birthday($year, $month, $day) {

    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
    elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff;

}

function prepareHTML($message) {
	$message = str_replace("\n", "<br />", $message);
	$message = "<p class=\"email_text\">$message</p>";
	return $message;
}

function send_email($to, $subject, $message, $template = 1) {

	global $global_lang;

	$account_id = 1;

	$mail = new PHPMailer();
	$mail->CharSet = "UTF-8";

	$mail->IsSMTP();
	$mail->Host = "reidobingo-net.umbler.net";
	$mail->Port = 25;
	$mail->SMTPAuth = true;
	$mail->Username = "suporte+criativawebsites.com.br/lotoplay";
	$mail->Password = "49bi13no";

	$mail->From = "suporte@criativawebsites.com.br/lotoplay";
	$mail->FromName = "criativawebsites.com.br/lotoplay";
	$mail->AddAddress($to);

	$mail->WordWrap = 50;
	$mail->IsHTML(true);

	$mail->Subject = $subject;
	
	if ($template==1) {
		$email_header = join("", file("templates/$global_lang/email_support_header.txt"));
		$email_footer = join("", file("templates/$global_lang/email_support_footer.txt"));
	} else {
		$email_header = join("", file("templates/$global_lang/email_marketing_header.txt"));
		$email_footer = join("", file("templates/$global_lang/email_marketing_footer.txt"));
	}
	
	$email_header = str_replace("%%URL%%", $config["static_url"], $email_header);
	
	if ($template==3) {
		$html_message = $message;
	} else {
		$html_message = $email_header . prepareHTML($message) . $email_footer;
	}

	$mail->Body    = $html_message;
	$mail->AltBody = $message;

	$mail->Send();

}

function generate_password($len = 8) {

	$ranges = array	(
		1 => array(97, 122), // a-z (lowercase)
		2 => array(65, 90),  // A-Z (uppercase)
		3 => array(48, 57)  // 0-9 (numeral)
	);

	$passw = "";

	for ($i=0; $i<$len; $i++) {
		$r = mt_rand(1,count($ranges));
		$passw .= chr(mt_rand($ranges[$r][0], $ranges[$r][1]));
	}

	return $passw;
}

?>