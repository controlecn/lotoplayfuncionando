<?
include('../../include_functions.php');
checkAccess(2);

function showAge($start, $end) {

	$year_now = date("Y");

	$year_start = $year_now - $end;
	$year_end = $year_now - $start;
	
	$qt = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND `sex` = '2' AND year BETWEEN '$year_start' AND '$year_end'");
	
	return $qt;
	
}

$age_1 = showAge(18,30);
$age_2 = showAge(30,40);
$age_3 = showAge(40,50);
$age_4 = showAge(50,60);
$age_5 = showAge(60,120);

?>
<chart formatNumberScale='0' palette='3' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
            <set label='18-30' value='<?=$age_1?>' />
            <set label='30-40' value='<?=$age_2?>' />
            <set label='40-50' value='<?=$age_3?>' />
            <set label='50-60' value='<?=$age_4?>' />
            <set label='60+' value='<?=$age_5?>' />
</chart>