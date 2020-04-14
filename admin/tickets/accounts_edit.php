<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Emails - Contas para tickets - Editar", "../");

$id = $_REQUEST["id"];

$sql = "SELECT * FROM tickets_accounts WHERE id = $id";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);
    
	$server = $row["server"];
	$port = $row["port"];
	$username = $row["username"];
	$password = $row["password"];
	$from_email = $row["from_email"];
	$from_name = $row["from_name"];

	mysql_free_result($result);

}

?>
<form name="updateForm" id="updateForm" method="POST" action="accounts_edit_upd.php">
<font class="tabletop">

Servidor:<br>
<input class="tabletext" type="text" name="server" style="width: 360px" value="<?=$server?>">
<br><br>

Porta:<br>
<input class="tabletext" type="text" name="port" style="width: 360px" value="<?=$port?>">
<br><br>

Usuário:<br>
<input class="tabletext" type="text" name="username" style="width: 360px" value="<?=$username?>">
<br><br>

Senha:<br>
<input class="tabletext" type="password" name="password" style="width: 360px" value="<?=$password?>">
<br><br>

Email:<br>
<input class="tabletext" type="text" name="from_email" style="width: 360px" value="<?=$from_email?>">
<br><br>

Nome:<br>
<input class="tabletext" type="text" name="from_name" style="width: 360px" value="<?=$from_name?>">
<br><br>

<input type="submit" value="Editar" name="submitbutton">

</font>
<input type="hidden" name="id" value="<?=$id?>">
</form>
<? gui_bottom(); ?>