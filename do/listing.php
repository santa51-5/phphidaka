
<?php 
	require_once('../inc/config.php');
	require_once('../helpers/db_helper.php');
	require_once('../helpers/extra_helper.php');
	include '../inc/login_inc.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<? // asp2php (vbscript) converted on Sun Jun 13 20:43:59 2021
 ?>

<html>
<HEAD>
<META name="IBM:HPB-Input-Mode" content="mode/flm; pagewidth=750; pageheight=900">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>測定器管理台帳支援システム（<?php echo $_SESSION["unam"];?>）</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/basic.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/listing_css.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/headmenu_css.css">


<style media="print">
.noprint     { display: none }
</style>

<!--#include file=./inc/clock.inc -->
<!--#include file=./inc/nocopy.inc -->
<!--#include file=inc/login.inc -->

<script src="inc/calendarlay.js" language="JavaScript"></script>
<SCRIPT TYPE="text/JavaScript">
<!--
function allchecks(){
  var elem = document.f1.checks;

  if(elem.length) {
    for(i = 0; i < elem.length; i++)
      elem[i].checked = true;
  }
}

function ope(mokuteki,s_id){
 switch (mokuteki) {
 case 1:
    location.href = 'descript.php?マスタID='+s_id+'&mode=4&modori=1';break;
 case 2:
    location.href = 'descript.php?マスタID='+s_id+'&mode=5&modori=1';break;
 case 3:
    location.href = 'descript.php?マスタID='+s_id+'&mode=6&modori=1';break;
 case 4:
    location.href = 'descript.php?マスタID='+s_id+'&mode=7&modori=1';break;
 }
}
-->
</SCRIPT>
</HEAD>
<?php
include '../inc/clock.inc';
include '../inc/kakunou.php';
include '../inc/nocopy.inc';
//include '../inc/login.inc';
?>

<BODY onload="clock();">
<div class=wrapper>
<HEADER>
<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>
<DIV id=sclock>
<p id="clock" lang="en">　</p>
</DIV>

</HEADER>

<?php
include '../inc/headmenu_listing.inc';
include '../inc/print.php';
include '../inc/hiduke_f.inc';

//データの格納
$kikan="#2001/04/01"; //期間
$admin=$cbool[("admin")]; //管理者
$ng=$cbool[("ng")]; //ng表示
$jidou=$cbool[("jidou")]; //自動作成
$u_haiki=$cbool[("sakujo")]; //廃棄権限
$u_henkou=$cbool[("henkou")]; //変更権限

// search.aspからのデータ

$flag=false;

/* $db is of type "ADODB.Connection"
echo "Microsoft.Jet.OLEDB.4.0";
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
$SQL="SELECT 管理記号,管理数字,管理補助記号,管理補助数字,製造番号,全名称,所番地分類1,所番地分類2,所番地1,所番地2,最小値,最大値,目量,"
  ."サイズ,通り側,止まり側,登録年月日,備考1,型式,所番地3,所番地分類3,所番地分類4,最新校正日,次回校正日,マスタID,検査周期,型式番号,型式コード,"
  ."器物分類コード,寸法２,使用区分コード,使用区分,桁,器物分類名,isize,レベル,置き場1,置き場2,品番 FROM iマスター ";


//フォームからのデータがない場合
if($_POST==""){
  
}elseif($_POST["Y1_YDATE"]!="" || $_POST["Y1_kiDATE"]!=""){
  //校正予\定と期限切れの年月欄に入力されている場合の処理
  $HAJIME = $_POST["Y1_kiDATE"]."/".$_POST["M1_kiDATE"]."/"."10";
  $OWARI = $_POST["Y2_kiDATE"]."/".$_POST["M2_kiDATE"]."/"."10";
  //入力データが日付ではなかった場合
  if (!$isdate[$hajime] || !$isdate[$owari])  {
    header("Location: "."search.php");
  } 
  switch ($_POST["kigen"]){
    case "期限切れ":
    case "期限切れ集計":
      $sql1="次回校正日 BETWEEN #".date('Y-m-d', strtotime('first day of ' . "20".$_POST["Y1_kiDATE"]."/".$_POST["M1_kiDATE"]))."# AND #".date('Y-m-d', strtotime('first day of ' . "20".$_POST["Y2_kiDATE"]."/".$_POST["M2_kiDATE"]))."# ";
      break;
    case "取消":
      unset($_SESSION["Y1_YDATE"]);
      unset($_SESSION["M1_YDATE"]);
      unset($_SESSION["kigen_haiki"]);
      unset($_SESSION["kigen_mishochi"]);
      unset($_SESSION["Y1_kiDATE"]);
      unset($_SESSION["M1_kiDATE"]);
      unset($_SESSION["Y2_kiDATE"]);
      unset($_SESSION["M2_kiDATE"]);
      header("Location: ".SITE_URL."search.php");
      
      break;
    default: //校正予定の場合
      $M=date("y-m-d",strtotime("20".$_POST["y1_YDATE"]."/".$_POST["m1_ydata"]."/01"." -1 month"));
      $sql1 = "次回校正日<#".date("Y/m/d",strtotime("last day of ".$M))."# ";
      break;
  } 

//使用
  if(!$_POST["kigen_mishochi"] && !$_POST["kigen_haiki"]){
    $SQL1 .= "AND ";
    $SQL1 .= "使用区分コード='1' ";
  } 


//未処置
  if($_POST["kigen_mishochi"]){
    $SQL1 .= "AND ";
    $SQL1 .= "使用区分コード='4' ";
  } 
//廃棄
  if($_POST["kigen_haiki"]){
    $SQL1 .=  "AND ";
    $SQL1 .= "使用区分コード= '3' ";
  } 

//SESSIONへ格納
  $_SESSION['Y1_kiDATE']= $_POST["Y1_kiDATE"];
  $_SESSION['M1_kiDATE']= $_POST["M1_kiDATE"];
  $_SESSION['Y2_kiDATE']= $_POST["Y2_kiDATE"];
  $_SESSION['M2_kiDATE']= $_POST["M2_kiDATE"];
  $_SESSION['kigen_haiki']= $_POST["kigen_haiki"];
  $_SESSION['kigen_mishochi']= $_POST["kigen_mishochi"];

  $SQL1 = " where ".$sql1;

  $_SESSION['back'] = $sql1;

  if($_POST["kigen"]=="期限切れ集計" || $_POST["kigen"]=="集計"){
    $_SESSION['SHUKEI_MODE']= 4;
    header("Location: ".SITE_URL."TABLE.php");
  } 


}else{
  //追加ボタンからの処理
  $SQL1=("back");
  //response.redirect "debug.asp?st1="&SQL & "--1---" & sql1
} 

include "../inc/paging.php";

$sql1 = $_SESSION["back"];
$SQL0 = $SQL.$sql1." order by ".$strOrderBy.";";
error_log($SQL1,"3","./debug.log");

$NM_DB = $_COOKIE['DSN_Campany'];
// ①DB接続しSQLを発行してデータを取得
$dbh = get_db_connect($_COOKIE['DSN_Campany']);
$errs = array();



$rs=Record_Load($dbh,$SQL0);


//ページネーション初期設定
$intPageCount=1;
$count = Record_count($dbh,$SQL0);//54; // データの総数
$perPage = 10; // １ページあたりのデータ件数 $intPageSize
$totalPage = ceil($count / $perPage); // 最大ページ数

//end if
//開始位置＋最大表示件数が最大ページ数を超えていた場合
if ($intPageCurrent>$intPageCount){
  $intPageCurrent=$intPageCount;
} 
//開始位置が０以下の場合１に設定する
if ($intPageCurrent<1){
  $intPageCurrent=1;
} 
?>


<div id=detail_header>
<DIV class="triangle1"></div>

<? 
print "<p class='hm_title1'>検索結果</p>";
//response.redirect "debug.asp?st1="&sql0&"       "& admin
if ($count>0){
  print "<p class='hm_title2'>該当件数：　<strong>".mysql_num_rows($rs_query)."</strong> 件</p>";
  //Recordset オブジェクト内のカレントレコードのページを設定します
  echo $intPageCurrent;
  //データの格納
  echo 1;
  echo "page=".$intPageCurrent."&pagesize=".$intPageSize."&pl_start=".$pl_start."&order=".$strOrderBy;

  //復活解除手続
  if ($_GET["mode"]=="7"){
    $fukatsu_kaijo[$_GET["マスタID"]];
  } 
  ?>

  <? 
  //検索条件表\示
  // <!--#include file=chushutsu.asp-->
  ?>


  </DIV>


<!--#include file=inc/list_search.php -->


<DIV ID="detail" class="ta_list nocopy" >

<!--

<TABLE>
<TR><TD>
-->
<FORM NAME=f1 action=addchecklist.php method=post>
<!--

</TD></TR>


<TR><TD>
-->

<TABLE>
<thead>
   <tr>
<? //------------- ?>
	<TH rowspan=2 width=30>オペ</TH>
	<TH rowspan=2 width=80>管理番号</TH>
	<TH width=150>測定器名</TH>
	<th width=150><?   echo $p1;?>/<?   echo $p2;?></th>
	<TH rowspan=2 width=150>サイズ</TH>
	<TH width=100>登録年月日</TH>
	<th colspan=2 rowspan=2 width=300>備考</th>
   </tr>
   <tr>
	<Th width=150 class=ta_list_kai>製造番号</TH>
	<th width=150><?   echo $p3;?>
  <? 
  if ($mas_info_s5)
  {

    print "/".$p5;
  } 

?>
  </th>
	<?   if ($ADMIN)
  {
?>
	<TH width=100>最新校正日<br></TH>
	<?   }
    else
  {
?>
	<TH width=100>校正周期<br></TH>
	<?   } ?>
    </tr>
</thead>
   <tbody>
<? 
  echo 0;
  while($intRecordsShown<$intPageSize && !($rs==0))
  {



    if ($rs["レベル"]<2 || !isset($rs["レベル"]))
    {
//レベル表\示の判別



      $akahyouji=false;

      if ($rs["最新校正日"]<$kikan && ("ID_kaishamei")=="mannou")
      {

        $akahyouji=true;
      } 


//if akahyouji then
//if admin then ?>
			<!--#include file=listing_1.php -->
		<? 
//end if
//else
?>

<? //if rs("管理記号")="N" and rs("管理数字")=1041 then
//response.redirect "debug.asp?st1="&session.contents("ID_kaishamei")&"       "& akahyouji&rs("管理記号") & rs("管理数字")
//response.write "<td>123</td>"
//end if ?>



		<? //<!--#include file=listing_1.asp --> ?>

	<? //end if 'akahyouji ?>

	<? 

      $intRecordsShown=$intRecordsShown+1;
      $tbodycolor=$not$tbodycolor;

    } 
//レベル表\示の判別

    $rs=mysql_fetch_array($rs_query);

  } 
?>


<? 
  
?>


<? 
  mysql_close($db);

  $rs=null;

  $db=null;


?>
</td>
</tr>
</tbody>
</table>



<!--

</TD></TR>
-->
</form>
<!--

</TABLE>
-->

</DIV>
<br>


<br>




<? }
  else
{
?>
<? 
  print "該当するデータはありませんでした";
  print "<A HREF='search.php'>戻る</A>";

} 

?>
<!--#include file=henkou.php -->

<!--#include file=ck_dellist.php -->

<!--#include file=ck_fukatsulist.php -->



<!--#include file=inc/footer.php -->
</div>
</BODY>
</html>

