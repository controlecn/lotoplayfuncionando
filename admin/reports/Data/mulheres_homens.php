<?
include('../../include_functions.php');
checkAccess(2);

$man = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND sex = '1'");
$women = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND sex = '2'");



?>

<chart formatNumberScale='0' palette='4' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
            <set label='Masculinos' value='<?=$man?>'  />
            <set label='Femininas' value='<?=$women?>' />
</chart>