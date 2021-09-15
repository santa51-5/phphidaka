<?php
//削除手続き中
$ckdellist=ck_dellist($rs["master_ID"]);
//変更手続き中
$sec_henkou0=sec_henkou($rs["master_ID"]);
if($sec_henkou0){
  $sechenkou0="変更手続中！";
}else{
  $sechenkou0=null;
} 
//入荷情報手続き中
$nyukajouhou_henkou0=nyukajouhou_henkou($rs["master_ID"]);
if($nyukajouhou_henkou0){
  $nyukajouhou0="変更手続中！";
}else{
  $nyukajouhou0=null;
} 

//復活手続き中
$ckfukatsulist=ck_fukatsulist($rs["master_ID"]);
if($tbodycolor){
  echo '<tbody class="tbody1">';
}else{
  echo '<tbody class="tbody2">';
}
if($akahyouji){
  echo '<tbody class="tbody3">';
}
if(!isset($sechenkou0)){
  echo '<tbody class="tbody4">';
}
if(!isset($ckdellist)){
  echo '<tbody class="tbody5">';
}
if(!isset($ckfukatsulist)){
  echo '<tbody class="tbody7">';
}
if(!isset($nyukajouhou0)){
  echo '<tbody class="tbody8">';
}
?>
<tr><TD rowspan="2" class=w2>
<?php
if($rs["C_use"]!="3"){
  if ($m_henkou && $u_henkou){
    echo "<INPUT type=button name=SUB value=変更 onclick=ope(1,".$rs["master_ID"].")><br>";
  }
	if($m_haiki && $u_haiki){
    echo '<INPUT type=button value=廃棄 name=SUB onclick=ope(2,'.$rs["master_ID"].')></TD>';
	}
}else{
    if (!isset($ckfukatsulist)){
      echo '<INPUT type=button  name=SUB value=復活 onclick=ope(3,'.$rs["master_ID"].')><br></TD>';
    }else{
      echo '<INPUT type=button name=SUB value=解除 onclick=ope(4,'.$rs["master_ID"].')><br></TD>';
    }
}
echo '<TD rowspan=2 class="w5 kno">';
$sg=$rs["master_ID"]/100000;
//$masterid = $rs["master_ID"];
error_log("\n[".date('Y-m-d H:i:s')."]".'$rs["master_ID"]='.$rs["master_ID"]."\n","3","./debug.log");

include "../inc/icon_kigen.php";
 
//管理番号の組立
$keta=$rs["digits"];
$k_kigou=$rs["M_ID1"]; 
if(!isset($k_kigou) || $k_kigou==""){
  $k_kigou="";
} 
$k_no=$rs["M_ID2"]; 
if(!isset($k_no) || $k_no==""){
  $k_no="";
} 

$k_H_NO=$rs["M_ID3"]; 
if (!isset($k_H_NO) || $k_H_NO==""){
  $k_H_NO="";
} 
$k_h_KIGOU=$rs["M_ID4"]; 
if (!isset($k_h_KIGOU) || $k_h_KIGOU==""){
  $k_h_KIGOU="";
} 
$KNO="";
if (($k_kigou)!=""){
  if ($rs["M_ID2"]!=""){
    $KNO=$k_kigou.substr(str_repeat("0",$keta).($rs["M_ID2"]),strlen(str_repeat("0",$keta).($rs["管理数字"]))-($keta));
  }else{
    $KNO=$k_kigou.$rs["M_ID2"];
  } 
  if ($k_H_NO!="" && ($RS["DISP_LEVEL"]<1 || !isset($RS["DISP_LEVEL"]))){
    $KNO=$KNO."-".$k_H_NO;
  } 
  if ($k_h_KIGOU!="" && ($RS["DISP_LEVEL"]<1 || !isset($RS["DISP_LEVEL"]))){
    $KNO=$KNO."-".$k_h_KIGOU;
  } 
} 
if ($k_KIGOU!=""){
  print "<a name=".$rs["master_ID"]."><a href='descript.asp?master_ID=".
  rawurlencode($rs["master_ID"])."&modori=1&'>".$KNO."</a>";
}else{
  if($k_kigou==""){
    print "<a name=".$rs["master_ID"]."><a href='descript.asp?master_ID=".
    rawurlencode($rs["master_ID"])."&modori=1&'>"."番号なし"."</a>";
  }else{
    print "<a name=".$rs["master_ID"]."><a href='descript.asp?master_ID=".
    rawurlencode($rs["master_ID"])."&modori=1&'>".$KNO."</a>";
  } 
}
?>
<br><p class=henkou><span class=blinking><?=$sechenkou0;?><?=$nyukajouhou0;?><?=$ckdellist;?><?=$ckfukatsulist;?></span></p></TD>
<TD nowrap valign="middle" width="150"><? echo $rs["NN_total"];?></TD>
<?php //工場名の工場を除去
if ((strpos($rs["NN_SEC1"],"工場") ? strpos($rs["NN_SEC1"],"工場")+1 : 0)>0){
  $h_sec1=str_replace("工場","",$rs["NN_SEC1"]);
} 
?>
<TD><span class='sec1' ><?=$h_sec1;?></span>
<!--	<TD nowrap valign="middle" width="150"><img id='photo' src='../<?php echo $ID_kaishamei;?>/img/t
<?=$rs["sec1"];?>.gif' border=0 >
-->
<?php 
if ((strpos($rs["NN_SEC2"],"　") ? strpos($rs["NN_SEC2"],"　")+1 : 0)>0){
  $Ssec=explode("　",($rs["NN_SEC2"]));
  $Ssec2=$Ssec[1]; //rs("NN_SEC2")
}else{
  $Ssec2=$rs["NN_SEC2"];
} 

print $Ssec2;?>
</TD>
<TD nowrap rowspan="2" valign="middle" width="150">
<?php
$size_mode=$listing;
include "../inc/size_new.php";
echo $size;
?>
</TD>
	<TD valign="middle" width="100"><?=$rs["Reg_date"];?></TD>
	<TD valign="middle" width="100" nowrap><?=$rs["note1"]."<br>";?></TD>
	<td rowspan="2" width="200">
<!--#include file=inc/icon.php -->
</td></tr>

<tr>
	<TD nowrap valign="middle" width="150"  class=ta_list_kai><?=$rs["SerialNumber"];?><BR></TD>
	<?php
if($SP_IT){
  $P_P3=$rs["SEC3"];
  if(!isset($rs["SEC4"])){
    $P_P3=$p_p3."-".$rs["SEC4"];
  } 
}else{
  $P_P3=$rs["NN_SEC3"];
}
?>
	<TD valign="middle" width="150"><?=$P_P3;?>
  <?php 
if($mas_info_s5){
  print "/".$rs["SEC5"];
} 
?>
</TD><Td valign="middle" width="100">
<?php
if($ADMIN){
  echo $rs["InspDATE_last"];
}else{
  echo $rs["Inspection_cycle"];
  echo '</Td>';
}
?>
</Td><TD valign="middle" width="100" nowrap><?=$rs["manufacturing_number"]."<br>";?></TD>
</tr>
</tr></tbody>