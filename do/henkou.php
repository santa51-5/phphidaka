<?php 

function sec_henkou($s_id){

$NM_DB = $_COOKIE['DSN_Campany'];
// ①DB接続しSQLを発行してデータを取得
$dbh = get_db_connect($_COOKIE['DSN_Campany']);
$errs = array();
  
  $sqls="Select * from tb_trans where master_id='$s_id' AND trans_PR = false ;";
  $rsC=Record_count($dbh,$sqls);

  if($rsC==0){
    $function_ret=false;
  }else{
    $function_ret=true;
  } 
return $function_ret;
} 

function nyukajouhou_henkou($s_id){
  $NM_DB = $_COOKIE['DSN_Campany'];
  // ①DB接続しSQLを発行してデータを取得
  $dbh = get_db_connect($_COOKIE['DSN_Campany']);
  $errs = array();
  
  $sqls="Select * from tb_nyukajouhou where master_id='$s_id' AND nyuka_PR = false ;";
  $rsC=Record_count($dbh,$sqls);
  if($rsC==0){
    $function_ret=false;
  }else{
    $function_ret=true;
  } 
  return $function_ret;
}
?>