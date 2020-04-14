<?

include('../include_functions.php');
checkAccess(1);

$connection = ssh2_connect('reidobingo-net.umbler.net', 22, array('hostkey'=>'ssh-rsa'));

if (ssh2_auth_pubkey_file($connection, 'root',
                          '/home/eliana/id_rsa.pub',
                          '/home/eliana/id_rsa', 'SENHA')) {
} else {
  die('Public Key Authentication Failed');
}

$stream = ssh2_exec($connection, "nohup /usr/local/bin/python2.5 /home/eliana/xmlserver/bigbang.py &");

sleep(5);

Header("Location: status.php");

?>
