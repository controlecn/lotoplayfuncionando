<?
include('../../include_functions.php');
checkAccess(2);

$marketing_0 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '0'");
$marketing_1 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '1'");
$marketing_2 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '2'");
$marketing_3 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '3'");
$marketing_4 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '4'");
$marketing_5 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '5'");
$marketing_6 = GetRow("SELECT COUNT(id) FROM users WHERE `ban` = '0' AND super = '0' AND `delete` = '0' AND marketing = '6'");

?>
<chart formatNumberScale='0' palette='3' decimals='0' enableSmartLabels='1' enableRotation='0' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
            <set label='Indicação de Amigos' value='<?=$marketing_1?>' />
            <set label='Mecanismos de busca' value='<?=$marketing_2?>' />
            <set label='Outros' value='<?=$marketing_3?>' />
            <set label='Propagandas em Sites' value='<?=$marketing_4?>' />
            <set label='Revista' value='<?=$marketing_5?>' />
            <set label='TV' value='<?=$marketing_6?>' />
</chart>