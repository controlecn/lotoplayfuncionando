<?

	include('../include_functions.php');
	checkAccess(1);

	$id = $_POST["id"];
	
	$bankId = GetRow("SELECT bankId FROM transfers_buy WHERE id = $id");
	
	switch ($bankId) {

		case 34:	$bankType = 1;	break; // Banco Do Brasil, HSBC, Unibanco, Banespa: Normal. Número do documento sempre e único.
		case 38:	$bankType = 1;	break; // Banco Do Brasil, HSBC, Unibanco, Banespa: Normal. Número do documento sempre e único.
		case 39:	$bankType = 1;	break; // Banco Do Brasil, HSBC, Unibanco, Banespa: Normal. Número do documento sempre e único.
		case 47:	$bankType = 1;	break; // Banco Do Brasil, HSBC, Unibanco, Banespa: Normal. Número do documento sempre e único.
		case 35:	$bankType = 2;	break; // Itau: Número que aparece sempre e a agencia / conta.
		case 30:	$bankType = 3;	break; // Caixa Economica: Normal, mas sempre demora um poucu para mostrar o número.
		case 45:	$bankType = 4;	break; // Bradesco: Normal, mas tem que ter possibilidade de mudar depois.
		case 42:	$bankType = 5;	break; // Nossa Caixa: Nada unico. Não precisa de referencia unica, ja que tem poucus valores entrando.

	}
	
	$error = 0;
	
	if (GetRow("SELECT status FROM transfers_buy WHERE id = $id")==1) {
		$error = 1;
	}
	
	// Banco Do Brasil, HSBC, Unibanco, Banespa: Normal. Número do documento sempre e único.
	if ($bankType==1) {
	
		$doc = trim($_POST["doc"]);
		
		if ($bankId!=47) {
	
			if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE doc = '$doc'")!=0) {
				$error = 2;
			}
		}
	}
	
	// Itau: Número que aparece sempre e a agencia / conta.
	if ($bankType==2) {
	
		$doc1 = trim($_POST["doc1"]);
		$doc2 = trim($_POST["doc2"]);
	
		$doc = "$doc1.$doc2";
	}
	
	// Caixa Economica: Normal, mas sempre demora um poucu para mostrar o número.
	if ($bankType==3) {
	
		$doc = trim($_POST["doc"]);
		
		if ($doc!="000000") {
		
			if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE doc = '$doc'")!=0) {
				$error = 2;
			}
			
		}
		
	}
	
	// Bradesco: Normal, mas tem que ter possibilidade de mudar depois.
	if ($bankType==4) {
	
		$doc = trim($_POST["doc"]);
		
		if ($doc) {
		
			if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE doc = '$doc'")!=0) {
				$error = 2;
			}
			
		} else {
		
			$doc = "XX";
			
		}
		
	}
	
	// Nossa Caixa: Nada unico. Não precisa de referencia unica, ja que tem poucus valores entrando.
	if ($bankType==5) {
		$doc = "XX";
	}
	
	if ($error==0) {
		
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

		SqlQuery("UPDATE transfers_buy SET status = 1, boughtWhen = NOW(), doc = '$doc' WHERE id = $id");

		$amigoId = GetRow("SELECT friendId FROM users WHERE id = $userId");
		$username = GetRow("SELECT username FROM users WHERE id = $userId");
		$bank = GetRow("Select name From buy_paymentforms Where id = $bankId");

		$value = GetRow("Select value from buy_values where moneyValue = '$moneyValue'");

		SqlQuery("Insert into transfers (userId,transferDate,value,transferType,information,affliateId,bonus,buy,boughtid) values ('$userId', now(), '$value', '2', '$bank', '$affliateId', '0', '1','$id')");

		if (GetRow("SELECT super FROM users WHERE id = $userId")==0) {
			SqlQuery("Insert into statistics_sales (transfertype, userId,buyDate,amount,bank,doc,boughtid) VALUES ('1', '$userId', NOW(), '$moneyValue','$bankId', '$doc', '$id')");
		}
		
		if (strlen($cents)==1) {
			$cents = "0$cents";
		}
		
		makeLog("Compra Liberada. R$ $moneyValue,$cents. Banco: $bank. Usuario: $username");
		
		/*** Give Points ***/
		
		$payment_points = getSetupVar("payment_points");
		$new_points = $moneyValue * $payment_points;
		$already_points = GetRow("SELECT points FROM users WHERE id = '$userId'");
		$total_points = $already_points + $new_points;
		SqlQuery("UPDATE users SET points = '$total_points' WHERE id = '$userId'");
		SqlQuery("INSERT INTO points_transfers (userid, transfertype, transferdate, points, description) VALUES ('$userId', '1', NOW(), '$new_points', 'Compra de créditos: R$ $moneyValue,$cents')");		

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
		

		Header("Location: transfers_buy.php");

	} else {
		Header("Location: transfers_buy_confirm_doc.php?id=$id&error=$error&doc=$doc");
	}
		
?>