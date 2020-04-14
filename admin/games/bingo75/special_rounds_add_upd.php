<?

include('../../include_functions.php');
checkAccess(2);

error_reporting(0);

$round_time = $_POST["round_time"];
$round_type = $_POST["round_type"];
$round_object = $_POST["round_object"];
$round_prize = $_POST["round_prize"];
$round_vip = $_POST["round_vip"];
$round_winners = $_POST["round_winners"];

SqlQuery("INSERT INTO bingo75_rounds (round_time,round_type,round_object,round_prize,round_vip,round_winners) VALUES ('$round_time','$round_type','$round_object','$round_prize','$round_vip','$round_winners')");

Header("Location: special_rounds.php?update=yes");

?>