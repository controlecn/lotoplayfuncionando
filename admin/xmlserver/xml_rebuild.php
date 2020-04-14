<?

include('../include_functions.php');
checkAccess(2);

$fp = fsockopen("reidobingo-net.umbler.net", $config["server_port"], $errno, $errstr, 30);
if ($fp) {
	fputs($fp,"ROOT rebuild\0");
	$rec_killinfo = fread($fp, 2048);
	fclose($fp);
}

$rec_killinfo = str_replace("\0", "", $rec_killinfo);
$rec_killinfo = str_replace("\n", "", $rec_killinfo);

echo $rec_killinfo;


?>