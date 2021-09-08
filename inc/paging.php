<?php
//http://d.hatena.ne.jp/shenghuo/20090320/1237532558　参考
//PAGE(現在のページの決定)

if((strlen($_GET["page"])==0 && strlen($_POST["jump"])==0) || strlen($_POST["setting"])>0){
  $intPageCurrent=1;
}elseif(strlen($_POST["jump"])>0){
  $intPageCurrent=intval($_POST["jump"]); //
}else{
  $intPageCurrent=intval($_GET["page"]); //前次のページ移動
} 

//PAGESIZE(ページサイズの決定)
if(strlen($_GET["pagesize"])==0){
  if(strlen($_POST["pagesize"])==0){
    $intPageSize=10;
  }elseif(strlen($_POST["pagesize"])>0){
    $intPageSize=intval($_POST["pagesize"]);
  } 
}else{
  $intPageSize=intval($_GET["pagesize"]);
} 

//pl_start(ページリストの頭決定)
if (strlen($_GET["pl_start"])==0){
  $pl_start=0;
}else{
  $pl_start=intval($_GET["pl_start"]);
} 
if(strlen($_POST["jump"])>0){
  $pl_start=$fix[$_POST["jump"]/10]*10;
} 

//order(並べ替え決定) order3,order5
if (strlen($_POST["order1"])>0){
  if ($_POST["order1"]=="管理番号"){
    $strOrderBy="M_ID1 ".$_POST["order2"].",M_ID2 ".$_POST["order2"].",M_ID3 ,M_ID4 ";
  }else{
    $strOrderBy=$_POST["order1"]." ".$_POST["order2"];
  } 
  $_SESSION["order1"] = $_POST["order1"];
  $_SESSION["order2"] = $_POST["order2"];
} 
error_log($strOrderBy,"3","./debug_strOrderBy.log");

if(strlen($_POST["order3"])>0){
  if($_POST["order3"]=="管理番号"){
    $strOrderBy=$strorderby.",M_ID1 ".$_POST["order4"].",M_ID2 ".$_POST["order4"].",M_ID3,M_ID4 ";
  }else{
    $strOrderBy=$strorderby.",".$_POST["order3"].$_POST["order4"];
  }
  $_SESSION["order3"] = $_POST["order3"];
  $_SESSION["order4"] = $_POST["order4"];
} 

if (strlen($_POST["order5"])>0){
  if ($_POST["order5"]=="管理番号"){
    $strOrderBy=$strorderby.",M_ID1 ".$_POST["order6"].",M_ID2 ".$_POST["order6"].",M_ID3,M_ID4 ";
  }else{
    $strOrderBy=$strorderby.",".$_POST["order5"].$_POST["order6"];
  } 
  $_SESSION["order5"] = $_POST["order5"];
  $_SESSION["order6"] = $_POST["order6"];
} 

if (strlen($_GET["order"])>0 && strlen($strOrderBy)==0){
  $strOrderBy=$_GET["order"];
} 
if (strlen($strOrderBy)==0 || $_POST["setting"]=="リセット"){
  $strOrderBy="M_ID1,M_ID2,M_ID3,M_ID4";
} 

//response.redirect "debug.asp?st1="&request.form("order1")&":"&request.form("order3")&":"&request.form("order5")&":"&strorderby&"→"&request.form("setting")

//データ格納
if(strlen($_GET["page"])>0 || !!isset($_GET["page"])){
  $_SESSION["page"] = $_GET["page"];
} 
if(strlen($_GET["pagesize"])>0 || !!isset($_GET["pagesize"])){
  $_SESSION["pagesize"] = $_GET["pagesize"];
} 

if(strlen($_GET["order"])>0 || !!isset($_GET["order"])){
  $_SESSION["order"] = $_GET["order"];
} 

if($_POST["setting"]=="リセット"){
  unset($_SESSION['order1']);
  unset($_SESSION['order2']);
  unset($_SESSION['order3']);
  unset($_SESSION['order4']);
  unset($_SESSION['order5']);
  unset($_SESSION['order6']);
  $_SESSION["page"] = 1 ;
  $_SESSION['pagesize'] = 10;
} 
?>

