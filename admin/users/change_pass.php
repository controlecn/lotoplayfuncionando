<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Alterar Senha", "../");

$id = $_GET["id"];
$error = $_GET["error"];

?>

<script>
function verify_passform() {

	var success = true;

	var value_password1 = document.getElementById("pass1").value;
	var value_password2 = document.getElementById("pass2").value;
	
	// Password 1
	if (success===true) {

		if (value_password1.length<5) {
			alert("Senha tem que ter no minimo 5 letras");
			document.getElementById("pass1").focus();
			success = false;
		}

	}
	
	// Password 2
	if (success===true) {

		if (value_password1!=value_password2) {
			alert("Sua senha nao confirma");
			document.getElementById("pass2").focus();
			success = false;
		}

	}
	
	return success;

}

</script>

<form name="updateForm" id="updateForm" method="POST" action="change_pass_update.php" onSubmit="return verify_passform();">

<font style="font-size: 20px">ATENÇÃO! NÃO MUDE A SENHA PARA QUALQUER USUÁRIO. SE ELE TIVER CRÉDITOS, BÔNUS OU PONTOS, VOCÊ TEM QUE PERGUNTAR NOME, EMAIL E/OU CPF PARA CONFIRMAR QUE E O CLIENTE CERTO!</font>
<br><br>
<font class="tabletop">

Nova senha:<br>
<input class="tabletext" type="password" id="pass1" name="pass1" value="" style="width: 150px">
<br><br>

Conirme a nova senha:<br>
<input class="tabletext" type="password" id="pass2" name="pass2" value="" style="width: 150px">
<br><br>

<input type="hidden" value="<?=$id?>" name="id">

<input type="submit" value="Atualizar!" name="submitbutton">

</font>
</form>

<? gui_bottom(); ?>