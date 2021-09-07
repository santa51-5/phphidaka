<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php ini_set('display_errors', "On")?>

<html>
<?php
require_once('../inc/config.php');
require_once('../helpers/db_helper.php');
require_once('../helpers/extra_helper.php');

include '../inc/login_inc.php';
?>

<HEAD>
<META name="IBM:HPB-Input-Mode" content="mode/flm; pagewidth=750; pageheight=900">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>測定器管理台帳支援システム（<?php echo $_SESSION['unam']; ?>）</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/basic.css">

<style type="text/css">
<?php
include '../inc/css.css';
include '../inc/table_css.css';
include '../inc/headmenu_css.css';
?>
</style>
<?php
include '../inc/nocopy.inc';
?>

<script type="text/javascript">
<!--
function p_pdf(f_name){
	window.open("http://m-hidaka.info/_mmsystem"+f_name,f_name,
			"toolbar=yes,status=no,scrollbars=no,width=1000,height=800,left=50,top=30,resizable=yes")
}
//-->
</script>
</HEAD>
<BODY onload=copy_r();clock();>
<?php
include '../inc/nocopy.inc';
include '../inc/clock.inc';
include '../inc/hiduke_f.inc';
include '../inc/kakunou.php';
?>

<HEADER>
<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>
<DIV id=sclock>
<p id="clock" lang="en">　</p>
</DIV>
</HEADER>
<?php include '../inc/headmenu.inc';

$_flag =False;
if(isset($_GET['mode'])){
	$_SESSION['shorui_mode'] = $_GET['mode'];
}
$_mode=$_SESSION['shorui_mode'];

$dbh = get_db_connect($_COOKIE['DSN_Campany']);//_Campany();//db_***
$errs = array();

$_admin = $_SESSION['kigen'];
$_ng = $_SESSION['ng'];

if($_mode==1){ 

    //$dbh = get_db_connect($_COOKIE['DSN_Company']);//_Campany();//db_***
    //$errs = array();
	$sql= 'SELECT * FROM tb_doc_master WHERE ID_DOC like "INS%" and ID_Customer = "'.$_COOKIE['campany'].'" order by ID_DOC desc ;';
	$data = Record_Load($dbh,$sql);

	echo '<h2>計測器管理システム　校正結果表　一覧</h2>';

	if(!empty($data)){
		?>
		<TABLE  class="ta4_2" BORDER=0 CELLSPACING=1 CELLPADDING=3 >
		<thead>
   		<tr>
		<TH valign="middle" width="120">名称</TH>
		<TH valign="middle" width="100">検査結果ID</TH>
		<?php
		if($s_h){
	 	 echo '<TH valign="middle" width="80">補助資料</TH>';
		}
		if($s_n and $ng){
		 echo '<TH valign="middle" width="100">不合格<br>報告書</TH>';
		}
		if ($s_y) {
		 echo '<TH valign="middle" width="100">要注意<br>報告書</TH>';
		}
		if ($s_l) {
		 echo '<TH valign="middle" width="100">検査実施<br>リスト</TH>	';
		}
		echo '<th valign=middle width=50>発行日</th><TH valign=middle width=100>備考</TH></tr></thead>';
		
		foreach($data as $row):
			if($tbodycolor){
		 		echo '<tbody class="tbody1">';
			}else{
		 		echo '<tbody class="tbody2">';
			}
			echo '<tr>';
			echo '<TD nowrap valign="middle" width="120">'.$row['NN_DOC_name'].'</TD>';
	    	echo '<TD nowrap valign="middle" width="80">';
			//'検査成績書
			if(!is_null($row['ID_DOC'])){
				$f_nam='/'.$ID_kaishamei.'/pdf/'.$row['ID_DOC'].'.pdf';
				echo '<a href=javascript:p_pdf("'.$f_nam.'");>'.$row['ID_DOC'].'</a>';
			}else{
				echo $row['ID_DOC'];
			}
			echo '</TD>';
			///////////////////////
			if($s_h){
 				echo '<TD nowrap valign="middle" width="80">';

				//'補助資料
				if(!is_null($row['ID_DOC'])){
					if($row['F_HOJO']){
						$f_nam='/'.$ID_kaishamei.'/pdf/'.$row['ID_DOC'].'-h.pdf';
						echo '<a href=javascript:p_pdf("'.$f_nam.'");>補助資料</a>';
					}else{
						echo '---';
					}
				}else{
				 echo  $row['ID_DOC'];
				}
				echo '</TD>';
			}
			if($s_n and $ng ){
			 echo '<TD nowrap valign="middle" width="80">';
			 //不合格報告書
				if(!is_null($row['ID_DOC'])){
					if($row['F_ngReport']){
					 $f_nam='/'.$ID_kaishamei.'/pdf/'.$row['ID_DOC'].'-n.pdf';
					 echo '<a href=javascript:p_pdf("'.$f_nam.'");>不合格報告書</a>';
					}else{
					 echo '---';
					}
				}else{
		 			echo $row['ID_DOC'];
				}
				echo '</td>';
			}
			if($s_y){
				echo '<TD nowrap valign=middle width=80>';
				//'要注意報告書
				if(!is_null($row['ID_DOC'])){
					if($row['F_youchui']){
		 				$f_nam='/'.$ID_kaishamei.'/pdf/'.$row['ID_DOC'].'-y.pdf';
		 				echo '<a href=javascript:p_pdf("'.$f_nam.'");>要注意報告書</a>';
					}else{
						echo '---';
					}
				}else{
					echo $row['ID_DOC'];
				}
				echo '</td>';
			}	
			if($s_l){
				echo '<TD nowrap valign="middle" width="80">';
				///////'検査実施リスト
				if(!is_null($row['ID_DOC'])){
					if($row['F_List']){
						$f_nam = '/'.$ID_kaishamei.'/pdf/'.$row['ID_DOC'].'-l.pdf';
						echo '<a href=javascript:void(0);p_pdf("'.$f_nam.'");>検査実施リスト</a>';
					}else{
						echo "---";
					}
				}else{
					echo $row['ID_DOC'];
				}
				echo '</TD>';
			}	
			echo '<TD nowrap valign="middle" width="50">'.$row['DATE_issuing'].'</TD>';
			echo '<TD nowrap valign="middle" width="150">'.$row['NOTE_DOC'].'</TD>';
			echo '</tr>';
			echo '</tbody>';
			$tbodycolor = !$tbodycolor;
		endforeach;
		?>

		</TABLE>
		<!--</form>-->
		</center>
		<br><br><a href="menu.asp" >戻る</a>
		<?php
	}else{
		echo '該当するデータはありませんでした';
		echo '<A HREF=menu.php>戻る</A>';
	}

}elseif($_mode==2){

	$sql='SELECT * FROM tb_doc_master';
	$sql = $sql.' WHERE ID_DOC like "CAL%" and ID_Customer = "'.$_COOKIE['campany'].'" order by ID_DOC desc ';
	$data = Record_Load($dbh,$sql);

	echo '<h2>計測器管理システム　校正証明書　一覧表</h2>';

	if(!empty($data)){
		?>
		<TABLE class=ta4_2 BORDER=0 CELLSPACING=1 CELLPADDING=3>
		<thead>
   		<tr>
		<TH valign=middle width=150>校正証明書ID</TH>
		<TH valign=middle width=200>名称</TH>
		<TH valign="middle" width="50">発行日</TH>
		<TH valign="middle" width="50">備考</TH>
   		</tr>
		</thead>
		<?php
		foreach($data as $row):
			if($tbodycolor){
				echo '<tbody class=tbody1>';
			}else{
				echo '<tbody class=tbody2>';
			}
			echo '<tr>';
			echo '<TD nowrap valign=middle width=80>';
			//'検査成績書
			if(!is_null($row['ID_DOC'])){
				$f_nam="/".$ID_kaishamei."/pdf/".$row['NN_DOCFILE_Name'].".pdf";
				echo '<a href=javascript:p_pdf("'.$f_nam.'");>'.$row['ID_DOC'].'</a>';
			}else{
				echo $row['ID_DOC'];
			}
			echo '</TD>';
			echo '<TD nowrap valign=middle width="150">'.$row['NN_DOC_name'].'</TD>';
			echo '<TD nowrap valign=middle width="150">'.$row['DATE_issuing'].'</TD>';
			echo '<TD nowrap valign=middle width="150">'.$row['NOTE_DOC'].'</TD>';
			echo '</tr>';
			echo '</tbody>';
			$tbodycolor = !$tbodycolor;
		endforeach;
	}else{
		echo '該当するデータはありませんでした';
		echo '<A HREF=menu.php>戻る</A>';
	}
}elseif($_mode==3){

	$sql='SELECT * FROM tb_doc_master';
	$sql = $sql.' WHERE ID_DOC like "TRA%" and ID_Customer = "'.$_COOKIE['campany'].'" order by DATE_issuing desc,ID_DOC asc;' ;
	$data = Record_Load($dbh,$sql);

	echo '<H2>計測器管理システム　校正証明書　一覧表</H2>';
	if(!empty($data)){
		echo '<TABLE class=ta4_2 BORDER=0 CELLSPACING=1 CELLPADDING=3 >
<thead>';	
		echo '<tr>';
		echo '<TH valign=middle width=150>トレーサビリティーID</TH>';
		echo '<TH valign=middle width=250>名称</TH>';
		echo '<TH valign=middle width=50>発行日</TH>';
		echo '<TH valign=middle width=50>備考</TH>';
		echo '</tr>';
		echo '</thead>';

		foreach($data as $row):
			if($tbodycolor){
				echo '<tbody class=tbody1>';
			}else{
				echo '<tbody class=tbody2>';
			}
			echo '<tr>';
			echo '<TD nowrap valign=middle width=80>';
			//検査成績書
			if(!is_null($row['ID_DOC'])){
				$f_nam = '/'.$ID_kaishamei.'/pdf/'.$row['NN_DOCFILE_Name'].'.pdf';
				echo '<a href=javascript:p_pdf("'.$f_nam.'");>'.$row['ID_DOC'].'</a>';
			}else{
				echo $row['ID_DOC'];
			}
			echo '</TD>';
			echo '<TD nowrap valign="middle" width="150">'.$row['NN_DOC_name'].'</TD>';
			echo '<TD nowrap valign="middle" width="150">'.$row['DATE_issuing'].'</TD>';
			echo '<TD nowrap valign="middle" width="150">'.$row['NOTE_DOC'].'</TD>';
			echo '</tr>';
			echo '</tbody>';
			$tbodycolor = !$tbodycolor;
		endforeach;
		echo '</TABLE></center>';
	}else{
		echo '該当するデータはありませんでした';
		echo '<A HREF=menu.php>戻る</A>';
	}
}
?>

</BODY>
</html>
