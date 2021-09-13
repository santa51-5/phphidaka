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
if(!!isset($sechenkou0)){
  echo '<tbody class="tbody4">';
}
if(!!isset($ckdellist)){
  echo '<tbody class="tbody5">';
}
if(!!isset($ckfukatsulist)){
  echo '<tbody class="tbody7">';
}
if(!!isset($nyukajouhou0)){
  echo '<tbody class="tbody8">';
}
?>
<tr><TD rowspan="2" class=w2>
<?php
if($rs["使用区分コード"]!="3"){
  if ($m_henkou && $u_henkou){
    echo '<INPUT type=button  name=SUB value=変更 onclick=ope(1,'.$rs["master_ID"].')><br>';
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
?>
<!--#include file=inc/icon_kigen.php -->
<? 
//管理番号の組立
$keta=$rs["桁"];
$k_kigou=$rs["管理記号"]; 
if(!isset($k_kigou) || $k_kigou==""){
  $k_kigou="";
} 
$k_no=$rs["管理数字"]; 
if(!isset($k_no) || $k_no==""){
  $k_no="";
} 

$k_H_NO=$rs["管理補助数字"]; 
if (!isset($k_H_NO) || $k_H_NO==""){
  $k_H_NO="";
} 
$k_h_KIGOU=$rs["管理補助記号"]; 
if (!isset($k_h_KIGOU) || $k_h_KIGOU==""){
  $k_h_KIGOU="";
} 
$KNO="";
if (($k_kigou)!=""){
  if ($rs["管理数字"]!=""){
    $KNO=$k_kigou.substr(str_repeat("0",$keta).($rs["管理数字"]),strlen(str_repeat("0",$keta).($rs["管理数字"]))-($keta));
  }else{
    $KNO=$k_kigou.$rs["管理数字"];
  } 
  if ($k_H_NO!="" && ($RS["レベル"]<1 || !isset($RS["レベル"]))){
    $KNO=$KNO."-".$k_H_NO;
  } 
  if ($k_h_KIGOU!="" && ($RS["レベル"]<1 || !isset($RS["レベル"]))){
    $KNO=$KNO."-".$k_h_KIGOU;
  } 
} 
if ($k_KIGOU!=""){
  print "<a name=".$rs["マスタID"]."><a href='descript.asp?マスタID=".
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
<br><p class=henkou><span class=blinking><? echo $sechenkou0;?><? echo $nyukajouhou0;?><? echo $ckdellist;?><? echo $ckfukatsulist;?></span></p></TD>
<TD nowrap valign="middle" width="150"><? echo $rs["全名称"];?></TD>
<? //工場名の工場を除去
if ((strpos($rs["所番地1"],"工場") ? strpos($rs["所番地1"],"工場")+1 : 0)>0){
  $h_sec1=str_replace("工場","",$rs["所番地1"]);
} 
?>
<TD><span class='sec1' ><?=$h_sec1;?></span>
<!--	<TD nowrap valign="middle" width="150"><img id='photo' src='../<? echo $ID_kaishamei;?>/img/t
<?=$rs["所番地分類1"];?>.gif' border=0 >
-->
<? 
if ((strpos($rs["所番地2"],"　") ? strpos($rs["所番地2"],"　")+1 : 0)>0){
  $Ssec=explode("　",($rs["所番地2"]));
  $Ssec2=$Ssec[1]; //rs("所番地2")
}else{
  $Ssec2=$rs["所番地2"];
} 
//response.redirect "debug.asp?st1="&Ssec(1)
print $Ssec2;?>
</TD>
<TD nowrap rowspan="2" valign="middle" width="150">
<?php
$size_mode=$listing;
?>
<!--#include file=inc/size_new.php -->
<?=$size;?></TD>
	<TD valign="middle" width="100"><? echo $rs["登録年月日"];?></TD>
	<TD valign="middle" width="100" nowrap><? echo $rs["備考1"]."<br>";?></TD>
	<td rowspan="2" width="200">
<!--#include file=inc/icon.php -->
</td></tr>

<tr>
	<TD nowrap valign="middle" width="150"  class=ta_list_kai><? echo $rs["製造番号"];?><BR></TD>
	<?php
if($SP_IT){
  $P_P3=$rs["所番地分類3"];
  if(!!isset($rs["所番地分類4"])){
    $P_P3=$p_p3."-".$rs["所番地分類4"];
  } 
}else{
  $P_P3=$rs["所番地3"];
}
?>
	<TD valign="middle" width="150"><? echo $P_P3;?>
  <?php 
if($mas_info_s5){
  print "/".$rs["置き場1"];
} 
?>
</TD><Td valign="middle" width="100">
<?
if($ADMIN){
  echo $rs["最新校正日"];
}else{
  echo $rs["検査周期"];
  echo '</Td>';
}
?>
</Td><TD valign="middle" width="100" nowrap><? echo $rs["品番"]."<br>";?></TD>
</tr>
<!--
<tr class='last'><td class='last'></td>
-->
</tr></tbody>