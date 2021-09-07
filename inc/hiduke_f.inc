<?php
function getsusho($d){
	$nen=year(d);
	$tsuki=month(d);
	$getsusho=datevalue(nen & "/" & tsuki & "/" & "01");
}
function getsumatsu($d){
	$d1=dateadd("m",1,d);
	$d1=getsusho(d1);
	$getsumatsu=dateadd("d",-1,d1);
}
?>