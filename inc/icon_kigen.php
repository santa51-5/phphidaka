<?php 
$saishin=$val["InspDATE_last"];
$shuki=$val["Inspection_cycle"];
if(!isset($saishin)){
  $saishin=time();
} 
if(!isset($shuki)){
  $shuki=12;
} 
$kigen=false;
if ($datevalue[time()]>$datevalue[$getsumatsu[$DateAdd["m"][$shuki][$saishin]]]){
  $kigen=true;
} 

$tougetsu=false;
if ($datevalue[time()]<=$datevalue[$getsumatsu[$DateAdd["m"][$shuki][$saishin]]] && $datevalue[time()]>=$datevalue[$getsusho[$DateAdd["m"][$shuki][$saishin]]]){
  $tougetsu=true;
} 

$jigetsu=false;
if ($datevalue[$dateadd["m"][1][time()]]<=$datevalue[$getsumatsu[$DateAdd["m"][$shuki][$saishin]]] && $datevalue[$dateadd["m"][1][time()]]>=$datevalue[$getsusho[$DateAdd["m"][$shuki][$saishin]]]){
  $jigetsu=true;
} 
?>
