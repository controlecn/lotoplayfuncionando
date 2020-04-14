<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
include('functions_imap.php');

gui_header("Novo Ticket", "../");

?>
<script src="../js/jquery-1.2.3.min.js"></script>
<script src="../js/jquery.suggest.js"></script>
<link href="../css/jquery.suggest.css" rel="stylesheet" type="text/css" />
<script>

jQuery(function() {
jQuery("#selectusername").suggest("../autocomplete_users.php",{
onSelect: function() {}});
});

function carregarTemplate() {

	template_id = document.getElementById("template_id").value;
	
	if (template_id!=0) {
		
		var xhr; 
		try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }

		catch (e) 
		{
			try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
			catch (e2) 
			{
			  try {  xhr = new XMLHttpRequest();     }
			  catch (e3) {  xhr = false;   }
			}
		 }
		 
		xhr.onreadystatechange  = function()
		{ 
			 if ((xhr.readyState  == 4) && (xhr.status  == 200)) {
				document.getElementById("message").value = xhr.responseText;
			 }
		}; 
		 
	   xhr.open("GET", "get_template.php?id="+template_id,  true); 
	   xhr.send(null); 
	} else {
		alert("Escolhe uma resposta pronta antes de carregar!");
	}

}

</script>
<form method="post" action="tickets_novo_upd.php">
<table width="600"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="23" class="tabletop" width="100">Usuário:</td>
	<td height="23" class="tabletext"><input type="text" name="username" id="selectusername"></td>
</tr>
<tr><td colspan="2" height="10"></td></tr>
<tr>
	<td height="23" class="tabletop" width="100">Assunto:</td>
	<td height="23" class="tabletext"><input type="text" name="subject" size="40"></td>
</tr>
<tr><td colspan="2" height="10"></td></tr>
<tr>
	<td height="23" class="tabletop" width="100">Conta de email:</td>
	<td height="23" class="tabletext"><select name="account_id">
			<?
			
				$result = mysql_query("SELECT * FROM tickets_accounts ORDER BY id", $mysql_link);
				if ($result) {

					while ($row = mysql_fetch_array($result)) {


						$id = $row["id"];
						$from_email = $row["from_email"];
						echo "<option value=\"$id\">$from_email</option>";

					}

				mysql_free_result($result);

				}
			?>
	</select></td>
</tr>
</table><br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#d8e8d2" height="23" class="tabletext"><h2>Conteúdo do ticket:</h2> Carregar resposta pronta: 
		<select id="template_id">
			<option value="0">Escolhe...</option>
			<?
			
				$result = mysql_query("SELECT * FROM tickets_emails WHERE id != 1 ORDER BY nome", $mysql_link);
				if ($result) {

					while ($row = mysql_fetch_array($result)) {


						$id = $row["id"];
						$nome = $row["nome"];
						echo "<option value=\"$id\">$nome</option>";

					}

				mysql_free_result($result);

				}
			?>
		</select>
		<input type="button" name="carregar_resposta_btn" value="Carregar!" onClick="carregarTemplate()">
	<br>

	<textarea name="message" cols="80" rows="10" id="message"></textarea><br>
	<input type="submit" name="submitbutton" value="Enviar!">

	</td>
  </tr>
</table>
<br><br><br>
<? gui_bottom(); ?>