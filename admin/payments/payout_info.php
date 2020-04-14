<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');
gui_header("Informacao de saque", "../", "Symbol Information 2");

?>
<script>
function confirmDelete() {

    var is_confirmed = confirm('<?=$lang_payoutinfo_confirmdelete?>');

    return is_confirmed;

}

function confirmValid() {

    var is_confirmed = confirm('<?=$lang_payoutinfo_confirmvalid?>');

    return is_confirmed;

}
</script>
<?

$id = $_REQUEST["id"];

$sql = "Select * from transfers_payout where id = $id";

$result = mysql_query($sql, $mysql_link);

	$i = 0;

if ($result) {

	$row = mysql_fetch_array($result);
    
	$userId = $row["userId"];
	$sacarDate = $row["payDate"];
	$quanto = $row["payValue"];
	$recebervia_banco = $row["payBank"];
	$recebervia_conta = $row["payAccount"];
	$recebervia_agencia = $row["payAgent"];
	$recebervia_contatipo = $row["payAccountType"];
	$valid = $row["valid"];
	$status = $row["status"];
	$bank = GetRow("Select name From affliates_banks Where number = $recebervia_banco");
	
	$quantoReals = credits2money($row["payValue"]);

	mysql_free_result($result);

}

$sql = "Select * from users where id = $userId";

$result = mysql_query($sql, $mysql_link);

	$i = 0;

if ($result) {

	$row = mysql_fetch_array($result);
    
	$fullname = $row["fullname"];
	$username = $row["username"];
	$password = $row["password"];
	$email = $row["email"];
	$cpf = $row["ssn"];
	$endereco = $row["address"];
	$bairro = $row["citypart"];
	$cep = $row["zipcode"];
	$dia = $row["day"];
	$mes = $row["month"];
	$ano = $row["year"];
	$sexo = $row["sex"];
	$cidade = $row["city"];
	$estado = $row["state"];
	$socioId = $row["affliateId"];
	$amigoId = $row["friendId"];
	$valid = $row["valid"];
	$validCode = $row["validCode"];
	$joinedWhen = $row["joinedWhen"];

	mysql_free_result($result);

}


$allcredits = getCredits($userId);
$saldo = $allcredits[0];
$bonus = $allcredits[1];



?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="smalltext" width="120"><b><?=$lang_payoutinfo_table_username?>:</b></td>
  <td class="smalltext"><b><?=$username?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b><?=$lang_payoutinfo_table_date?>:</b></td>
  <td class="smalltext"><b><?=$sacarDate?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_name?>:</b></td>
  <td class="smalltext"><b><?=$fullname?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_ssn?>:</b></td>
  <td class="smalltext"><b><?=$cpf?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_address?>:</b></td>
  <td class="smalltext"><b><?=$endereco?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_citypart?>:</b></td>
  <td class="smalltext"><b><?=$bairro?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_zip?>:</b></td>
  <td class="smalltext"><b><?=$cep?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_city?>:</b></td>
  <td class="smalltext"><b><?=$cidade?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="140"><b><?=$lang_payoutinfo_table_state?>:</b></td>
  <td class="smalltext"><b><?=$estado?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b><?=$lang_payoutinfo_table_bank?>:</b></td>
  <td class="smalltext"><b><?=$bank?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b><?=$lang_payoutinfo_table_account?>:</b></td>
  <td class="smalltext"><b><?=$recebervia_conta?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b><?=$lang_payoutinfo_table_agent?>:</b></td>
  <td class="smalltext"><b><?=$recebervia_agencia?></b></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b><?=$lang_payoutinfo_table_accounttype?>:</b></td>
  <td class="smalltext"><b><?=$recebervia_contatipo?></b></td>
</tr>
</table><br>
<a href="http://anonym.to/?http://www.receita.fazenda.gov.br/Aplicacoes/ATCTA/cpf/ConsultaPublica.asp" class="link" target="_blank">Consultar CPF</a>
<br><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
<? if ($status==1) { ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><a href="payout_delete.php?id=<?=$id?>" class="link" style="color: #FF0000" onclick="return confirmDelete()"><?=$lang_payoutinfo_table_cancel?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="payout_confirm.php?id=<?=$id?>" class="link" style="color: #00CC00" onclick="return confirmValid()"><?=$lang_payoutinfo_table_realize?></a></b>
<? } ?>
<? gui_bottom(); ?>