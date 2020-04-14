<?

$userId = $_REQUEST["userId"];

include('../include_functions.php');
include('../include_guifunctions.php');
checkAccess(1);
gui_header("Estatisticas de amigao", "../");

$count_c = 0;
$friends1_count_c = 0;
$friends2_count_c = 0;

$tableStr = "";

$tableStr .= "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";

$sql = "SELECT * FROM users_friends WHERE userId = $userId";
$result = mysql_query($sql, $mysql_link);

if ($result) {

	$i=0;

	$count = mysql_num_rows($result);

	if ($count!=0) {

		$rowCount = ceil($count/4);


		for ($a=0; $a<$rowCount; $a++) {

			// Print out row of 3

			$tableStr .= "<tr>";

			for ($b=0; $b<4; $b++) {

				$tableStr .= "<td>";

				if ($row = mysql_fetch_array($result)) {

					$username = "";

					$id = $row["id"];
					$name = $row["name"];
					// $email = $row["email"];
					// $message = $row["message"];
					$percentage = $row["percentage"];

					$username = GetRow("Select username from users where amigoId = $id");

					$tableStr .= "
<table width=\"107\" \"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"border: 1px solid #000000;\">
  <tr>
    <td bgcolor=\"#F7F7F7\" height=\"24\" align=\"center\"><font class=\"tabletop\">$name</font></td>
  </tr>
  <tr>
    <td bgcolor=\"#000000\" height=\"2\"></td>
  </tr>
  <tr>
    <td bgcolor=\"#FFFFFF\" height=\"19\"><font class=\"tabletop\">&nbsp;$username</font></td>
  </tr>
  <tr>
    <td bgcolor=\"#000000\" height=\"2\"></td>
  </tr>
  <tr>
    <td bgcolor=\"#F7F7F7\" height=\"84\"><img src=\"../../img/$useLanguage/friend_$percentage.jpg\"></td>
  </tr>
  <tr>
    <td bgcolor=\"#000000\" height=\"2\"></td>
  </tr>
  <tr>
    <td bgcolor=\"#FFFFFF\" height=\"17\" align=\"center\"><font class=\"tabletop\">$lang_accountsfriends_status: </font><font style=\"color: #FF0000;\" class=\"tabletop\">$percentage%</font></td>
  </tr>
</table>";

					/***** Get the friends of this friend *****/

					// Load his friends into an array


					if ($percentage>=25) {

						$friends .= getFriends(GetRow("Select id from users where friendId = $id"));

					}

					if ($percentage==100) {
						$count_c++;
					}

					/**** Done with loading friends of this friend ****/
	

				}

				$tableStr .= "</td>";

			}

			$tableStr .= "</tr>";

			$tableStr .= "<tr>";
				$tableStr .= "<td colspan=\"4\" height=\"10\"></td>";
			$tableStr .= "</tr>";
		}

	} else {

		// No emails have been sent out...

		$tableStr .= "<font class=\"tabletop\">$lang_accountsfriends_noemails</font>";

	}

	mysql_free_result($result);

}

$tableStr .= "</table>";

if ($count != 0) {

	$friendsArray = array();
	$friendsTmpArray = explode("*", $friends);
	$friends2_count = 0;

	while (list($one,$two) = each($friendsTmpArray)) {

		if ($two) {

			$frPercentage = GetRow("Select percentage from users_friends where id = $two");

			if ($frPercentage=="100") {
				$friends1_count_c++;
			}

			array_push($friendsArray, $two);
		}

	}

	$friends1_count = count($friendsArray);

	/**** Check all the friends of your friend's friend ****/

	while (list($one,$id) = each($friendsArray)) {

		$percentage = GetRow("Select percentage from users_friends where id = $id");

		if ($percentage>=25) { /*** if he's registerd ***/

			$friends2 .= getFriends(GetRow("Select id from users where friendId = $id"));


		}

	}

	$friendsTmpArray2 = explode("*", $friends2);

	$friends2_count = $friends2_count + count($friendsTmpArray2);
	$friends2_count = $friends2_count - 1; // Remove the empty value

	while (list($one,$two) = each($friendsTmpArray2)) {

		if ($two) {

			$frPercentage = GetRow("Select percentage from users_friends where id = $two");

			if ($frPercentage=="100") {
				$friends2_count_c++;
			}

		}

	}

}

$friend1 = getSetupVar("friend_friend1");
$friend2 = getSetupVar("friend_friend2");
$friend3 = getSetupVar("friend_friend3");

$premio1 = $count_c * $friend1;
$premio2 = $friends1_count_c * $friend2;
$premio3 = $friends2_count_c * $friend3;

/**** Explaination of variables ****/
/*

Name					Explaination
----------------------------------------------------------
friends2				string of friends which your friend's friend has
friendsTmpArray2			array of friends which your friend's friend has
friendsArray				list of ids of friends which your friend has
friendsTmpArray				better list of ids of friends which your friend has (without empty value at end)

	------ IMPORTANT VARIABLES ------
count					number of first tier friends (your friends)
friends1_count				number of second tier friends (friends which your friend has)
friends2_count				number of third tier friends (friends which your friend's friend has)
tableStr				all the table with status information about your friends

count_c					number of first tier friends (your friends) - COMPLETE
friends1_count_c			number of second tier friends (friends which your friend has) - COMPLETE
friends2_count_c			number of third tier friends (friends which your friend's friend has) - COMPLETE

premio1					Premios 1
premio2					Premios 2
premio3					Premios 3

*/

if (!$friends1_count) {

	$friends1_count = 0;

}

if (!$friends2_count) {

	$friends2_count = 0;

}
?>
<table width="520" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="23" width="220" class="tabletop" bgcolor="#F7F7F7"><?=$lang_accountsfriends_information?></td>
    <td height="23" width="100" class="tabletop" align="center" bgcolor="#F7F7F7"><?=$lang_accountsfriends_quantity?></td>
    <td height="23" width="100" class="tabletop" align="center" bgcolor="#F7F7F7"><?=$lang_accountsfriends_completed?></td>
    <td height="23" width="100" class="tabletop" align="center" bgcolor="#F7F7F7"><?=$lang_accountsfriends_prize?></td>
  </tr>
  <tr>
    <td height="23" width="220" class="tabletext" bgcolor="#FFFFFF"><?=$lang_accountsfriends_friends1?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#FFFFFF"><?=$count?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#FFFFFF"><?=$count_c?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#FFFFFF"><?=$lang_system_moneybefore?> <?=credits2money($premio1)?> <?=$lang_system_moneyafter?></td>
  </tr>
  <tr>
    <td height="23" width="220" class="tabletext" bgcolor="#F7F7F7"><?=$lang_accountsfriends_friends2?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#F7F7F7"><?=$friends1_count?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#F7F7F7"><?=$friends1_count_c?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#F7F7F7"><?=$lang_system_moneybefore?> <?=credits2money($premio2)?> <?=$lang_system_moneyafter?></td>
  </tr>
  <tr>
    <td height="23" width="220" class="tabletext" bgcolor="#FFFFFF"><?=$lang_accountsfriends_friends3?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#FFFFFF"><?=$friends2_count?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#FFFFFF"><?=$friends2_count_c?></td>
    <td height="23" width="100" class="tabletext" align="center" bgcolor="#FFFFFF"><?=$lang_system_moneybefore?> <?=credits2money($premio3)?> <?=$lang_system_moneyafter?></td>
  </tr>
</table><br>
<?=$tableStr?>
<br>
<a href="javascript: history.back()" class="link">« <?=$lang_global_back?></a>
<? gui_bottom(); ?>