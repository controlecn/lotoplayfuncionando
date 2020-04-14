<?

include('../include_functions.php');
checkAccess(2);

$fp = fsockopen("reidobingo-net.umbler.net", $config["server_port"], $errno, $errstr, 30);
if ($fp) {
	fputs($fp,"ROOT kill_server\0");
	$rec_killinfo = fread($fp, 2048);
	fclose($fp);
}

Header("Location: status.php");


?>