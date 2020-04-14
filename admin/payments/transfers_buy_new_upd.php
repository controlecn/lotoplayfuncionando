<?

include('../include_functions.php');
checkAccess(1);

$userid = GetRow("SELECT id FROM users WHERE username = '".$_POST["username"]."'");

$valueId = addslashes($_POST["valueId"]);
$forma = addslashes($_POST["forma"]);

$moneyValue = GetRow("Select moneyValue from buy_values where id = $valueId");
$creditValue = GetRow("Select value from buy_values where id = $valueId");

if (!$userData["affliateId"]) { $affliateId = 0; } else { $affliateId = $userData["affliateId"]; }

$cents = getCents ($moneyValue, $forma);

$numeroP = sqlQuery("Insert into transfers_buy (userId, bankId,value,cents,affliateId,boughtWhen) values ('$userid',$forma,$moneyValue,$cents,$affliateId,NOW())");
	
Header("Location: transfers_buy_confirm_doc.php?id=$numeroP");

?>