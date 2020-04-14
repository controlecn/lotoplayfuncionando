<? include('../../include_functions.php');
checkAccess(2); ?><chart  formatNumberScale='0' numberPrefix='R$ ' palette='4' decimals='0' enableSmartLabels='1' enableRotation='1' bgColor='99CCFF,FFFFFF' bgAlpha='40,100' bgRatio='0,100' bgAngle='360' showBorder='1' startingAngle='70' >
<?

$month = date("m");
$year = date("Y");
$today = date("j");

		if ($bank==0) $bank = "--";
		if ($bank==29) $bank = "BB";
		if ($bank==30) $bank = "Caixa";
		if ($bank==34) $bank = "Unibanco";
		if ($bank==35) $bank = "Itau";
		if ($bank==38) $bank = "HSBC";
		if ($bank==39) $bank = "Santander";
		if ($bank==41) $bank = "Real";
		if ($bank==42) $bank = "NCaixa";
		if ($bank==45) $bank = "Bradesco";

?>
<set label='BB' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '29' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='Caixa' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '30' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='Unibanco' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '34' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='Itau' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '35' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='HSBC' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '38' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='Santander' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '39' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='Real' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '41' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='NCaixa' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '42' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
<set label='Bradesco' value='<?=GetRow("SELECT SUM(amount) FROM statistics_sales WHERE bank = '45' AND transfertype = '1' AND buyDate BETWEEN '$year-$month-01' AND '$year-$month-$today'")?>'  />
</chart>