<?

	include('../include_functions.php');
	checkAccess(1);

	$id = $_GET["id"];
	
	$userId = GetRow("SELECT userId FROM transfers_buy WHERE id = '$id'");
	$value = GetRow("SELECT value FROM transfers_buy WHERE id = '$id'");
	
	SqlQuery("UPDATE transfers_buy SET status = '2', doc = '' WHERE id = '$id'");
	
	$creditvalue = GetRow("Select value from buy_values where moneyValue = '$value'");
	$givenBonus = $value * (GetRow("SELECT bonus FROM buy_values WHERE moneyValue = '$moneyValue'")/100);
	
	SqlQuery("DELETE FROM transfers WHERE boughtid = '$id'");
	
	// Take out credits

	$credits_bonus = getCredits($userId);
	$credits = $credits_bonus[0];
	$bonus = $credits_bonus[1];
	$credits = $credits - $creditvalue;
	$bonus = $bonus - $givenBonus;
	SqlQuery("UPDATE users SET credits = '$credits', bonus = '0' WHERE id = '$userId'");
	
		// Update client
	update_credits($userId);

	echo "Compra cancelada!";
	
?>