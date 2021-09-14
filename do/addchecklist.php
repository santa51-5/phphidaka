
<!--#include file=inc/kakunou.php -->
<?php 

if($_POST["SUB"]=="追加"){
    addcheck($_POST["checks"]);
}elseif($_POST["SUB"]=="一覧表\表\示"){
  header("Location: "."checklist.php?action=list");
} 
switch (("modori")){
  case 1:
    header("Location: "."listing.php?".("back1"));//& " #" & request.form("checks")(request.form("checks").count)
    break;
  case 2:
    header("Location: "."listing_kekka.php?".("back1"));//& " #" & request.form("checks")(request.form("checks").count)
    break;
  case 3:
    header("Location: "."listing_yotei.php?".("back1"));//& " #" & request.form("checks")(request.form("checks").count)
    break;
} 

function addcheck($cb){
  extract($GLOBALS);
  // $dbs is of type "ADODB.Connection"
    echo "Microsoft.Jet.OLEDB.4.0";
    echo 3;
    echo $DOCUMENT_ROOT."../cgi-bin/mydb/".$ID_kaishamei."/inew.mdb";
  $a2p_connstr=;
  $a2p_uid=strstr($a2p_connstr,'uid');
  $a2p_uid=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
  $a2p_pwd=strstr($a2p_connstr,'pwd');
  $a2p_pwd=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
  $a2p_database=strstr($a2p_connstr,'dsn');
  $a2p_database=substr($d,strpos($d,'=')+1,strpos($d,';')-strpos($d,'=')-1);
  $dbs=mysql_connect("localhost",$a2p_uid,$a2p_pwd);
  mysql_select_db($a2p_database,$dbs);

  for ($i=1; $i<=$cb->count; $i=$i+1){
    $sqls="select * from temp where (mid=".intval($_POST["checks"]($i)).");";
    // $rss is of type "ADODB.Recordset"
    $rs=mysql_query($SQLs);
    $sss=mysql_num_rows($rss_query);
    $rss=null;
    print $sss;
    if($sss==0){
      $SQLs2="INSERT INTO temp ";
      $SQLs2=$SQLs2."(mid)";
      $SQLs2=$SQLs2." VALUES (".intval($cb[$i]).");";
      mysql_query($SQLs2,$dbs);
    } 
  }
  mysql_close($dbs);
  $dbs=null;
  return $function_ret;
} 
?>



