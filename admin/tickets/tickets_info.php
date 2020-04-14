<?

include('../include_functions.php');
checkAccess(2);
include('../include_guifunctions.php');
include('functions_imap.php');

$ticket_id = $_GET["id"];

$sql = "SELECT * FROM tickets WHERE id = $ticket_id";

$result = mysql_query($sql, $mysql_link);

if ($result) {

	$row = mysql_fetch_array($result);
    
	$account_id = $row["account_id"];
	$subject = $row["subject"];
	$status = $row["status"];
	$userid = $row["userid"];
	$email = $row["email"];
	$ticket_type = $row["ticket_type"];
	$ticket_date = changeMysqlTime($row["ticket_date"]);

	mysql_free_result($result);

}

$account_email = GetRow("SELECT from_email FROM tickets_accounts WHERE id = $account_id");

if ($userid==0) {
	$apelido = $email;
} else {
	$apelido = "<a href=\"../users/user_info.php?id=$userid\" class=\"link\">".GetRow("SELECT username FROM users WHERE id = $userid")."</a>";
}

if ($status==1) {
	$estado = "ABERTO";
} else {
	$estado = "FECHADO";
}

gui_header("Tickets Abertos - $subject", "../");

if ($userid==0) {

	$answer_start = GetRow("SELECT email FROM tickets_emails WHERE nome = 'INICIO_M'");
	$answer_end = GetRow("SELECT email FROM tickets_emails WHERE nome = 'FINAL'");
	
} else {

	$sex = GetRow("SELECT sex FROM users WHERE id = '$userid'");
	
	if ($sex==1) {
		$sex_type = "M";
	} else {
		$sex_type = "F";
	}
	
	$fullname = GetRow("SELECT fullname FROM users WHERE id = '$userid'");
	$fullname = substr($fullname, 0, strpos($fullname, " "));

	$answer_start = GetRow("SELECT email FROM tickets_emails WHERE nome = 'INICIO_$sex_type'");
	$answer_end = GetRow("SELECT email FROM tickets_emails WHERE nome = 'FINAL'");
	
	$answer_start = str_replace("%%NOME%%", $fullname, $answer_start);

}

$answer_padrao = $answer_start . "

TEXTO

" . $answer_end;

?>
<script>

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
			
				var client_name = "<?=$fullname?>";
				var ready_response = String(xhr.responseText);
				
				ready_response = ready_response.replace("%%NOME%%", client_name);
			
				var textarea = document.getElementById("message");
				
				var len = textarea.value.length;
				var start = textarea.selectionStart;
				var end = textarea.selectionEnd;
				var sel = textarea.value.substring(start, end);

				var replace = ready_response;

				textarea.value = textarea.value.substring(0,start) + replace + textarea.value.substring(end,len);
				
				//document.getElementById("message").value = xhr.responseText;
			 }
		}; 
		 
	   xhr.open("GET", "get_template.php?id="+template_id,  true); 
	   xhr.send(null); 
	} else {
		alert("Escolhe uma resposta pronta antes de carregar!");
	}

}

</script>
<table width="400"  border="0" cellspacing="0" cellpadding="0">
<tr>
	<td height="23" bgcolor="#FFFFFF" class="tabletop" width="100">Estado:</td>
	<td height="23" bgcolor="#FFFFFF" class="tabletext"><?=$estado?></td>
</tr>
<tr>
	<td height="23" bgcolor="#F7F7F7" class="tabletop" width="100">Assunto:</td>
	<td height="23" bgcolor="#F7F7F7" class="tabletext"><?=$subject?></td>
</tr>
<tr>
	<td height="23" bgcolor="#FFFFFF" class="tabletop" width="100">Apelido / Email:</td>
	<td height="23" bgcolor="#FFFFFF" class="tabletext"><?=$apelido?></td>
</tr>
<tr>
	<td height="23" bgcolor="#F7F7F7" class="tabletop" width="100">Data / Hora:</td>
	<td height="23" bgcolor="#F7F7F7" class="tabletext"><?=$ticket_date?></td>
</tr>
<tr>
	<td height="23" bgcolor="#FFFFFF" class="tabletop" width="100">Recebido por:</td>
	<td height="23" bgcolor="#FFFFFF" class="tabletext"><?=$account_email?></td>
</tr>
<? if ($access==2) { ?>
<tr>
	<td height="23" bgcolor="#F7F7F7" class="tabletop" width="100">Operação:</td>
	<td height="23" bgcolor="#F7F7F7" class="tabletext"><a href="tickets_close.php?id=<?=$ticket_id?>"><img src="../images/icons/check.gif" alt="Fechar" border="0"></a><a href="tickets_delete.php?id=<?=$ticket_id?>"><img src="../images/icons/delete.gif" alt="SPAM" border="0"></a></td>
</tr>
<? } ?>
</table><br><br>
<!--- content --->
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
<?

$result = mysql_query("SELECT * FROM tickets_contents WHERE ticket_id = $ticket_id ORDER BY id", $mysql_link);

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$id = $row["id"];
		$content_time = $row["content_time"];
		$content_type = $row["content_type"];
		$contents = $row["contents"];
		
		if ($content_type==1) {
			$color = "#c9d5e6";
		} else {
 			$color = "#d8e8d2";
		}

		$attachText = getAttachText($id);

		?>
  <tr>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$contents?></td>
  </tr>
	<? if ($attachText!="") { ?>
  <tr>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$attachText?></td>
  </tr><? } ?>
  <tr>
	<td height="23"></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

?>
</table>
<br><br>
<table width="100%"  border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td bgcolor="#d8e8d2" height="23" class="tabletext"><h2>Nossa resposta:</h2> Carregar resposta pronta: 
		<select id="template_id">
			<option value="0">Escolhe...</option>
			<?
			
				$result = mysql_query("SELECT * FROM tickets_emails WHERE id > 3 ORDER BY nome", $mysql_link);
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
		<form method="post" action="tickets_confirm.php">
			<textarea name="message" cols="94" rows="20" id="message"><?=$answer_padrao?></textarea><br>
			<input type="submit" name="submitbutton" value="Enviar!">
			<input type="hidden" name="ticket_id" value="<?=$ticket_id?>">
			<input type="hidden" name="subject" value="Re: <?=$subject?>">
			<input type="hidden" name="message_to" value="<?=$email?>">
			<input type="hidden" name="account_id" value="<?=$account_id?>">
		</form>
	</td>
  </tr>
</table>
<br><br><br>
<? gui_bottom(); ?>