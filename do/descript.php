<?php
  session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<META name="IBM:HPB-Input-Mode" content="mode/flm; pagewidth=750; pageheight=900">
<META http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>計測器管理システム（<? echo ("unam");?>）</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="./inc/login.css">

<LINK REL="stylesheet" TYPE="text/css" HREF="./inc/table_css.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="./inc/basic.css">

<script type="text/javascript" src="inc/form_submit.php"></script>

<script type="text/javascript">
function p_pdf(f_name)
{

	window.open("http://m-hidaka.info/_mmsystem"+f_name,f_name,
			"toolbar=yes,status=no,scrollbars=no,width=1000,height=800,left=50,top=30,resizable=yes") ;
}
function setCursor() {

var obj = document.getElementByid('text1'); //テキストボックスを指定
obj.focus();     //テキストボックスにフォーカスを移動
obj.value += ''; //テキストボックス内の文字列末尾にカーソルを移動

}

/****************************************************************
* 機　能： 入力された値が日付でYYYY/MM/DD形式になっているか調べる
* 引　数： datestr　入力された値
* 戻り値： 正：true　不正：false
****************************************************************/
function ckDate(datestr) {
    // 正規表現による書式チェック
    if(!datestr.match(/^\d{4}\/\d{2}\/\d{2}$/)){
        return false;
    }
    var vYear = datestr.substr(0, 4) - 0;
    var vMonth = datestr.substr(5, 2) - 1; // Javascriptは、0-11で表現
    var vDay = datestr.substr(8, 2) - 0;
    // 月,日の妥当性チェック
    if(vMonth >= 0 && vMonth <= 11 && vDay >= 1 && vDay <= 31){
        var vDt = new Date(vYear, vMonth, vDay);
        if(isNaN(vDt)){
            return false;
        }else if(vDt.getFullYear() == vYear && vDt.getMonth() == vMonth && vDt.getDate() == vDay){
            return true;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
</script>

<style type="text/css">
<?php
include "../inc/headmenu_css.css";
?>
</style>
<style media="print">
.noprint     { display: none }
</style>

</head>

<BODY onload=clock();>


<?php 
//'mode=8 その後の処理

include "../inc/clock.inc";
include "../inc/nocopy.inc";
include "../inc/login.inc";

include "../inc/hiduke_f.inc";
include "../inc/print.php";
include "../inc/kakunou.php";
?>

<HEADER>
<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>
<DIV id=sclock>
<p id="clock" lang="en">　</p>
</DIV>
</HEADER>

<DIV id="headmenu" class="noprint" >
<ul class="globalNav">
  <li class="triangle"><a href="#"></a></li>
<?php 
switch (("modori")){
  case 1:
    print "<li><a href='listing.php?".("back1")."#".$_GET["マスタID"]."'><strong>戻る</strong><span>back</span></a></li>";
    break;
  case 2:
    print "<li><a href='listing_kekka.php?".("back1")."#".$_GET["マスタID"]."'><strong>戻る</strong><span>back</span></a></li>";
    break;
  case 3:
    print "<li><a href='listing_yotei.php?".("back1")."#".$_GET["マスタID"]."'><strong>戻る</strong><span>back</span></a></li>";
    break;
} 
//'response.write session.contents("back")
?>

  <li><a href="search.php"><strong>検索メニュー</strong><span>search menu</span></a></li>
  <li><a href="menu.php"><strong>メニュー</strong><span>home menu</span></a></li>
  <li><a href="logout.php"><strong>ログアウト</strong><span>logout</span></a></li>
</ul>

</div>



<? 

if(strlen($_GET["マスタID"])!=0){
//'session.contents("マスタID")=Request.QueryString("マスタID")
//'else
  echo $_GET["マスタID"];
} 


// $db is of type "ADODB.Connection"
/*echo "Microsoft.Jet.OLEDB.4.0";
echo 1;
echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/imaster.mdb";
$a2p_connstr=;
$a2p_uid=strstr($a2p_connstr,'uid');
$a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$a2p_pwd=strstr($a2p_connstr,'pwd');
$a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$a2p_database=strstr($a2p_connstr,'dsn');
$a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
$db=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
mysql_select_db($a2p_database,$db);
*/
$SQL="SELECT * FROM iマスター WHERE マスタID=".("マスタID");
$rs=$rs_query=mysql_query(($SQL),$db);
$rs=mysql_fetch_array($rs_query);
;
$admin=$_SESSION[("admin")];
$ng=$_SESSION[("ng")];
$kigengirehyouji=$_SESSION("kigengirehyouji");
$detakakuninranhyouji=$_SESSION("detakakuninranhyouji");
?>


<DIV id=each>
<h1>
<?php
//'管理番号の組立
$keta=$rs["桁"];
$k_kigou=$rs["管理記号"]; 
if (!isset($k_kigou) || $k_kigou==""){
  $k_kigou="";
} 
$k_no=$rs["管理数字"]; 
if (!isset($k_no) || $k_no==""){
  $k_no="";
} 
$k_H_NO=$rs["管理補助数字"]; 
if(!isset($k_H_NO) || $k_H_NO==""){
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
  if($k_H_NO!=""){
    $KNO=$KNO."-".$k_H_NO;
  } 
  if ($k_h_KIGOU!=""){
    $KNO=$KNO."-".$k_h_KIGOU;
  } 
} 


if (!!isset($k_kigou)){
  print "<span style='font-size: 0.6em;vertical-align:top;'>ゲージ番号　：</span><span style='font-size: 1.8em;vertical-align:middle;margin-left : 20px;'>".$KNO."</span>";
}else{
  print "<caption>（管理番号がついていません）</caption>";
} 

//所番地の変更の有無
$sec_henkou0=$sec_henkou($rs["マスタID"]);
if($sec_henkou0){
  print "<p class='henkou_chu_r'>所番地 変更手続き中！！</p>";
} 


//入荷情報の変更の有無
$nyukajouhou_henkou0=$nyukajouhou_henkou($rs["マスタID"]);
if($nyukajouhou_henkou0){
  print "<p class=henkou_chu_b>入荷情報　変更手続き中！！</p>";
} 


//廃棄処理の有無
$ckdellist=$ck_dellist($rs["マスタID"]);
if(!!isset($ckdellist)){
  print "<p class='henkou_chu_g'>廃棄手続き中！！</p>";
} 

//復活処理の有無
$ckfukatsulist=$ck_fukatsulist($rs["マスタID"]);
if(!!isset($ckfukatsulist)){
  print "<p class='henkou_chu_br'>復活手続き中！！</p>";
} 
?>

</h1>
<TABLE class="ta2" CELLSPACING=0 onSelectStart="return false;" >
<?php
$sg=(int)(int)$rs["マスタID"]/100000;
include "../inc/icon_kigen.php";

echo $rs["マスタID"];

//1行目　 ?>
    <tr>
      <Th>名称</th>
      <Td><? echo $rs["全名称"];?></td>
      <Th><? echo $p1;?></td>
      <Td><? echo $rs["所番地1"];?></td>
      <Th>使用区分</th>
      <Td>
<?php 
if(!$_SESSION['$ng']){
  if( $rs['C_use'] = "未処置" ) {
    print "使用";
  }
}else{
  print $rs["使用区分"];
}
?>

</td></tr>
<tr>
<?php
//'2行目
  echo "<th>型式番号</th>"
      <Th><?=$p2;?></th>
      <Td>
<?php 
  if((strpos($rs["所番地2"],"　")>=0){
    $Ssec=explode("　",($rs["所番地2"]));
    $Ssec2=$Ssec[1]; //rs("所番地2")
  }else{
    $Ssec2=$rs["所番地2"];
  } 
  echo $Ssec2;
?>
      </td>
      <Th>検査周期</Th>
      <Td><?=$rs["検査周期"];?>　ヶ月</td>
    </tr>
    <tr><?php //3行目 ?>
      <Th>製造番号</th>
      <Td><?=$rs["製造番号"];?></td>
      <Th><?=$p3;?></th>
	<?php
    $P_P3=$rs["所番地3"];?>
      <Td><?=$p_p3;?></td>
      <Th>検査項目</Th>
      <Td><?=$rs["検査項目名"];?></td>
    </tr>

    <tr>   <?php //4行目 ?>
      <Th rowspan=3>サイズ</th>
      <Td rowspan=3>
<?php include "../inc/size_new.php";
  print $size;//st
?>
      </td>
      <Th><?=$p4;?></th>
	 <?php
      $P_P4=$rs["所番地4"];?>
      <Td><?=$p_p4;?></td>

<?php
if(!$nyukainfo){
?>
      <Th>登録年月日</th>
      <TD><?=$rs["登録年月日"];?></TD>
<?
}else{
?>
      <Th>納入日</th>
      <TD><?=$rs["納入日"];?></TD>
<?php
}?>
    </tr>
    <tr><?php //5行目 ?>
    <Th><?=$p5;?></th>
	 <?php
$P_P5=$rs["置き場1"];?>
    <Td><?=$p_p5;?></td>
    <Th>
<?php
if($admin){
?>
		 最新校正日
<?php
}else{
?>
		備考
<?php
} ?></th>
      <Td>
	<?php
if($admin){
?>
<?=$rs["最新校正日"];?>
<?php
}else{
?>
		<?=$rs["備考１"];?>
	<?php
} ?></td>
  </tr>
    <tr>　　<?php //6行目 ?>

      <Th>品番</th>

      <Td><?=$rs["品番"];?></td>
      <Th>
	<?php
  if($admin){
?>
		 備考
	<?php
}else{
?>
		備考2
	<?php
} ?></th>
      <Td>
<?php
if($admin){
?>
		 <?     echo $rs["備考1"];?>
	<?   }
    else
  {
?>
		<?     echo $rs["備考2"];?>
	<?   } ?></td>
    </tr>
</TABLE>
<!--

</TD>
</TR>

</TABLE>
-->


<DIV class="noprint">

<div class=detail_process>

<? 
?><? 

//<!--#include file=debug0.php --> デバグ用の領域

//処理の実行

  switch ($_POST["shori"])
  {
    case "変更(G)":
      $h=henkou_datousei($rs["所番地分類1"],$rs["所番地分類2"],$rs["所番地分類3"],$_POST["sec1"],$_POST["sec2"],$_POST["sec3"]);
      if ($h)
      {

        henkou(("マスタID"),$_POST["sec1"],$_POST["sec2"],$_POST["sec3"],$_POST["sec4"],$_POST["sec5"],$_POST["riyu"]);
        header("Location: "."descript.php");
      } 

      header("Location: "."descript.php?mode=4");
      break;
    case "入荷情報変更(G)":
//h=henkou_datousei_nyukajouhou(Request.form("sec3"))
      if ($isdate[$_POST["sec1"]])
      {

//response.redirect "debug.php?st1="&session.contents("マスタID")&Request.form("sec1")&Request.form("sec2")&Request.form("sec3")&Request.form("sec4")&Request.form("sec5")&Request.form("sec6")
        nyukajouhou_touroku(("マスタID"),$_POST["sec1"],$_POST["sec2"],$_POST["sec3"],$_POST["sec4"],$_POST["sec5"],$_POST["sec6"]);
        header("Location: "."descript.php");
      }
        else
      {

        header("Location: "."descript.php?mode=9"."&sec1=".$_POST["sec1"]."&sec2=".$_POST["sec2"]."&sec3=".
        $_POST["sec3"]."&sec4=".$_POST["sec4"]."&sec5=".$_POST["sec5"]."&sec6=".$_POST["sec6"]."&yarinaoshi=true");
      } 

//response.redirect "descript.php?mode=9"

      break;
    case "変更手続き取消":

?><!--#include file=debug1.php --><? 

      henkou_kaijo(("マスタID"));
      header("Location: "."descript.php");

      break;
    case "入荷情報変更手続き取消":

      henkou_kaijo_nyukajouhou(("マスタID"));
      header("Location: "."descript.php");


      break;
    case "キャンセル":
      header("Location: "."descript.php");
      break;
    case "廃棄(G)":
      $h=haiki_datousei($rs["マスタID"]);
      if ($h)
      {

        haiki(("マスタID"),$_POST["riyu"]);
        header("Location: "."descript.php");
      } 

      header("Location: "."descript.php?mode=5");
      break;
    case "廃棄手続き取消":
      haiki_kaijo(("マスタID"));
      header("Location: "."descript.php");
      break;
    case "復活(G)":
      $h=fukatsu_datousei($rs["マスタID"]);
      if ($h)
      {

        fukatsu(("マスタID"),$_POST["riyu"]);
        header("Location: "."descript.php");
      } 

      header("Location: "."descript.php?mode=6");
      break;
    case "復活手続き取消":
      fukatsu_kaijo(("マスタID"));
      header("Location: "."descript.php");
      break;
  } 


  switch ($_GET["mode"])
  {
    case 1//検査データ参照:
      $m1="1"; 
      $m2=""; 
      $m3=""; 
      $m9="";
      break;
    case 2//写真参照:
      $m1=""; 
      $m2=""; 
      $m3="1"; 
      $m9="";
      break;
    case 4//所番地変更:
      $m1=""; 
      $m2="1"; 
      $m3=""; 
      $m9="";
      break;
    case 9//入荷情報:
      $m1=""; 
      $m2=""; 
      $m3=""; 
      $m9="1";
      break;
  } 

  if ($_GET["mode"]==1 || $_GET["mode"]==2 || $_GET["mode"]==4 || $_GET["mode"]==9 || !isset($_GET["mode"]) || $_GET["mode"]=="")
  {

    print "<a class=process_data href='descript.php?マスタID=".rawurlencode($rs["マスタID"])."&mode=1'>検査データ参照</a>";
    if ($m_henkou)
    {

      print "<a class=process_data href='descript.php?マスタID=".rawurlencode($rs["マスタID"])."&mode=4'>所番地変更</a>";
    } 

    if ($nyukainfo)
    {

      print "<a class=process_data href='descript.php?マスタID=".rawurlencode($rs["マスタID"])."&mode=9'>入荷情報</a>";
    } 


    print "<a class=process_data href='descript.php?マスタID=".rawurlencode($rs["マスタID"])."&mode=2'>写真参照";
    print "<a class=process_data href='descript_p.php?マスタID=".rawurlencode($rs["マスタID"])."&mode=2'>印刷</a>";
  }
    else
  if ($_GET["mode"]==8)
  {

//Response.Write "<img src='img/sonogo.gif' border=0 alt='その後の処置'>"
  } 

?>
</div>
</div>







<? 
//検査データ参照
  if ($_GET["mode"]==1)
  {

    if ($sg<2)
    {
?>
		<!--#include file=ksd_inc.php -->
	<? 
    }
      else
    if ($sg>1)
    {
?>
		<!--#include file=kkd_inc.php -->
	<? 
    } 


//''管理区分コード履歴
?>
<!--#include file=kanri_rireki.php -->



<? 



  }
    else
  if ($_GET["mode"]==2)
  {
//写真参照

    if (!!isset($rs["管理数字"]))
    {

      $file_name=$rs["管理記号"].substr(str_repeat("0",$keta).($rs["管理数字"]),strlen(str_repeat("0",$keta).($rs["管理数字"]))-($keta));
      $pic_name=pic_exist($rs["管理記号"],$rs["管理数字"]);
    } 


?>
<div>
<? 
    if (strlen($pic_name)>0)
    {

?>
<img src='http://m-hidaka.info/_mmsystem/<?       echo $ID_kaishamei;?>/pic/<?       echo $pic_name;?>'  border="0" galleryimg="no" alt='<?       echo $pic_name;?>'>
<? 
    }
      else
    {

?>
<img src='http://m-hidaka.info/_mmsystem/img/JUNBICHU.gif' border=0 galleryimg="no" alt='写真なし'>

<?     } ?>

</dev>
<? 
  }
    else
  if ($_GET["mode"]==3)
  {
//pdf
?>
<div>
<OBJECT

classid="clsid:CA8A9780-280D-11CF-A24D-444553540000"

width="95%"

height="95%"

id=Pdf1>

<? 
    $file_name=file_exist($rs["管理記号"],$rs["管理数字"]);
    if (strlen($file_name)>0)
    {

?>
<PARAM name="SRC"

value="http://m-hidaka.info/_mmsystem/<?       echo $ID_kaishamei;?>/pdf/<?       echo $file_name;?>">
<?     }
      else
    {
?>
<PARAM name="SRC"

value="http://m-hidaka.info/_mmsystem/pdf/noting.pdf">
<?     } ?>


</OBJECT>
</div>

<? 
  }
    else
  if ($_GET["mode"]==4)
  {
//所番地変更
?>

<!--#include file=tokorobanchi_henkou.php -->

<? 
  }
    else
  if ($_GET["mode"]==5)
  {
//廃棄

?>

<!--#include file=master_sakujo.php -->

<? 
  }
    else
  if ($_GET["mode"]==6)
  {
//復活

?>

<!--#include file=master_fukatsu.php -->

<? 

  }
    else
  if ($_GET["mode"]==7)
  {
//解除

?>
<!--#include file=master_fukatsu_kaijo.php -->

<? 
  }
    else
  if ($_GET["mode"]==8)
  {
//その後の処置

?>
<!--#include file=sonogonoshochi.php -->

<? 
  }
    else
  if ($_GET["mode"]==9)
  {
//入荷情報

?>
<!--#include file=nyukajouhou.php -->

<?   } ?>





<? 
//'<div class="noprint">

//select case session.contents("modori")
//case 1
//response.write "<a href=""listing.php?" & session.contents("back1") & "#" & Request.QueryString("マスタID") & """><img id='photo' src='img/to_modoru.gif' border=0 alt='戻る'></a>"
//case 2
//response.write "<a href=""listing_kekka.php?" & session.contents("back1") & "#" & Request.QueryString("マスタID") & """><img id='photo' src='img/to_modoru.gif' border=0 alt='戻る'></a>"
//case 3
//response.write "<a href=""listing_yotei.php?" & session.contents("back1") & "#" & Request.QueryString("マスタID") & """><img id='photo' src='img/to_modoru.gif' border=0 alt='戻る'></a>"
//end select
//response.write session.contents("back")
?>


<? 
  
  mysql_close($db);
  $rs=null;

  $db=null;


  function fukatsu_kaijo($s_id)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="delete from fukatsu where mas_id=".$s_id."and import=false;";

    mysql_query(($sqls),$dbs);
    mysql_close($dbs);
    $dbs=null;


    return $function_ret;
  } 


  function henkou_kaijo($s_id)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="delete from trans where mas_id=".$s_id."and 進捗=false;";

    mysql_query(($sqls),$dbs);
    mysql_close($dbs);
    $dbs=null;


    return $function_ret;
  } 

  function henkou_kaijo_nyukajouhou($s_id)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="delete from t_nyukajouhou where mas_id=".$s_id."and 進捗=false;";

    mysql_query(($sqls),$dbs);
    mysql_close($dbs);
    $dbs=null;


    return $function_ret;
  } 

  function haiki_kaijo($s_id)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="delete from del where mas_id=".$s_id." and import=false;";

    mysql_query(($sqls),$dbs);
    mysql_close($dbs);
    $dbs=null;


    return $function_ret;
  } 




  function sechenkou_shutoku($s_id)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 1;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="Select * from trans where mas_id=".$s_id.";";

//response.redirect "debug.php?st1="&sqls
//set rss=dbs.execute(sqls)

    // $rss is of type "ADODB.Recordset"
    $rs=mysql_query($SQLs);

    $t1=$rss["sec1"];
    $t2=$rss["sec2"];
    $t3=$rss["sec3"];
    $t4=$rss["備考"];

    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;



    return $function_ret;
  } 

?>

<!--#include file=sec_henkou.php -->
<!--#include file=nyukajouhou_henkou.php -->
<!--#include file=ck_dellist.php -->
<!--#include file=ck_fukatsulist.php -->
<? 
  function henkou($s_id,$s1,$s2,$s3,$s4,$s5,$s6)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select Max(受付番号) as mcount from trans;";

    $rss=$rss_query=mysql_query(($sqls),$dbs);    
$rss=mysql_fetch_array($rss_query);
;
    if (!isset($rss["mcount"]))
    {

      $ukeban=1;
    }
      else
    {

      $ukeban=$rss["mcount"]+1;
    } 


    if ($s1=="")
    {
      $s1=null; 
    } 

    if ($s2=="")
    {
      $s2=null; 
    } 

    if ($s3=="")
    {
      $s3=null; 
    } 

    if ($s4=="")
    {
      $s4=null; 
    } 

    if ($s5=="")
    {
      $s5=null; 
    } 

    if ($s6=="")
    {
      $s6=null; 
    } 



    $SQLs2="INSERT INTO trans";
    $SQLs2=$SQLs2." (受付番号,mas_id,sec1,sec2,sec3,sec4,sec5,備考,受付年月日)";
    $SQLs2=$SQLs2." VALUES (".$ukeban.",".$s_id.",'".$s1."','".$s2."','";
    $SQLs2=$SQLs2.$s3."','".$s4."','".$s5."','".$s6."','".strftime("%m/%d/%Y %H:%M:%S %p")."')";
//response.redirect "debug.php?st1="&SQLs2

    mysql_query($SQLs2//,,adexecuteNoRecords,$dbs);    $str="<p>変更完了しました！</P>";

    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 

  function nyukajouhou_touroku($s_id,$s1,$s2,$s3,$s4,$s5,$s6)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select Max(受付番号) as mcount from t_nyukajouhou;";

    $rss=$rss_query=mysql_query(($sqls),$dbs);    
$rss=mysql_fetch_array($rss_query);
;
    if (!isset($rss["mcount"]))
    {

      $ukeban=1;
    }
      else
    {

      $ukeban=$rss["mcount"]+1;
    } 


    if ($s1=="")
    {
      $s1=null; 
    } 

    if ($s2=="")
    {
      $s2=null; 
    } 

    if ($s3=="")
    {
      $s3=null; 

    }
      else
    {
      $S3=doubleval($S3); 
    } 

    if ($s4=="")
    {
      $s4=null; 
    } 

    if ($s5=="")
    {
      $s5=null; 
    } 

    if ($s6=="")
    {
      $s6=null; 
    } 


//response.redirect "debug.php?st1="&s1&S2
    if (!!isset($s3))
    {

      $SQLs2="INSERT INTO t_nyukajouhou";
      $SQLs2=$SQLs2." (受付番号,mas_id,納入日,納入者コード,単価,製造社コード,受入証明コード,発注分類,納入情報備考,受付年月日)";
      $SQLs2=$SQLs2." VALUES (".$ukeban.",".$s_id.", '".$s1."','".$s2."',";
      $SQLs2=$SQLs2.$s3.",'".$s4."','".$s5."',".$s6.",'".$s7."','".strftime("%m/%d/%Y %H:%M:%S %p")."')";
    }
      else
    {

      $SQLs2="INSERT INTO t_nyukajouhou";
      $SQLs2=$SQLs2." (受付番号,mas_id,納入日,納入者コード,製造社コード,受入証明コード,納入情報備考,受付年月日)";
      $SQLs2=$SQLs2." VALUES (".$ukeban.",".$s_id.", '".$s1."','".$s2."','";
      $SQLs2=$SQLs2.$s4."','".$s5."',".$s6.",'".$s7."','".strftime("%m/%d/%Y %H:%M:%S %p")."')";

    } 

//response.redirect "debug.php?st1=" & SQLs2


    mysql_query($SQLs2//,,adexecuteNoRecords,$dbs);    $str="<p>変更完了しました！</P>";

    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 


  function haiki($s_id,$s1)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select Max(受付番号) as mcount from del;";

    $rss=$rss_query=mysql_query(($sqls),$dbs);    
$rss=mysql_fetch_array($rss_query);
;
    if (!isset($rss["mcount"]))
    {

      $ukeban=1;
    }
      else
    {

      $ukeban=$rss["mcount"]+1;
    } 


    $SQLs2="INSERT INTO del";
    $SQLs2=$SQLs2." (受付番号,mas_id,備考,受付日)";
    $SQLs2=$SQLs2." VALUES (".$ukeban.",".$s_id.",'".$s1."',#".strftime("%m/%d/%Y %H:%M:%S %p")."#)";

    mysql_query($SQLs2//,,adexecuteNoRecords,$dbs);    $str="<p>廃棄完了しました！</P>";

    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 


  function fukatsu($s_id,$s1)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 3;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select Max(受付番号) as mcount from fukatsu;";

    $rss=$rss_query=mysql_query(($sqls),$dbs);    
$rss=mysql_fetch_array($rss_query);
;
    if (!isset($rss["mcount"]))
    {

      $ukeban=1;
    }
      else
    {

      $ukeban=$rss["mcount"]+1;
    } 


    $SQLs2="INSERT INTO fukatsu";
    $SQLs2=$SQLs2." (受付番号,mas_id,備考,受付日)";
    $SQLs2=$SQLs2." VALUES (".$ukeban.",".$s_id.",'".$s1."',#".strftime("%m/%d/%Y %H:%M:%S %p")."#)";

    mysql_query($SQLs2//,,adexecuteNoRecords,$dbs);    $str="<p>復活完了しました！</P>";

    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 







  function kigen_out($a,$b,$c)
  {
    extract($GLOBALS);


    if ($datevalue[$b]>$datevalue[$getsumatsu[$DateAdd["m"][$c][$a]]])
    {

      $function_ret=true;
    }
      else
    {

      $function_ret=false;
    } 

    return $function_ret;
  } 



  function file_exist($a,$b)
  {
    extract($GLOBALS);


    if (!!isset($a) && !!isset($b))
    {

      $SQLs="SELECT * FROM iｐｄｆ WHERE 管理記号='".$a."' AND 管理数字=".$b." ";
    }
      else
    if (!isset($b))
    {

      $SQLs="SELECT * FROM iｐｄｆ WHERE 管理記号='".$a."' ";
    } 


    // $rs_file is of type "ADODB.Recordset"
    $rs=mysql_query($SQLs);

    if (mysql_num_rows($rs_file_query)>0)
    {

      $function_ret=$rs_file["ファイル名"];
    }
      else
    {

      $function_ret="";
    } 


    
    $rs_file=null;


    return $function_ret;
  } 

  function pic_exist($a,$b)
  {
    extract($GLOBALS);


    $SQL="SELECT * FROM i写真情報 WHERE 管理記号='".$a."' and 管理数字=".$b." and 写真分類コード='2'";
    // $rs_file is of type "ADODB.Recordset"
    $rs=mysql_query($SQL);

    if (mysql_num_rows($rs_file_query)>0)
    {

      $function_ret=$rs_file["写真NO"];
//pic_name=rs_file("写真NO")
    }
      else
    {

      $function_ret="";
    } 

    
    $rs_file=null;


    return $function_ret;
  } 

  function henkou_datousei($s1,$s2,$s3,$ss1,$ss2,$ss3)
  {
    extract($GLOBALS);



    if (!isset($s1))
    {
      $s1=""; 
    } 

    if (!isset($s2))
    {
      $s2=""; 
    } 

    if (!isset($s3))
    {
      $s3=""; 
    } 

    if (!isset($ss1))
    {
      $ss1=""; 
    } 

    if (!isset($ss2))
    {
      $ss2=""; 
    } 

    if (!isset($ss3))
    {
      $ss3=""; 
    } 


    $c_hanei=0;
    if ($s1!=$ss1)
    {
      $c_hanei=1; 
    } 

    if ($s2!=$ss2)
    {
      $c_hanei=1; 
    } 

    if ($s3!=$ss3)
    {
      $c_hanei=1; 
    } 


    if ($c_hanei==1)
    {

      $function_ret=true;
    }
      else
    {

      $function_ret=false;
    } 


    return $function_ret;
  } 

  function haiki_datousei($a)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 1;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select * from del where mas_id=".$a.";";
    // $rss is of type "ADODB.Recordset"
    $rs=mysql_query($SQLs);

    if (mysql_num_rows($rss_query)==0)
    {

      $function_ret=true;
    }
      else
    {

      $function_ret=false;
    } 


    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 

  function fukatsu_datousei($a)
  {
    extract($GLOBALS);


    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 1;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select * from fukatsu where mas_id=".$a.";";
    // $rss is of type "ADODB.Recordset"
    $rs=mysql_query($SQLs);

    if (mysql_num_rows($rss_query)==0)
    {

      $function_ret=true;
    }
      else
    {

      $function_ret=false;
    } 


    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 

  function transe_code($a1,$a2,$a3,$a4,$a5)
  {
    extract($GLOBALS);

//コード番号を項目に変更
//a1 データベース名
//a2 テーブル名
//a3 比較フィールド名
//a4 コードno
//a5 抽出フィールド

    // $dbs is of type "ADODB.Connection"
        echo "Microsoft.Jet.OLEDB.4.0";
        echo 1;
        echo $DOCUMENT_ROOT."./cgi-bin/mydb/".$ID_kaishamei."/".$a1;
    $a2p_connstr=;
    $a2p_uid=strstr($a2p_connstr,'uid');
    $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_pwd=strstr($a2p_connstr,'pwd');
    $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $a2p_database=strstr($a2p_connstr,'dsn');
    $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
    $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
    mysql_select_db($a2p_database,$dbs);

    $sqls="select * from ".$a2."  where ".$a3."='".$a4."';";
    // $rss is of type "ADODB.Recordset"
    $rs=mysql_query($SQLs);

    if (mysql_num_rows($rss_query)==0)
    {

      $function_ret=false;
    }
      else
    {

      $function_ret=$rss[$a5];
//response.redirect "debug.php?st1="&transe_code

    } 


    
    mysql_close($dbs);
    $rss=null;

    $dbs=null;


    return $function_ret;
  } 
?>
<!--#include file=inc/uni_func.php -->
<!--#include file=inc/f_format.inc -->

</BODY>
</html>
} 

