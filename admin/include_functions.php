<?

ini_set('expose_php', 0);
error_reporting(E_ALL ^ E_NOTICE);

$config["mysql_host"] = "mysql873.umbler.com";
$config["mysql_user"] = "luckpriz";
$config["mysql_pass"] = "190290ff";
$config["mysql_data"] = "luckprize";
$config["server_port"] = "";
$config["static_url"] = "http://reidobingo-net.umbler.net/";
$config["support_url"] = $config["static_url"] . "support/request.php?l=lotop&x=1&deptid=1";

$mysql_link = mysql_connect($config["mysql_host"], $config["mysql_user"], $config["mysql_pass"]);
mysql_select_db($config["mysql_data"], $mysql_link);

mysql_query("SET NAMES 'utf8'", $mysql_link);

include(dirname(__FILE__)."/../include_functions.php");
include(dirname(__FILE__)."/../include_class_phpmailer.php");
include(dirname(__FILE__)."/include_lang_pt_br.php");

$config["color1"] = "#fef4de";
$config["color2"] = "#fbecca";

$lang_system_moneybefore = "R$";
$lang_system_moneyafter = "";
	
$logged_user = $_SERVER["PHP_AUTH_USER"];

if (($logged_user=="kk")||($logged_user=="hh")) {
	$access = 2;
} else {
	$access = 1;
}

$elementCount = 0;

function payClient($user_id, $credits, $bonus) {

	global $config;

	/*** Pay the client ***/
		
	$credits_bonus = getCredits ($user_id);
	$credits_before = $credits_bonus[0];
	$bonus_before = $credits_bonus[1];
		
	$credits_after = $credits_before + $credits;
	$bonus_after = $bonus_before + $bonus;
		
	SqlQuery("UPDATE users SET credits = '$credits_after', bonus = '$bonus_after' WHERE id = '$user_id'");
	
		// Update client
	update_credits($user_id);

}

function getSetupVar($name) {
	return GetRow("SELECT value FROM setup_vars WHERE name = '$name'");
}

function setSetupVar($name, $value) {
	$name = addslashes($name);
	$value = addslashes($value);
	sqlQuery("UPDATE setup_vars SET value = '$value' WHERE name = '$name'");
}

function verifyEmail ($email) {

	$return = 1;

	if(substr_count($email, "@") == 0) { $return = 0; }
	if(substr_count($email, ".") == 0) { $return = 0; }

	return $return;
}

function verifyFloat($inData) {

	$IntValue = floatval($inData);
	$StrValue = strval($IntValue);
	if($StrValue == $inData) {
		$is_good = 1;
	} else {
		$is_good = 0;
	}
	
	if (substr_count($inData, ".")==0) {
		$is_good = 0;
	}

	return $is_good;

}

function verifyNumber($inData) {

	$IntValue = intval($inData);
	$StrValue = strval($IntValue);
	if($StrValue == $inData) {
		$is_good = 1;
	} else {
		$is_good = 0;
	}

	return $is_good;

}

function makeLog($textAction) {
	global $logged_user;
	SqlQuery("INSERT INTO admin_log (username, actionDate, action) VALUES ('$logged_user', NOW(), '$textAction')");
}

function checkAccess($accesso) {

	global $access;

	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show!=1) {
		Header("Location: http://reidobingo-net.umbler.net/admin_mais_complicado/accesso_restrito.htm");
	}

}

function menuItem($name, $url, $accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {

?>
  <tr>
	<td height="26" bgcolor="#dde8f0"><div style="float: left;"><a href="<?=$url?>" class="link" target="mainFrame"><img border="0" src="images/arrows.gif"></a></div><div style="float: left; padding-top: 7px;"><a href="<?=$url?>" class="link" target="mainFrame"><?=$name?></a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_dark.jpg"></td>
  </tr>
<?

	}
}

function menuItem2($name, $url, $accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {
	
?>
  <tr>
	<td height="26" bgcolor="#ecf2f7"><div style="float: left; padding-left:10px;"><a href="<?=$url?>" class="link" target="mainFrame"><img border="0" src="images/arrows.gif"></a></div><div style="float: left; padding-top: 7px;"><a href="<?=$url?>" class="link" target="mainFrame"><?=$name?></a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_light.jpg"></td>
  </tr>
<?

	}
}

function menuItem3($name, $url, $accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {
	
?>
  <tr>
	<td height="26" bgcolor="#dde8f0"><div style="float: left;"><a href="<?=$url?>" class="link"><img border="0" src="images/arrows.gif"></a></div><div style="float: left; padding-top: 7px;"><a href="<?=$url?>" class="link"><?=$name?></a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_dark.jpg"></td>
  </tr>
<?

	}
}

function menuItem4($name, $url, $accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {
	
?>
  <tr>
	<td height="26" bgcolor="#dde8f0"><div style="float: left;"><a href="<?=$url?>" class="link" target="_blank"><img border="0" src="images/arrows.gif"></a></div><div style="float: left; padding-top: 7px;"><a href="<?=$url?>" class="link" target="_blank"><?=$name?></a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_dark.jpg"></td>
  </tr>
<?

	}
}

function menuItem5($name, $url, $accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {
	
?>
  <tr>
	<td height="26" bgcolor="#ecf2f7"><div style="float: left; padding-left:10px;"><a href="<?=$url?>" class="link" target="_blank"><img border="0" src="images/arrows.gif"></a></div><div style="float: left; padding-top: 7px;"><a href="<?=$url?>" class="link" target="_blank"><?=$name?></a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_light.jpg"></td>
  </tr>
<?

	}
}

function menuItemDropDown($name, $accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {

		global $elementCount;

		$elementCount++;

?>
  <tr>
	<td height="26" bgcolor="#dde8f0"><div style="float: left;"><a href="javascript:changeElement('D<?=$elementCount?>')" class="link"><img src="images/arrows.gif" border="0"></a></div><div style="float: left; padding-top: 7px;"><a href="javascript:changeElement('D<?=$elementCount?>')" class="link" name="l<?=$elementCount?>" id="l<?=$elementCount?>"><?=$name?></a></div></td>
  </tr>
  <tr>
	<td height="1"><img src="images/dotline_dark.jpg"></td>
  </tr>
  <tr>
	<td><div name="D<?=$elementCount?>" id="D<?=$elementCount?>" style="display: none"><table border="0" cellspacing="0" cellpadding="0">
  
<?

	}
}

function menuItemDropDownEnd($accesso) {

	global $access;
	
	$show = 0;
	
	if ($accesso==1) $show = 1;
	if (($accesso==2) && ($access==2)) $show = 1;
	
	if ($show==1) {

		global $elementCount;

	?>
</table></div></td></tr>
	<?
	
	}

}

function leadingZero($number) {

	if (strlen($number)==1) {

		return "0".$number;

	} else {

		return $number;

	}

}

function getFriends ($userId) {

	global $mysql_link;

	$return = "";

	$sql = "SELECT * FROM users_friends Where userId = $userId";

	$result = mysql_query($sql, $mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {
			$id = $row["id"];

			$return = $return . $id . "*";
		}

		mysql_free_result($result);

	}

	return $return;

}

?>