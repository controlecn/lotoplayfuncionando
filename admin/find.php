<?

include('include_functions.php');
checkAccess(1);

$find = trim($_POST["find"]);

if (is_numeric($find)) {
	// Pedido
	Header("Location: payments/transfers_buy_find.php?number=$find");
} else {

	Header("Location: users/user_info.php?fromForm=1&username=$find");

}

?>