<?php
require 'common/config.php';
require 'common/functions.php';

$date=date('m/j/Y');
$yesterday=date('m/j/Y', strtotime('Yesterday'));

$qryTotals='Select count(*) as Total from Stations;'
          .'Select count(*) as InActive from voip.Stations where Status ="DISC";'
	  .'Select count(*) as Active from voip.Stations where Status ="CURR";'
	  .'Select count(*) as TodayUse from voip.Stations where Status ="CURR" and LastLoginDate like "'.$date.'%";';

$qryJMttls='Select count(*) as Total from Stations where Station_Name like "JAMB%";'
	  .'Select count(*) as InActive from Stations where Station_Name like "JAMB%" and Status ="DISC";'
	  .'Select count(*) as Active from Stations where Station_Name like "JAMB%" and Status ="CURR";'
	  .'Select count(*) as TodayUse from Stations where Station_Name like "JAMB%" and Status ="CURR" and LastLoginDate like "'.$date.'%";';
 
$qryKGttls='Select count(*) as Total from Stations where Station_Name like "KG%";'
          .'Select count(*) as InActive from Stations where Station_Name like "KG%" and Status ="DISC";'
	  .'Select count(*) as Active from Stations where Station_Name like "KG%" and Status ="CURR";'
          .'Select count(*) as TodayUse from Stations where Station_Name like "KG%" and Status ="CURR" and LastLoginDate like "'.$date.'%";';

$qryFCttls='Select count(*) as Total from Stations where Station_Name like "Focus%";'
          .'Select count(*) as InActive from Stations where Station_Name like "Focus%" and Status ="DISC";'
          .'Select count(*) as Active from Stations where Station_Name like "Focus%" and Status ="CURR";'
          .'Select count(*) as TodayUse from Stations where Station_Name like "Focus%" and Status ="CURR" and LastLoginDate like "'.$date.'%";';

$qryFLttls='Select count(*) as Total from Stations where Station_Name like "FL%";'
          .'Select count(*) as InActive from Stations where Station_Name like "FL%" and Status ="DISC";'
	  .'Select count(*) as Active from Stations where Station_Name like "FL%" and Status ="CURR";'
          .'Select count(*) as TodayUse from Stations where Station_Name like "FL%" and Status ="CURR" and LastLoginDate like "'.$date.'%";';

$qryChnaged='Select count(*) as AddedToday from Stations where AddDate like "'.$date.'%";'
	  .'Select count(*) as ChangedToday from Stations where ChangeDate like "'.$date.'%";'
	  .'Select count(*) as AddedYesterday from Stations where AddDate like "'.$yesterday.'%";'
	  .'Select count(*) as ChangedYesterday from Stations where ChangeDate like "'.$yesterday.'%";';

$totals=getTotals($link,$qryTotals);
$jamaica=getTotals($link,$qryJMttls);
$india=getTotals($link,$qryKGttls);
$elsal=getTotals($link,$qryFCttls);
$florida=getTotals($link,$qryFLttls);
$chaged=getTotals($link,$qryChnaged);

$locations=array("Totals"=>$totals,"Jamaica"=>$jamaica,"KG-India"=>$india,"ElSalvador"=>$elsal,"Florida"=>$florida);

echo json_encode($locations);
$link->close();
?>
