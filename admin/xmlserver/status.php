<?

include('../include_functions.php');
include('../include_guifunctions.php');

checkAccess(1);

gui_header("Configuração do Servidor", "../");

$fp = @fsockopen("localhost", $config["server_port"], $errno, $errstr, 10);

if (!$fp) {
	$servidor = 0;
} else {
	$servidor = 1;
	fclose($fp);
}

?>

<font class="tabletop">Estado do servidor: </font>

<b>
<? if ($servidor==0) { ?>
<font color="#FF0000">Desligado</font>
<? } else { ?>
<font color="#339900">Ligado</font>
<? } ?>
</b>
<br><br>

<? if ($servidor==0) { ?>
<form method="POST" action="xml_start.php">
<input type="submit" name="submitbutton" value="Ligar o servidor" class="tabletop">
</form>
<? } else { ?>
<form method="POST" action="xml_stop.php" onSubmit="return confirm('Tem certeza?');">
<input type="submit" name="submitbutton" value="Desligar o servidor" class="tabletop">
</form>
<br><br>
<form method="POST" action="xml_rebuild.php" onSubmit="return confirm('Tem certeza?');">
<input type="submit" name="submitbutton" value="Rebuild" class="tabletop">
</form>

<? } ?>

<? gui_bottom(); ?>