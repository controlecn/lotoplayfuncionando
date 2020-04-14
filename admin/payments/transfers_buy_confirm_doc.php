<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

$id = $_REQUEST["id"];
$error = $_REQUEST["error"];
$doc = $_REQUEST["doc"];

gui_header("Confirmar a Compra - Pedido $id", "../");

$userid = GetRow("SELECT userId FROM transfers_buy WHERE id = $id");
$username = GetRow("SELECT username FROM users WHERE id = $userid");

$cents = GetRow("SELECT cents FROM transfers_buy WHERE id = $id");
$value = GetRow("SELECT value FROM transfers_buy WHERE id = $id");
$bankId = GetRow("SELECT bankId FROM transfers_buy WHERE id = $id");

if (strlen($cents)==1) {
	$cents = "0$cents";
}

$valor = "$value,$cents";

$bank = GetRow("Select name From buy_paymentforms Where id = $bankId");

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

?>
<script>

function validateForm() {

	error = 0;
	
	<? if ($bankType==1) { ?>
	
	if (document.getElementById("doc").value=="") {
		alert("Por favor, digite o número único da transferencia!")
		error = 1;
	}
	
	<? } ?>
	
	<? if ($bankType==2) { ?>
	
	if (document.getElementById("doc1").value=="") {
		alert("Por favor, digite o número da agencia!")
		error = 1;
	}
	
	if (error==0) {
	
		if (document.getElementById("doc2").value=="") {
			alert("Por favor, digite o número da conta!")
			error = 1;
		}
		
	}
	
	if (error==0) {
	
		if (document.getElementById("doc1").value.length!=4) {
			alert("Número da agencia e um código de 4 números!\nExemplo: 0000")
			error = 1;
		}
		
	}
	
	if (error==0) {
	
		if (document.getElementById("doc2").value.length!=7) {
			alert("Número da conta e um código de 7 números!\nExemplo: 00000-0")
			error = 1;
		}
		
	}
	
	<? } ?>
	
	<? if ($bankType==3) { ?>
	
	if (document.getElementById("doc").value=="") {
		alert("Por favor, digite o número único da transferencia se tiver, se não, deixei 000000!")
		error = 1;
	}
	
	<? } ?>
	
	if (error==0) {
		return confirm('Tem certeza?');
	} else {
		return false;
	}

}

</script>
<?

if ($error==1) {

	echo "<b>ESTE PEDIDO JA FOI LIBERADO!</b><br><br>";

} else if ($error==2) {

	echo "<b>ESTE NÚMERO DE DOCUMENTO JA FOI LIBERADO!</b><br><br>";

}

?>
<b>Por favor verifique os dados:</b><br><br>
<form method="post" action="transfers_buy_confirm.php" onSubmit="return validateForm()">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Nr. Pedido:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><?=$id?></td>
</tr>
<tr>
	<td height="25" bgcolor="#F7F7F7" width="150" class="tabletext"><b>Apelido:</b></td>
	<td height="25" bgcolor="#F7F7F7" class="tabletext"><?=$username?></td>
</tr>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Valor:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext">R$ <?=$valor?></td>
</tr>
<tr>
	<td height="25" bgcolor="#F7F7F7" width="150" class="tabletext"><b>Banco:</b></td>
	<td height="25" bgcolor="#F7F7F7" class="tabletext"><?=$bank?></td>
</tr>
<? if ($bankType==1) { ?>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Nr. Documento:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><input type="text" name="doc" id="doc" value="<?=$doc?>"></td>
</tr>
<? } ?>

<? if ($bankType==2) { ?>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Agencia:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><input type="text" name="doc1" id="doc1"></td>
</tr>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Conta:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><input type="text" name="doc2" id="doc2"></td>
</tr>
<? } ?>

<? if ($bankType==3) { ?>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Nr Documento:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><input type="text" name="doc" id="doc" value="000000"><br><i>Se o número ja aparece, digite. Se não, deixei como esta.</i></td>
</tr>
<? } ?>

<? if ($bankType==4) { ?>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Nr Documento:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><input type="text" name="doc" id="doc" value=""><br><i>Pode deixar vazio... Depois o B. coloca.</i></td>
</tr>
<? } ?>

<? if ($bankType==5) { ?>
<tr>
	<td height="25" bgcolor="#FFFFFF" width="150" class="tabletext"><b>Nr Documento:</b></td>
	<td height="25" bgcolor="#FFFFFF" class="tabletext"><i>Nossa caixa não tem número unico...</i></td>
</tr>
<? } ?>

</table>
<input type="hidden" name="id" value="<?=$id?>"><br><br>
<input type="submit" name="submitbutton" value="Confirmar!">
</form>
<? gui_bottom("../"); ?>