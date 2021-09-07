<html>
<head>
  <META name="IBM:HPB-Input-Mode" content="mode/flm; pagewidth=750; pageheight=900">
  <META http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
  <LINK REL="stylesheet" TYPE="text/css" HREF="../inc/basic.css">
  <LINK REL="stylesheet" TYPE="text/css" HREF="../inc/menu_css.css">

  <title>測定器管理台帳支援システム（<?php $_COOKIE['ID_Customer'] ;?>）
  </title>
  </head>

<?php 
session_start();
include '../inc/clock.inc';
//include '../inc/kakunou.php';
?>

<BODY oncontextmenu="return false;" onload="clock();">
<div class="wrapper">
<HEADER>

<?php
require_once('../inc/config.php');
require_once('../helpers/db_helper.php');
require_once('../helpers/extra_helper.php');
?>

<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>
<DIV id=sclock>
<p id="clock" lang="en">　</p>
</DIV>
</HEADER>

<div class=contents>
<?php
    //データベース接続
    $dbh = get_db_connect($_COOKIE['DSN_Company']);//_Campany();//db_***
    $errs = array();

if($_POST['mode']){
  insert_log_data2($dbh, $_COOKIE['ID_Customer'],'logout',"期限切れログアウト", $_COOKIE['ID_Customer']);
}else{
  insert_log_data2($dbh, $_COOKIE['ID_Customer'],'logout',"通常ログアウト", $_COOKIE['campany']);
}

echo '<h1>ログアウト</h1>' 
?>

<div class=ms_timemout>
<p>再度ログインを行ってください</p>
<p>ログイン日時　　：<?php echo GetPREVLOG();?></p>
<p>ログアウト日時　：<?php echo date('Y-m-d H:i:s')."<br/>\n"; ?></p>

<?php 
    $_SESSION = array();

    if (isset($_COOKIE["PHPSESSID"])) {
        setcookie("PHPSESSID", '', time() - 1800, '/');
    }

    session_destroy();
//$_SESSION_DES;
?>

</div>
<?php
echo '<div class=TOlogin><a onclick=location.href="../'.$_COOKIE['campany'].'/index.php">ログイン画面へ</a>';
?>
</div>
</div>
<?php include '../inc/footer.php'; ?>
</div>
</body>
</html>

