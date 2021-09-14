<?php 

function sec_henkou($s_id){

$NM_DB = $_COOKIE['DSN_Campany'];
// ①DB接続しSQLを発行してデータを取得
$dbh = get_db_connect($_COOKIE['DSN_Campany']);
$errs = array();
  
  $sqls="Select * from trans where mas_id=".$s_id." AND trans_PR = false ;";
  $rsC=Record_count($dbh,$sqls);

  if($rsC==0){
    $sec_henkou=false;
  }else{
    $sec_henkou=true;
  } 
return $sec_henkou;
} 

function nyukajouhou_henkou($s_id){
  $NM_DB = $_COOKIE['DSN_Campany'];
  // ①DB接続しSQLを発行してデータを取得
  $dbh = get_db_connect($_COOKIE['DSN_Campany']);
  $errs = array();
  
  $sqls="Select * from t_nyukajouhou where mas_id=".$s_id." AND trans_PR = false ;";
  $rsC=Record_count($dbh,$sqls);
  if($rsC==0){
    $nyukajouhou_henkou=false;
  }else{
    $nyukajouhou_henkou=true;
  } 
  return $nyukajouhou_henkou;
}
?>