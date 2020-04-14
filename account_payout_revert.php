<?

include("include_settings.php");
include("templates/$global_lang/strings.php");

$id = sql_injection_check($_GET["id"]);

if ($user_data["id"]!=20485) {

if (($logged==1)&&(GetRow("SELECT COUNT(id) FROM transfers_payout WHERE id = '$id' AND status = '1' AND userId = '".$user_data["id"]."'")!=0)) {

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

	/*** Give Points 
	
	$creditvalue = GetRow("SELECT value FROM setup_vars WHERE name = 'server_creditvalue'");
	$payment_points = GetRow("SELECT value FROM setup_vars WHERE name = 'payment_points'");
	$new_points = ($quanto * $creditvalue) * $payment_points;
	$already_points = GetRow("SELECT points FROM users WHERE id = '".$user_data["id"]."'");
	$total_points = $already_points + $new_points;
	SqlQuery("UPDATE users SET points = '$total_points' WHERE id = '".$user_data["id"]."'");
	SqlQuery("INSERT INTO points_transfers (userid, transfertype, transferdate, points, description) VALUES ('".$user_data["id"]."', '1', NOW(), '$new_points', '".$lang["transfers_payout_points_revert"]."')");		
	***/
	
	/*** Give credit back ***/
	
	SqlQuery("UPDATE transfers_payout SET status = '0', payDate = NOW() WHERE id = $id");
	SqlQuery("INSERT INTO transfers (userId,transferDate,value,transferType,information,affliateId,buy) VALUES ('".$user_data["id"]."', now(), '$quanto', '2', '".$lang["transfers_payoutrevert"]."', '0','1')");
	
	$credits_bonus = getCredits ($user_data["id"]);
	$credits = $credits_bonus[0];
	$bonus = $credits_bonus[1];
		
	$credits = $credits + $quanto;
		
	SqlQuery("UPDATE users SET credits = '$credits' WHERE id = '".$user_data["id"]."'");
	
		// Update client
	update_credits($user_data["id"]);


}

sleep(2);

}

Header("Location: account.php");

?>