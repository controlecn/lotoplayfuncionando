<?

$html_title = "account";
$openTab = "account";

include("include_header.php");

if ($logged==0) {

	if (sql_injection_check($_GET["page"])=="confirmchangepassword") {
		$page = "confirmchangepassword";
		$content_page = "confirmchangepassword";
	} else {
		$page = "login";
		$content_page = "login";
	}

} else {

	$page = sql_injection_check($_GET["page"]);

	switch ($page) {
		case "buy":						$content_page = "buy"; break;
		case "buy_show":				$content_page = "buy_show"; break;
		case "payout":					$content_page = "payout"; break;
		case "transfers":				$content_page = "transfers"; break;
		case "messages":				$content_page = "messages"; break;
		case "results":					$content_page = "results"; break;
		case "points":					$content_page = "points"; break;
		case "friends":					$content_page = "friends"; break;
		case "changepassword":			$content_page = "changepassword"; break;
		case "confirmchangepassword":	$content_page = "confirmchangepassword"; break;
		case "change":					$content_page = "change"; break;
		default: 						$content_page = "main"; break;
	}

}

include("account_$content_page.php");

include("include_bottom.php"); ?>