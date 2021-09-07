<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

<?php 
require_once('../inc/config.php');
require_once('../helpers/db_helper.php');
require_once('../helpers/extra_helper.php');
include '../inc/login_inc.php';
?>

<META name="IBM:HPB-Input-Mode" content="mode/flm; pagewidth=750; pageheight=900">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/basic.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/menu_css.css">
<title>測定器管理台帳支援システム（<?php echo $_SESSION['unam']; ?>）</title>
</head>
<style type="text/css">

<!-- #include file=inc/menu_css.css -->
</style>

<script type="text/javascript">
<!--
function manual_pdf()
{
	window.open("http://m-hidaka.info/_mmsystem/manual/mm-system_admin.pdf","manual","toolbar=yes,status=no,scrollbars=no,width=600,height=450,left=50,top=30")
}
function manual_pdf()
{
	window.open("http://m-hidaka.info/_mmsystem/manual/mm-system_admin.pdf","manual","toolbar=yes,status=no,scrollbars=no,width=600,height=450,left=50,top=30")
}
//-->
</script>
<?php

include '../inc/clock.inc';
include '../inc/kakunou.php';
;
?>
<BODY oncontextmenu="return false;" onload="clock();">
<div class="wrapper">
<HEADER>
<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>
<DIV id=sclock>
<p id="clock" lang="en"></p>
</DIV>
</HEADER>

<center>




<div class=menu_container>

<DIV class=menuboxes >
<?php




//入力データの反映調査
if(isset($_SESSION['hanei'])){
//hanei;
}
//['m_shinkisakusei'].'//'.$_SESSION['new']);
if(($_SESSION['m_shinkisakusei'])){
 	if($_SESSION['new']){
		echo "<div class=menubox><a CLASS='login bgc1' href=new.php?hyouji_mode=10>新規登録</a></div>";
 	}
}
if(($_SESSION['kensaku'])){
	echo "<div class=menubox><a class='login bgc2' href=search.php>検索</a></div>";
}
//If is_null(($_SESSION[''menu5']) Then
	echo "<div class=menubox><a class='login bgc3' href='ins.php?mode=1'>定期検査<br>報告書</a></div>";
//End If
//If is_null(($_SESSION("menu6")) Then
	echo "<div class=menubox><a class='login bgc3' href=ins.php?mode=2>校正<br>証明書</a></div>";
//End If
//If is_null(($_SESSION("menu7")) Then
	echo "<div class=menubox><a class='login bgc4' href=ins.php?mode=3>トレーサビリティ<br>体系図</a></div>";
//End If
	echo "<div class=menubox><a class='login bgc5' href=javascript:manual_pdf()>ユーザー<br>マニュアル</a></div>";
if(($_SESSION['mas_info']) && isset($_SESSION['mas_info'])){
	echo "<div class=menubox><a class='login bgc6' href=master_info.php?s_mode=9&h_mode=0&shori_mode=0>マスター<br>情報管理</a></div>";
}
if(($_SESSION['henkou_kanri']) && isset($_SESSION['mas_info'])){
	echo "<div class=menubox><a class='login bgc7' href=henkou_kanri.php>変更管理</a></div>";
}
if(($_SESSION['admin'])){
	echo "<div class=menubox><a class='login bgc8' href=usr.php>ユーザー情報</a></div>";
}
echo "<div class=menubox><a class='login bgc9' href=logout.php>ログアウト</a></div>";
//Response.Write "</ol>"
?>
</DIV><!--/*menuboxes*/-->
<div class=menu_info>
<DIV class="title">
<h1 class="menutitle">
<?php echo $_SESSION['kaishamei'] ;?> 様</h1>
<h2>使用者名：<?php echo $_SESSION['unam']; ?> 様</h2>
<h2>管理責任者：<?php echo $_SESSION['tantouin'];?> 様</h2>
</DIV><!-- /*title*/-->
<div class=whatsnew>
<?php
//error_log("aaa".$_COOKIE['DSN_Company'],"3","./debug.log");
    $dbh = get_db_connect($_COOKIE['DSN_Campany']);//db_***に接続
    $errs = array();
//echo $errs;	
	$sql='SELECT * FROM tb_info WHERE ID_Customer = "'.$_COOKIE['campany'].'" and (((content_classification)="新着情報") AND ((INFO_notice_presence)="1")) ORDER BY INFO_date DESC;';
$stmt = $dbh->query($sql);
	
?>


<!-- <h2>新着情報</h2> -->
<p class=ta_info >お知らせ</p>



<?php
While($row = $stmt->fetch(PDO::FETCH_ASSOC)){

	if(($_SESSION['admin'])){

		if(($row['INFO_mark_presence'])){
			echo '<p class="date new">';
		}else{
	    	echo '<p class="date">';
		}
  
   		echo $row['INFO_date'].'</p>';
   		echo '<span class=contents>'.$row['INFO_content'].'</span>';
  
	}else{
		if(($row['INFO_mark_presence'])){
	   		echo '<p class="date new">';
	}else{
		echo '<p class="date">';
	}
		echo $row['INFO_date'].'</p>';
		echo '<span class=contents>'.$row['INFO_content'].'</span>';
	}



}

//Sessionデータの格納（クリア）
//session_destroy();

?>
</table>
</div> <!--/*whatsnew*/-->
</div> <!--/*menu_info*/-->
</div> <!--/*class=menu_container*/-->
</center>
<?php

include '../inc/footer.php' ;
//include 'inc/hanei.php';
?>

</div><!--/*class="wrapper"*/-->
</BODY>
</html>
