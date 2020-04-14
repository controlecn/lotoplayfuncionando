<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(1);

$fromForm = $_REQUEST["fromForm"];

if ($fromForm) {
	$username = $_REQUEST["username"];
	$id = GetRow("SELECT id FROM users WHERE username = '$username'");
} else {
	$id = $_REQUEST["id"];
}

if (GetRow("SELECT COUNT(id) FROM users WHERE id = '$id'")==0) {
	Header("Location: active.php");
}

gui_header("Informacao de usuario", "../");

$sql = "Select * from users where id = $id";

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
	$super = $row["super"];
	$delete = $row["delete"];
	$ban = $row["ban"];
	$test = $row["test"];
	$points = $row["points"];
	$joinedWhen = changeMysqlTime($row["joinedWhen"]);

	mysql_free_result($result);

}

$allcredits = getCredits($id);
$saldo = $allcredits[0];
$bonus = $allcredits[1];

$compras = GetRow("SELECT SUM(amount) FROM `statistics_sales` WHERE userId = '$id' AND transfertype = '1'");
$saques = GetRow("SELECT SUM(amount) FROM `statistics_sales` WHERE userId = '$id' AND transfertype = '2'");

?>
<script>
function confirmDelete() {
    return confirm('<?=$lang_accountsviewuser_deletemessage?>');
}
</script>
<? if ($super==1) { ?>
<h1>Usuario VIP!</h1>
<? } ?>
<? if ($ban==1) { ?>
<h1>Usuario BANEADO!</h1>
<? } ?>
<? if ($delete==1) { ?>
<h1>Usuario Deletado!</h1>
<? } ?>
<? if ($test==1) { ?>
<h1>Conta de teste!</h1>
<? } ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_date?>:</td>
  <td class="tabletext"><?=$joinedWhen?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_name?>:</td>
  <td class="tabletext"><?=$fullname?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_username?>:</td>
  <td class="tabletext"><?=$username?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_email?>:</td>
  <td class="tabletext"><a href="mailto:<?=$email?>" class="link"><?=$email?></a></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_ssn?>:</td>
  <td class="tabletext"><?=$cpf?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_birthdate?>:</td>
  <td class="tabletext"><?=$dia?> / <?=$mes?> / <?=$ano?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_address?>:</td>
  <td class="tabletext"><?=$endereco?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_citypart?>:</td>
  <td class="tabletext"><?=$bairro?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_zip?>:</td>
  <td class="tabletext"><?=$cep?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_city?>:</td>
  <td class="tabletext"><?=$cidade?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_state?>:</td>
  <td class="tabletext"><?=$estado?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_affliate?>:</td>
  <td class="tabletext"><?

if ($socioId==0) {

	echo $lang_accountsviewuser_info_noaffliate;

} else {

	$socioUsername = GetRow("Select login from users_socios Where id = $socioId");

	echo "<a href=\"../affliates/info.php?id=$socioId\" class=\"link\">$socioUsername</a>";
}


?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_friend?>:</td>
  <td class="tabletext"><?

if ($amigoId==0) {

	echo $lang_accountsviewuser_info_nofriend;

} else {

	$amigoUserId = GetRow("Select userId from users_amigos Where id = $amigoId");
	$amigoUsername = GetRow("Select username from users Where id = $amigoUserId");

	echo "<a href=\"user_info.php?id=$amigoUserId\" class=\"link\">$amigoUsername</a>";

}


?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140">Pontos:</td>
  <td class="tabletext"><?=$points?></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_credits?>:</td>
  <td class="tabletext"><?=$lang_system_moneybefore?> <?=credits2money($saldo)?> <?=$lang_system_moneyafter?> (<?=$saldo?>)</td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140"><?=$lang_accountsviewuser_info_bonus?>:</td>
  <td class="tabletext"><?=$lang_system_moneybefore?> <?=credits2money($bonus)?> <?=$lang_system_moneyafter?> (<?=$bonus?>)</td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140">Compras:</td>
  <td class="tabletext"><font color="#5a9f00"><b><?=$lang_system_moneybefore?> <?=formatMoney($compras)?> <?=$lang_system_moneyafter?></b></font></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
<tr>
  <td class="tabletop" width="140">Saques:</td>
  <td class="tabletext"><font color="#ff0000"><b><?=$lang_system_moneybefore?> <?=formatMoney($saques)?> <?=$lang_system_moneyafter?></b></font></td>
</tr>
<tr>
  <td colspan="2" height="10"></td>
</tr>
</table><br>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../payments/transfers.php?username=<?=$username?>" class="link"><?=$lang_accountsviewuser_bottom_transfers?></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_friends.php?userId=<?=$id?>" class="link"><?=$lang_accountsviewuser_bottom_friends?></a>
<? if ($access==2) { ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="change.php?id=<?=$id?>" class="link">Alterar Cadastro</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="change_pass.php?id=<?=$id?>" class="link">Alterar Senha</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_login.php?userid=<?=$id?>" target="_blank" class="link">Log-In</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_ban.php?id=<?=$id?>" class="link" style="color: #FF0000" onclick="return confirmDelete()">Banear</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="user_delete.php?id=<?=$id?>" class="link" style="color: #FF0000" onclick="return confirmDelete()">Deletar</a>
<? } ?>

<br><br>

<?

if (GetRow("Select * from transfers_buy WHERE status = '0' AND userId = '$id' ORDER BY id DESC")!=0) {

	?>
		<font  class="tabletop">Compras Abertas:</font><br><br>
	<?
	
	gui_tabletop(array($lang_boughtcredits_table_username, $lang_boughtcredits_table_form, $lang_boughtcredits_table_value, $lang_boughtcredits_table_date), 1);

}

$sql = "Select * from transfers_buy WHERE status = '0' AND userId = '$id' ORDER BY id DESC";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		$vid = $row["id"];
		$userId = $row["userId"];
		$bankId = $row["bankId"];
		$value = $row["value"];
		$cents = $row["cents"];
		$affliateId = $row["affliateId"];
		$boughtWhen = changeMysqlTime($row["boughtWhen"]);

		if (strlen($cents)==1) {
			$cents = "0$cents";
		}

		$valor = "$value,$cents";

		$username = GetRow("Select username From users Where id = $userId");
		$bank = GetRow("Select name From buy_paymentforms Where id = $bankId");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="7"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tabletext"><?=$vid?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$username?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bank?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$valor?> <?=$lang_system_moneyafter?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$boughtWhen?></td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="../payments/transfers_buy_confirm_doc.php?id=<?=$vid?>"><img src="../images/icons/check.gif" alt="<?=$lang_boughtcredits_table_realize?>" border="0"></a></td>
  </tr>
		<?

	}

mysql_free_result($result);

}

?>
</table><br>



<?

if (GetRow("Select * from transfers_payout WHERE status = 1 AND userId = '$id'")!=0) {

	?><font  class="tabletop">Saques Dependentes:</font><br><br><?
	gui_tabletop(array($lang_payout_table_username, $lang_payout_table_paymenttype, $lang_payout_table_value), 1);

}

$total = 0;

$sql = "Select * from transfers_payout WHERE status = 1 AND userId = '$id'";

$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	while ($row = mysql_fetch_array($result)) {

		$i++;

		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}

		$sid = $row["id"];
		$userId = $row["userId"];
		$sacarDate = $row["payDate"];
		$quanto = $row["payValue"];
		$recebervia = $row["payType"];
		$recebervia_banco = $row["payBank"];
		$valid = $row["valid"];
		
		$total = $total + $row["payValue"];

		$quantoReals = credits2money($row["payValue"]);

		$username = GetRow("Select username From users Where id = $userId");

		$bank = GetRow("Select name From affliates_banks Where number = $recebervia_banco");

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="6"></td>
  </tr>
  <tr>
	<td bgcolor="<?=$color?>" height="23" align="right" class="tableid"><?=$sid?></td>
	<td bgcolor="<?=$color?>" height="23" width="5"></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$username?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$bank?></td>
	<td bgcolor="<?=$color?>" height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$quantoReals?> <?=$lang_system_moneyafter?>&nbsp;(<?=$quanto?>)</td>
	<td bgcolor="<?=$color?>" height="23" align="center"><a href="../payments/payout_info.php?id=<?=$sid?>"><img src="../images/icons/info.gif" alt="<?=$lang_payout_table_info?>" border="0"></a>&nbsp;&nbsp;<a href="../payments/payout_confirm.php?id=<?=$id?>" onclick="return confirmValid()"><img src="../images/icons/check.gif" alt="<?=$lang_payout_table_realize?>" border="0"></a>&nbsp;&nbsp;<a href="../payments/payout_delete.php?id=<?=$id?>" onclick="return confirmDelete()"><img src="../images/icons/delete.gif" alt="<?=$lang_payout_table_cancel?>" border="0"></a></td>
  </tr>

		<?

	}

mysql_free_result($result);

}

if ($i==0) {

		echo "
		  <tr>
		    <td bgcolor=\"#FFFFFF\" colspan=\"6\" class=\"smalltext\" height=\"23\" align=\"center\">$lang_global_emptytable</td>
		  </tr>
		";

}

?>
</table><br><br>

<font  class="tabletop">Ultimas 20 compras e saques:</font><br><br>
<table width="720" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;</td>
	<td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Usuário</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Data</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Valor</td>
    <td bgcolor="#F7F7F7" height="23" class="tabletop">&nbsp;Banco</td>
  </tr>
<?
$sql = "SELECT * FROM statistics_sales WHERE userId = '$id' ORDER BY id DESC LIMIT 20";
$result = mysql_query($sql, $mysql_link);

	$i = 0;
	$a = 0;

if ($result) {

	$kj = 0;
	$saldliq = 0;
	$vendas = 0;
	$saques = 0;

	while ($row = mysql_fetch_array($result)) {

		$i++;

		$payout = 0;

		$id = $row["id"];
		$userId = $row["userId"];
		$buyDate = $row["buyDate"];
		$amount = $row["amount"];
		$bank = $row["bank"];
		$transfertype = $row["transfertype"];

		$username = GetRow("SELECT username FROM users WHERE id = $userId");
		$newBuyDate = substr($buyDate, 8, 2) . "/" . substr($buyDate, 5, 2);
		
		if($a%2 == 0) {
			$color = "#FFFFFF";
			$a++;
		} else {
 			$color = "#F7F7F7";
 			$a++;
		}
		
		if ($transfertype==1) {
			$icon = "../images/icons/compra.gif";
			$vendas = $vendas + $amount;
		} else {
			$icon = "../images/icons/pagamento.gif";
			$saques = $saques + $amount;
		}
		

		$gover = round($gover, 2);
		$payout = round($payout, 2);
		$saldliq = round($saldliq, 2);
		$vendas = round($vendas, 2);
		
		if ($bank!=0) {
			$bank = GetRow("SELECT name_short FROM buy_paymentforms WHERE id = $bank");
		} else {
			$bank = "--";
		}

		echo "
		  <tr>
			<td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;<img src=\"../images/$icon\"></td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;<a class=\"link\" href=\"../users/user_info.php?id=$userId\">$username</a></td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$newBuyDate</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$amount</td>
		    <td bgcolor=\"$color\" height=\"20\" class=\"tabletext\">&nbsp;$bank</td>
		  </tr>
		";
		
		

	}

mysql_free_result($result);

}

?>
</table><br><br>
<? gui_bottom(); ?>