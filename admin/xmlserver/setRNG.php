<?

include('../include_functions.php');
checkAccess(1);
$error = 0;

function parse_username($username) {
	
	$username = str_replace(" ", "&special_sp&", $username);
	$username = str_replace("�", "&special_u1&", $username);
	$username = str_replace("�", "&special_u2&", $username);
	$username = str_replace("�", "&special_a1&", $username);
	$username = str_replace("�", "&special_a2&", $username);
	$username = str_replace("�", "&special_a3&", $username);
	$username = str_replace("�", "&special_a4&", $username);
	$username = str_replace("�", "&special_c1&", $username);
	$username = str_replace("�", "&special_e1&", $username);
	$username = str_replace("�", "&special_e2&", $username);
	$username = str_replace("�", "&special_i1&", $username);
	$username = str_replace("�", "&special_o1&", $username);
	$username = str_replace("�", "&special_o2&", $username);
	$username = str_replace("�", "&special_o3&", $username);
	
	return $username;

}

$username = $_REQUEST["username"];
$thermo = $_REQUEST["thermo"];

if (!$username) $error = 1;
if (!$thermo) $error = 1;

if ($error==0) {

	$userid = GetRow("SELECT id FROM users WHERE username = '$username'");
	if ($thermo==1) $cor = "amarelo";
	if ($thermo==2) $cor = "laranja";
	if ($thermo==3) $cor = "vermelho";	
	makeLog("Mudanca de thermometro para $cor. Usuario: $username");

	$fp = fsockopen("reidobingo-net.umbler.net", $config["server_port"], $errno, $errstr, 3);
	fputs($fp,"ROOT update_thermo ".parse_username($username)." $thermo\0");
	$rec_changeinfo = fread($fp, 2048);
	fclose($fp);
	
	echo "OK";
} else {
	echo "NOTOK";
}


?>