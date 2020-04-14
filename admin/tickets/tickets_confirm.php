<?

include('../include_functions.php');
checkAccess(2);
include('functions_imap.php');

$ticket_id = $_POST["ticket_id"];
$message = $_POST["message"];
$subject = $_POST["subject"];
$message_to = $_POST["message_to"];
$account_id = $_POST["account_id"];

include("../../templates/pt_br/email_support_header.txt");

?>
<?=prepareHTML($message)?>
<br><br><br>
<script>

function confirmSend() {
    return confirm('Tem certeza que quer enivar?');
}

function goBack() {
	history.go(-1);
}
</script>
<form method="post" action="tickets_send.php" onSubmit="return confirmSend()">
<input type="hidden" name="ticket_id" value="<?=$ticket_id?>">
<input type="hidden" name="message" value="<?=$message?>">
<input type="hidden" name="subject" value="<?=$subject?>">
<input type="hidden" name="message_to" value="<?=$message_to?>">
<input type="hidden" name="account_id" value="<?=$account_id?>">
<input type="button" name="voltarbutton" value="Voltar" onClick="goBack()">
<input type="submit" name="submitbutton" value="CONFIRMAR E ENVIAR!">
</form>