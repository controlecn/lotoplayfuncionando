<?

include('../include_functions.php');
checkAccess(1);

	$id = $_REQUEST["id"];

	$result = mysql_query("SELECT * FROM transfers_payout WHERE id = $id", $mysql_link);

	if ($result) {

		$row = mysql_fetch_array($result);
		$userId = $row["userId"];
		$sacarDate = $row["payDate"];
		$quanto = $row["payValue"];
		$recebervia1 = $row["payType"];
		$recebervia_banco = $row["payBank"];
		$recebervia_conta = $row["payAccount"];
		$recebervia_agencia = $row["payAgent"];
		$recebervia_contatipo = $row["payAccountType"];

		mysql_free_result($result);


	}

	SqlQuery("UPDATE transfers_payout SET status = 0, payDate = NOW() WHERE id = $id");
	SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,buy) values ('$userId', now(), '$quanto', '2', 'Saque revertido', '0','1')");

	// The user is not logged
		
	$credits_bonus = getCredits ($userId);
	$credits = $credits_bonus[0];
	$bonus = $credits_bonus[1];
		
	$credits = $credits + $quanto;
		
	SqlQuery("UPDATE users SET credits = '$credits' WHERE id = '$userId'");
	
		// Update client
	update_credits($userId);

	Header("Location: payout.php");

?>