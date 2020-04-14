<?

include('../include_functions.php');
checkAccess(1);
include('../include_guifunctions.php');

gui_header("Balanço do dia - Passo 2", "../");

$dia_id = $_REQUEST["dia"];

$data = GetRow("SELECT dia FROM balanco_dias WHERE id = '".$dia_id."'");

$dia_year = substr($data, 0, 4);
$dia_month = substr($data, 5, 2);
$dia_day = substr($data, 8, 2);

?>
<script>

function changeResult(sale_id, sale_result) {

	dia_id = <?=$dia_id?>;

	if (sale_result==1) {
		document.getElementById("row"+sale_id).style.backgroundColor = "#b8d99a";
	} else {
		document.getElementById("row"+sale_id).style.backgroundColor = "#ffadad";
	}
	
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
         if(xhr.readyState  == 4)
         {
              if (xhr.status  == 200) {
			  
				if (xhr.responseText=="OK") {
					alert("Mudanca com successo");
				} else {
					document.getElementById("confirm_form").style.display = "block";
				}
					
              }
         }
    }; 
	 
   xhr.open("GET", "dia_cmd_confirm.php?dia="+dia_id+"&id="+sale_id+"&result="+sale_result,  true); 
   xhr.send(null); 

}

</script>
<h2>Data do Balanço: <?=$dia_day?> / <?=$dia_month?> / <?=$dia_year?></h2>
<?
function showBank($bankId, $bankName) {

	global $mysql_link, $dia_id;

?>
<font size="6"><?=$bankName?></font><br>
<?

gui_tabletop(array("Apelido", "Valor", "Doc", "Sim ou Não"), 0);

$yesterday = date("Y-m-d", time()-86400)." 00:00:00";
$today = date("Y-m-d")." 00:00:00";

$sql = "SELECT * FROM `balanco_vendas` WHERE `dia` = '$dia_id' AND `bank` = '$bankId' ORDER BY `id`";

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

		$id = $row["id"];
		$boughtid = $row["boughtid"];
		$userid = $row["userid"];
		$value = $row["value"];
		$cents = $row["cents"];
		$doc = $row["doc"];
		$confirmed = $row["confirmed"];
		
		if (strlen($cents)==1) {
			$cents = "0$cents";
		}

		$valor = "$value,$cents";

		$username = GetRow("SELECT username FROM users WHERE id = '$userid'");
		
		if ($confirmed==1) {
			$color = "#b8d99a";
		} else if ($confirmed==2) {
			$color = "#ffadad";
		}

		?>
  <tr>
    <td bgcolor="#94a6b5" height="1" colspan="8"></td>
  </tr>
  <tr bgcolor="<?=$color?>" id="row<?=$id?>">
	<td height="23" align="right" class="tabletext"><?=$id?></td>
	<td height="23" width="5"></td>
	<td height="23" class="tabletext"><a href="../users/user_info.php?id=<?=$userid?>" class="link"><?=$username?></a></td>
	<td height="23" class="tabletext"><?=$lang_system_moneybefore?> <?=$valor?> <?=$lang_system_moneyafter?></td>
	<td height="23" class="tabletext"><?=$doc?></td>
	<td height="23" class="tabletext">
	<a href="javascript:changeResult(<?=$id?>, 1)"><img src="../images/sim.gif" border="0"></a>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript:changeResult(<?=$id?>, 2)"><img src="../images/nao.gif" border="0"></a>
	</td>
  </tr>
		<?

	}

mysql_free_result($result);

}

?>
</table>
<br><br>
<?

}

$result = mysql_query("SELECT * FROM `buy_paymentforms` ORDER BY name", $mysql_link);


if ($result) {

	while ($row = mysql_fetch_array($result)) {

		showBank($row["id"], $row["name"]);

	}

mysql_free_result($result);

}


?>
<div id="confirm_form" style="display: none">
<form method="post" action="dia_step3.php">
<input type="hidden" value="<?=$dia_id?>" name="dia">
<input type="submit" value="Confirmar!" name="submitbutton">
</form>
</div>
<? gui_bottom(); ?>