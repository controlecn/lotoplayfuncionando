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

	SqlQuery("UPDATE transfers_payout SET status = 2, payDate = NOW() WHERE id = $id");

	$transferMonth = date("n");
	$transferYear = date("Y");
	
	$quanto = $quanto / 4;
	
	SqlQuery("Insert into statistics_sales (transfertype, userId,buyDate,amount,bank) VALUES ('2', '$userId', NOW(), '$quanto','0')");

	Header("Location: payout.php");


?>