<?

include('../include_functions.php');
checkAccess(1);


$username = $_POST["username"];
$userid = GetRow("SELECT id FROM users WHERE username = '$username'");
$transfervalue = $_POST["transfervalue"];
$description = $_POST["description"];
$transfertype2 = $_POST["transfertype2"];

$error = 0;

// Verify username
if (GetRow("SELECT COUNT(id) FROM users WHERE username = '$username'")==0) {
	$error = 1;
}

// Verify valor
if (verifyNumber($transfervalue)==0) {
	$error = 2;
}

if ($error==0) {

	switch ($transfertype2) {

		case "bonus":	$sql = "INSERT INTO transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,game,gameid,bet,prize) VALUES ('$userid', NOW(), '$transfervalue', '2', '$description', '0', '1', '0', '0', '0', '0', '0')";
				break;

		case "buy":	$sql = "INSERT INTO transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,game,gameid,bet,prize) VALUES ('$userid', NOW(), '$transfervalue', '2', '$description', '0', '0', '1', '0', '0', '0', '0')";
				break;

		case "bet":	$sql = "INSERT INTO transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,game,gameid,bet,prize) VALUES ('$userid', NOW(), '$transfervalue', '1', '$description', '0', '0', '0', '0', '0', '1', '0')";
				break;

		case "prize":	$sql = "INSERT INTO transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,game,gameid,bet,prize) VALUES ('$userid', NOW(), '$transfervalue', '2', '$description', '0', '0', '0', '0', '0', '0', '1')";
				break;

	}

	SqlQuery($sql);

	makeLog("Transferencia adicionada. Creditos: $transfervalue. Tipo: $transfertype2. Usuario: $username");

	/*** Pay the client ***/
			
	$credits_bonus = getCredits ($userid);
	$credits = $credits_bonus[0];
	$bonus = $credits_bonus[1];
			
	switch ($transfertype2) {
		case "bonus": $bonus = $bonus + $transfervalue; break;
		case "buy":	$credits = $credits + $transfervalue; break;
		case "prize": $credits = $credits + $transfervalue; break;
		case "bet":
					if ($credits==0) {
						$bonus = $bonus - $transfervalue;
					} else if ($credits<$transfervalue) {
						$bonus = $bonus - ($transfervalue-$credits);
						$credits = 0;
					} else {
						$credits = $credits - $transfervalue;
					}
						
					break;
	}
			
	SqlQuery("UPDATE users SET credits = '$credits', bonus = '$bonus' WHERE id = '$userid'");
		
		// Update client
	update_credits($userid);
		
	Header("Location: transfers.php?update=yes");

} else {

	Header("Location: transfers_add.php?error=$error");

}
?>