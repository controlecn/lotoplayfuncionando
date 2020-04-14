<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');
gui_header("Localizar Pedido de compra", "../");

$number = $_GET["number"];

if ($number) {

	$number = trim($number);

	if (GetRow("SELECT COUNT(id) FROM transfers_buy WHERE id = '$number'")==0) {
		echo "<b>Pedido não encontrado!";
	} else {

		$result = mysql_query("SELECT * FROM transfers_buy WHERE id = '$number'", $mysql_link);

		if ($result) {

			$row = mysql_fetch_array($result);
			
			$userId = $row["userId"];
			$bankId = $row["bankId"];
			$value = $row["value"];
			$cents = $row["cents"];
			$boughtWhen = $row["boughtWhen"];
			$status = $row["status"];
			$doc = $row["doc"];
			$confirmed = $row["status"];
			
			$username = GetRow("SELECT username FROM users WHERE id = '$userId'");
			
			if (strlen($cents)==1) {
				$cents = "0$cents";
			}

			$valor = "$value,$cents";
			$boughtWhen = changeMysqlTime($row["boughtWhen"]);

			$bank = GetRow("Select name From buy_paymentforms Where id = $bankId");
			
			$quantoReals = credits2money($row["payValue"]);

			mysql_free_result($result);
			
			?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
  <td class="smalltext" width="120"><b>Nr:</b></td>
  <td class="smalltext"><b><?=$number?></b></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b>Info:</b></td>
  <td class="smalltext"><b>
  <?
  
	if ($confirmed==0) {
		echo "Aberto";
	} else if ($confirmed==1) {
		echo "Confirmado";
	} else if ($confirmed==2) {
		echo "Cancelado";
	}

  ?>
  </b></td>
</tr>
<? if ($confirmed==1) { ?>
<tr>
  <td class="smalltext" width="120"><b>Documento:</b></td>
  <td class="smalltext"><b><?=$doc?></b></td>
</tr>
<? } ?>
<tr>
  <td class="smalltext" width="120"><b>Apelido:</b></td>
  <td class="smalltext"><b><?=$username?></b></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b>Banco:</b></td>
  <td class="smalltext"><b><?=$bank?></b></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b>Valor:</b></td>
  <td class="smalltext"><b><?=$valor?></b></td>
</tr>
<tr>
  <td class="smalltext" width="120"><b>Data/Hora:</b></td>
  <td class="smalltext"><b><?=$boughtWhen?></b></td>
</tr>
</table>
<? if ($confirmed!=1) { ?>
<br><br><a href="transfers_buy_confirm_doc.php?id=<?=$number?>" class="link">Liberar!</a>
<? } ?>
			<?

		}
	
	}

}


gui_bottom(); ?>