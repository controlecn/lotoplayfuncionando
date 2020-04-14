<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
gui_header("Emails - Contas para tickets - Adicionar", "../");

?>
<form name="updateForm" id="updateForm" method="POST" action="accounts_add_upd.php">
<font class="tabletop">

Servidor:<br>
<input class="tabletext" type="text" name="server" style="width: 360px" value="">
<br><br>

Porta:<br>
<input class="tabletext" type="text" name="port" style="width: 360px" value="">
<br><br>

Usuário:<br>
<input class="tabletext" type="text" name="username" style="width: 360px" value="">
<br><br>

Senha:<br>
<input class="tabletext" type="password" name="password" style="width: 360px" value="">
<br><br>

Email:<br>
<input class="tabletext" type="text" name="from_email" style="width: 360px" value="">
<br><br>

Nome:<br>
<input class="tabletext" type="text" name="from_name" style="width: 360px" value="">
<br><br>

<input type="submit" value="Adicionar" name="submitbutton">

</font>
</form>
<? gui_bottom(); ?>