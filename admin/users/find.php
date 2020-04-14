<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Procurar cliente", "../");

?>
<form method="post" action="find_upd.php">
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="25" width="150" class="tabletext"><b>Nome:</b></td>
	<td height="25" class="tabletext"><input type="text" name="name" value="" size="60"></td>
</tr>
<tr>
	<td height="15"></td>
</tr>
<tr>
	<td height="25" width="150" class="tabletext"><b>Email:</b></td>
	<td height="25" class="tabletext"><input type="text" name="email" value="" size="60"></td>
</tr>
</table><br><br>
<input type="submit" name="submitbutton" value="Procurar!">
</form>
<? gui_bottom("../"); ?>