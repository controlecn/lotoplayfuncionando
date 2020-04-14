<?php

error_reporting(E_ALL);

include("include_settings.php");

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

// Server Variables
$custRef 	= mysql_real_escape_string($_SERVER['HTTP_X_USERID']);
$price 		= mysql_real_escape_string($_SERVER['HTTP_X_PRICE']);
$BDRID	 	= mysql_real_escape_string($_SERVER['HTTP_X_TRANSACTION']);
$currency 	= mysql_real_escape_string($_SERVER['HTTP_X_CURRENCY']);
$userIP 	= mysql_real_escape_string($_SERVER['HTTP_X_USERIP']);
$linkID		= mysql_real_escape_string($_SERVER['HTTP_X_CONTENTID']);
$proxyIP 	= $_SERVER['REMOTE_ADDR'];

// GET Variables
$externalBDRID 	= mysql_real_escape_string($_GET['externalBDRID']);

// Configuable variable
// NOTE: this must be the absolute URL of the transaction_return.php script hosted on your webserver

// Defined Variables
$successString 	= 'success';
$reason 	= 'ok';
$price 		= $price / 1000;
$status		= 'new';

// Check UserID
if(empty($custRef) || is_nan($custRef))
	{
	$successString = 'error';
	$reason = "01";
	}
	
// Check Proxy IP
if(substr($proxyIP,0,11) != '217.22.128.')
	{
	$successString = 'error';
	$reason = '02';
	}

// Check price
if($price == 0) 
	{
	$successString = 'error';
	$reason = '03';
	}
	
// Check ClickandBuy Transaction ID
if($BDRID == 0) 
	{
	$successString = 'error';
	$reason = '04';
	}
	
// Check merchant externalBDRID
if(empty($externalBDRID)) 
	{
	$successString = 'error';
	$reason = '05';
	}

// Check if externalBDRID already exists in transfers_buy
if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE id = '$externalBDRID'")!=0) {

	if ($successString=="success") {
	
		$id = $externalBDRID;
		
		$userid = GetRow("SELECT userId FROM transfers_buy WHERE id = $id");
		$username = GetRow("SELECT username FROM users WHERE id = $userid");
		
		$sql1 = "SELECT * FROM transfers_buy WHERE id = $id";

		$result = mysql_query($sql1, $mysql_link);

		if ($result) {

			$row = mysql_fetch_array($result);
			$userId = $row["userId"];
			$bankId = $row["bankId"];
			$moneyValue = $row["value"];
			$cents = $row["cents"];
			$affliateId = $row["affliateId"];

			mysql_free_result($result);

		}

		SqlQuery("UPDATE transfers_buy SET status = 1, boughtWhen = NOW(), doc = '$BDRID' WHERE id = $id");

		$amigoId = GetRow("SELECT friendId FROM users WHERE id = $userId");
		$username = GetRow("SELECT username FROM users WHERE id = $userId");
		$bank = "ClickAndBuy";

		$value = GetRow("Select value from buy_values where moneyValue = '$moneyValue'");

		SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,boughtid) values ('$userId', now(), '$value', '2', '$bank', '$affliateId', '0', '1','$id')");

		if (GetRow("SELECT `test` FROM users WHERE id = $userId")==0) {
			SqlQuery("Insert into statistics_sales (transfertype, userId,buyDate,amount,bank,doc,boughtid) VALUES ('1', '$userId', NOW(), '$moneyValue','$bankId', '$doc', '$id')");
		}
		
		/*** Give Points ***/
		
		$payment_points = getSetupVar("payment_points");
		$new_points = $moneyValue * $payment_points;
		$already_points = GetRow("SELECT points FROM users WHERE id = '$userId'");
		$total_points = $already_points + $new_points;
		SqlQuery("UPDATE users SET points = '$total_points' WHERE id = '$userId'");
		SqlQuery("INSERT INTO points_transfers (userid, transfertype, transferdate, points, description) VALUES ('$userId', '1', NOW(), '$new_points', 'Compra de cr�ditos: R$ $moneyValue,00')");		

		/*** Pay the affliates ***/

		if ($affliateId!=0) {

			$affliatePercent = "0.".getSetupVar("payment_forAffliates");
			$affliateValue = $moneyValue * $affliatePercent;

			SqlQuery("INSERT INTO transfers_affliates (affliateId, userId, information, totalValue, affliateValue, buyMonth, buyYear, buyDate) VALUES ('$affliateId', '$userId', '$bank', '$moneyValue', '$affliateValue', '".date("n")."', '".date("Y")."', now())");

		}

		/*** CALCULATE BONUS ***/

		$givenBonus = $value * (GetRow("SELECT bonus FROM buy_values WHERE moneyValue = '$moneyValue'")/100);
		SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,boughtid) values ('$userId', now(), '$givenBonus', '2', 'Bonus: $givenBonus', '1', '0', '1','$id')");
		
		/*** Pay the client ***/
		
		payClient($userId, $value, $givenBonus);

		/*** CALCULATE FRIENDS ***/
		
		$friend_id = GetRow("SELECT friendId FROM users WHERE id = '$userId'");
		
		if ($friend_id!=0) {
		
			$qt_compras = GetRow("SELECT COUNT(id) FROM statistics_sales WHERE transfertype = '1' AND userId = '$userId'");
			
			if ($qt_compras==1) {
			
				SqlQuery("UPDATE users_friends SET percentage = '50' WHERE id = '$friend_id'");
			
			} else if ($qt_compras==2) {
			
				SqlQuery("UPDATE users_friends SET percentage = '75' WHERE id = '$friend_id'");
			
			} else if ($qt_compras==3) {
			
				/*** He made it to 100% ***/
				
				SqlQuery("UPDATE users_friends SET percentage = '100' WHERE id = '$friend_id'");
				
				/*** Pagamento 1 ***/
				
				$friend_value_1 = getSetupVar("friend_friend1");
				$friend_id_1 = GetRow("SELECT userId FROM users_friends WHERE id = '$friend_id'");
				payClient($friend_id_1, 0, $friend_value_1);
				SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy) values ('$friend_id_1', NOW(), '$friend_value_1', '2', '$lang_sqltransfers_friends_buy1', '0', '1', '0')");
				
				/*** Pagamento 2 ***/
				
				$has_friend_2 = GetRow("SELECT friendId FROM users WHERE id = '$friend_id_1'");
				
				if ($has_friend_2!=0) {
				
					$friend_value_2 = getSetupVar("friend_friend2");
					$friend_id_2 = GetRow("SELECT userId FROM users_friends WHERE id = '$has_friend_2'");
					payClient($friend_id_2, 0, $friend_value_2);
					SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy) values ('$friend_id_2', NOW(), '$friend_value_2', '2', '$lang_sqltransfers_friends_buy2', '0', '1', '0')");
					
					/*** Pagamento 3 ***/

					$has_friend_3 = GetRow("SELECT friendId FROM users WHERE id = '$friend_id_2'");
					
					if ($has_friend_3!=0) {
					
						$friend_value_3 = getSetupVar("friend_friend3");
						$friend_id_3 = GetRow("SELECT userId FROM users_friends WHERE id = '$has_friend_3'");
						payClient($friend_id_3, 0, $friend_value_3);
						SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy) values ('$friend_id_3', NOW(), '$friend_value_3', '2', '$lang_sqltransfers_friends_buy3', '0', '1', '0')");

					}
					
				}

			}
		
		}

	}
	
}

header('Location: http://www.reidobingo-net.umbler.net/lotoplay/clickandbuy_return.php?result=' . $successString . '&externalBDRID=' . $externalBDRID . '&info=' . $reason);

?>