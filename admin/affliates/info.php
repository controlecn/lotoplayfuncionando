<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);
gui_header("Informação de afiliado", "../");

$id = $_REQUEST["id"];

$sql = "Select * from users_affliates where id = $id";

$result = mysql_query($sql, $mysql_link);

	$i = 0;

if ($result) {

	$row = mysql_fetch_array($result);

	$nome = $row["name"];
	$url = $row["url"];
	$endereco = $row["address"];
	$complemento = $row["complement"];
	$bairro = $row["citypart"];
	$cidade = $row["city"];
	$estado = $row["state"];
	$pais = $row["country"];
	$cep = $row["zip"];
	$ddd = $row["areacode"];
	$telefone = $row["telephone"];
	$login = $row["login"];
	$email = $row["email"];
	$recebervia = $row["payType"];
	$recebervia_banco = $row["payBank"];
	$recebervia_agencia = $row["payAgent"];
	$recebervia_conta = $row["payAccount"];
	$recebervia_contatipo = $row["payAccountType"];

	$registerDate = $row["registerDate"];

	mysql_free_result($result);

	$recebervia = str_replace("1", $lang_affliateview_deposit, $recebervia);
	$recebervia = str_replace("2", $lang_affliateview_check, $recebervia);

}

?>
<script>
function confirmDelete() {

    var is_confirmed = confirm('<?=$lang_affliateview_delete?>');

    return is_confirmed;

}
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_name?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$nome?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_url?>:</b></td>
  <td class="smalltext" width="20"></td>
  <td class="tabletext"><a href="<?=$url?>" class="link" target="_blank"><?=$url?></a></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_address?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$endereco?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_complete?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$complemento?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_citypart?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$bairro?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_city?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$cidade?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_state?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$estado?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_country?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$pais?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_zip?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$cep?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_areacode?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$ddd?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_telephone?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$telefone?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_login?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$login?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_email?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$email?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="200"><b><?=$lang_affliateview_paymenttype?>:</b></td>
  <td width="20"></td>
  <td class="tabletext"><?=$recebervia?></td>
</tr>
<tr>
  <td colspan="3" height="10"></td>
</tr>
</table><br>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="transfers_affliate.php?id=<?=$id?>" class="link"><?=$lang_affliateview_sales?></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php?socioId=<?=$id?>" class="link"><?=$lang_affliateview_users?></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="delete.php?id=<?=$id?>" class="link" style="color: #FF0000" onclick="return confirmDelete()"><?=$lang_affliateview_delete?></a>
<? gui_bottom(); ?>