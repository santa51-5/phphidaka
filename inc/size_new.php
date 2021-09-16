<?php
if($sg<2){
//測定器
  $st="";
  $st="<table id='hyo_size' class='ta3'>";
  $s1="";
  if ($val["ID_size10"]!=""){
    $s1=$val["ID_size10"];
  } 
  if ($val["ID_size11"]!=""){
    $s1=$s1." ～ ".$val["ID_size11"];
  } 
  if ($val["ID_size12"]!=""){
    $s1=$s1." (".$val["ID_size12"].")";
  } 
  if ($val["ID_size24"]!=""){
    $s1=$s1."　(".$val["ID_size24"].")";
  } 
  $st=$st."<tr><td>".$s1."</tr></td>"; //測定器サイズ完成
}else{
//ゲージ
  $s1="";
  $k_code=$val["C_katashiki"];
  $m_code=$val["C_kibutsu"];
  $tsu=$val["ID_size21"];
  $tome=$val["ID_size22"];
  $s=$val["ID_size20"];
  $s2=$val["ID_size24"];
  $st="";
  $st="<table id='hyo_size' class='ta3'>";
  switch ($k_code){
    case "P01":
    case "P02":
    case "H01":
    case "X12":
      if ($tsu>0){
        $tsu="+".$tsu; 
      } 
      if ($tsu==0){
        $tsu="&nbsp&nbsp".$tsu; 
      } 
      if ($tome>0){
        $tome="+".$tome; 
      } 
      if ($tome==0){
        $tome="&nbsp&nbsp".$tome; 
      } 
      $st=$st."<tr><td rowspan=2>".$s."</td><td class='limit_size'>".$tome.
        "</td><td rowspan=2>".$s2."</td></tr><tr><td class='limit_size'>".$tsu."</td></tr>";
      break;
    case "C01":
    case "C02":
    case "H02":
    case "C03":
    case "X10":
    case "X36":
      if ($tsu>0){
        $tsu="+".$tsu; 
      } 
      if ($tsu==0){
        $tsu="&nbsp&nbsp".$tsu; 
      } 
      if ($tome>0){
        $tome="+".$tome; 
      } 
      if ($tome==0){
        $tome="&nbsp&nbsp".$tome; 
      } 
      $st=$st."<tr><td rowspan=2>".$s."</td><td class='limit_size'>".$tsu
        ."</td><td rowspan=2>".$s2."</td></tr><tr><td class='limit_size'>".$tome."</td></tr>";
      break;
    case "S01":
    case "S02":
    case "P03":
    case "S03":
      $st=$st."<tr><td>".$s."</td></tr>";
      break;
    case "H03":
    case "W01":
    case "X08":
    case "X28":
    case "X29":
    case "X30":
    case "X31":
    case "X32":
    case "X33":
      if ($tsu>0){
        $tsu="+".$tsu; 
      } 
      if ($tsu==0){
        $tsu="&nbsp&nbsp".$tsu; 
      } 
      if ($tsu!=""){
        $st=$st."<tr><td>".$s." (".$tsu.")"."</td></tr>";
      }else{
        $st=$st."<tr><td>".$s."</td></tr>";
      } 
      break;
    case "X03":
    case "X04":
      if ($s!=""){
        $st=$st."<tr ><td>".$s;
      } 
      if ($tsu!=""){
        $st=$st." (".$tsu.")"."</td></tr>";
      } 
      if ($tome!=""){
        $st=$st."×".$tome."</td></tr>";
      } 
      break;
    default:
      $st=$st.$s;
      break;
  } 


} 
//ゲージサイズ完成

$st=$st."</table>"; //サイズ完成
$size=$st;
if((strpos($val["ID_size20"],"/")) || (strpos($val["ID_size20"],"+"))  || (strpos($val["ID_size20"],"-"))){
  $st="<table id='hyo_size'_class='ta3'>";
  $st=$st."<tr><td>".$val["ID_size20"]."</tr></td></TABLE>";
  $size=$st;
} 
?>

