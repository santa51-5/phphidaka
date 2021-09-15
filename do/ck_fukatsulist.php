<?php 
function ck_fukatsulist($s_id){
  $NM_DB = $_COOKIE['DSN_Campany'];
  // ①DB接続しSQLを発行してデータを取得
  $dbh = get_db_connect($_COOKIE['DSN_Campany']);
  $errs = array();
    
  $sqls="Select * from tb_fukatsu where master_id='$s_id' AND import = false ;";
  $rsC=Record_count($dbh,$sqls);

  if($rsC==0){
    $function_ret=null;
  }else{
    $function_ret="復活手続中！";
  } 
  return $function_ret;
} 
?>

