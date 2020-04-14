<?

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(2);

gui_header("PHPLive Log", "../");

$date = $_POST["date"];

if (!$date) {
	$date = date("Y-m-d");
}

$today = 0;

if ($date==date("Y-m-d")) {
	$today = 1;
}

$date_start = strtotime($date);
$date_end = $date_start + 86400;

$date_sel = date("Y-m-d", $date_start);

?>

<form method="post" action="phplive_log.php">
Ver data:
<select name="date">
<?

for ($a=0; $a<7; $a++) {

	switch ($a) {
	
		case 0:	$date_now = date("Y-m-d", time()-86400*6); break;
		case 1:	$date_now = date("Y-m-d", time()-86400*5); break;
		case 2:	$date_now = date("Y-m-d", time()-86400*4); break;
		case 3:	$date_now = date("Y-m-d", time()-86400*3); break;
		case 4:	$date_now = date("Y-m-d", time()-86400*2); break;
		case 5:	$date_now = date("Y-m-d", time()-86400); break;
		case 6:	$date_now = date("Y-m-d", time()); break;
	
	}

	$date_print = substr($date_now,8,2)."/".substr($date_now,5,2);
	
	if ($date_sel==$date_now) {
		echo "<option value=\"$date_now\" selected>$date_print</option>";
	} else {
		echo "<option value=\"$date_now\">$date_print</option>";
	}

}

?>
</select>
<input type="submit" value="Mostrar" name="view_users">
</form>
<br>
<table width="781" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="60"><strong>Usuario</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>00</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>01</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>02</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>03</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>04</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>05</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>06</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>07</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>08</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>09</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>10</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>11</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>12</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>13</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>14</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>15</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>16</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>17</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>18</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>19</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>20</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>21</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>22</strong></td>
    <td width="30" background="../images/chatlog_back.gif" align="center"><strong>23</strong></td>
	<td width="1" bgcolor="#a1a1a1"></td>
  </tr>
<?

mysql_select_db("lotoplay_chat", $mysql_link);

$result = mysql_query("SELECT userID,login FROM chat_admin ORDER BY login DESC", $mysql_link);

$users = array();

if ($result) {

	$a = 0;

	while ($row = mysql_fetch_array($result)) {
		$users[$a]["userid"] = $row["userID"];
		$users[$a]["login"] = $row["login"];
		$users[$a]["entrada"] = array();
		$users[$a]["saida"] = array();
		$users[$a]["entrada1"] = array();
		$users[$a]["saida1"] = array();
		$a++;
	}

mysql_free_result($result);

}

// Fill upp the entrada / saida

for ($a=0; $a<count($users); $a++) {
	
	$result = mysql_query("SELECT * FROM chat_adminstatus WHERE userID = '".$users[$a]["userid"]."' AND created BETWEEN $date_start AND $date_end ORDER BY created", $mysql_link);

	if ($result) {
	
		$b = 0;

		while ($row = mysql_fetch_array($result)) {

			$timestamp = $row["created"];
			$status = $row["status"];
			
			if (($status==0)&&($b==0)) {
				array_push($users[$a]["entrada"], $date_start);
				array_push($users[$a]["saida"], $timestamp);
				array_push($users[$a]["entrada1"], $date_start);
				array_push($users[$a]["saida1"], $timestamp);
			} else {
			
				if (($status!=$last_status)) {
			
					if ($status==1) {
						array_push($users[$a]["entrada"], $timestamp);
						array_push($users[$a]["entrada1"], $timestamp);
					} else {
						array_push($users[$a]["saida"], $timestamp);
						array_push($users[$a]["saida1"], $timestamp);
					}
				
				}
			
			}
			
			$last_status = $status;
			
			$b++;
		
		}

		mysql_free_result($result);

	}

}

for ($a=0; $a<count($users); $a++) {

	if (count($users[$a]["entrada"])!=0) {
	
		for ($b=0; $b<count($users[$a]["entrada"]); $b++) {
			//$users[$a]["entrada"][$b] = date("H:i:s", $users[$a]["entrada"][$b]) . " (".$users[$a]["entrada"][$b].")";
			//$users[$a]["saida"][$b] = date("H:i:s", $users[$a]["saida"][$b]) . " (".$users[$a]["saida"][$b].")";
			$users[$a]["entrada"][$b] = floor(($users[$a]["entrada"][$b] - $date_start) / 120);
			
			if (!$users[$a]["saida"][$b]) {
			
				if ($today==1) {
					$users[$a]["saida"][$b] = floor((time() - $date_start) / 120);
				} else {
					$users[$a]["saida"][$b] = 720;
				}
			
				
			} else {
				$users[$a]["saida"][$b] = floor(($users[$a]["saida"][$b] - $date_start) / 120);
			}
		}
	
	}

}

function px2hr($px) {

	if (($px==0)||($px==720)) {
		$output = "00:00";
	} else {
	
		// Cada 1 pixel e 2 minutos
		$total_minutes = $px * 2;
		$total_hours = floor($total_minutes / 60);
		$rest_minutes = $total_minutes - ($total_hours * 60);
		
		if (strlen($rest_minutes)==1) {
			$rest_minutes = "0$rest_minutes";
		}
		
		$output = "$total_hours:$rest_minutes";
		
	}

	return $output;

}

for ($a=0; $a<count($users); $a++) {

	$userid = $users[$a]["userid"];
	$login = $users[$a]["login"];
	$entrada = $users[$a]["entrada"];
	$saida = $users[$a]["saida"];
	$entrada1 = $users[$a]["entrada1"];
	$saida1 = $users[$a]["saida1"];

	if (count($entrada)==0) {
	
		// Nao entrou nesse dia...
	
		?>
		<tr>
			<td height="26"><?=$login?></td>
			<td background="../images/chatlog_back.gif" height="26" colspan="24"></td>
			<td height="26" width="1" bgcolor="#a1a1a1"></td>
		</tr>
		<?
		
	} else {
		
		echo "<tr><td height=\"26\">$login</td><td height=\"26\" background=\"../images/chatlog_back.gif\" colspan=\"24\">";
	
		$cursor = 0;
	
		for ($b=0; $b<count($entrada); $b++) {
		
			$horas_start = $entrada[$b];
			$horas_end = $saida[$b];
			$created1 = $entrada1[$b];
			$created2 = $saida1[$b];
			
			if ($b==0) {
				$space = $cursor + $horas_start;
			} else {
				$space = $horas_start - $cursor;
			}
			
			$length = $horas_end - $horas_start;

			echo "<img src=\"../images/px.gif\" height=\"26\" width=\"$space\">";
			//echo "<a href=\"phplive_log_session.php?login=$login&date=$date&entrada=$created1&saida=$created2\"><img src=\"../images/chatlog_gradient.gif\" height=\"26\" width=\"$length\" title=\"".px2hr($horas_start)." -> ".px2hr($horas_end)."\" alt=\"".px2hr($horas_start)." -> ".px2hr($horas_end)."\" border=\"0\"></a>";
			echo "<img src=\"../images/chatlog_gradient.gif\" height=\"26\" width=\"$length\" title=\"".px2hr($horas_start)." -> ".px2hr($horas_end)."\" alt=\"".px2hr($horas_start)." -> ".px2hr($horas_end)."\" border=\"0\">";
			$cursor = $cursor + $space + $length;

		}
		
		echo "</td><td height=\"26\" width=\"1\" bgcolor=\"#a1a1a1\"></td></tr>";
	
	}
	
}

?>
</table>
<br><br>
<a href="phplive_log_eventos.php" class="link">Ver eventos...</a>
<? gui_bottom(); ?>