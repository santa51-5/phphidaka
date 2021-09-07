<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<HEAD>

<?php 
	require_once('../inc/config.php');
	require_once('../helpers/db_helper.php');
	require_once('../helpers/extra_helper.php');
	include '../inc/login_inc.php';
?>

<META name="IBM:HPB-Input-Mode" content="mode/flm; pagewidth=750; pageheight=900">
<META http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>測定器管理台帳支援システム（<?php echo $_SESSION['unam']; ?>）</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/basic.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/search_css.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/headmenu_css.css">
</style>

<script  type="text/javascript" language="JavaScript">
/*
function isDate(parts) {
dateStr = parts.value
parseDate = new Array(3);
if (dateStr==null || dateStr==""){return true;}
if(dateStr.indexOf("/") < 0){alert("YYYY/M/D形式で入力してください！");return false;}
parseDate = dateStr.split("/");
check=/[12][0-9][0-9][0-9]/
if(!(parseDate[0].match(check))){alert("YYYY/M/D形式で入力してください！");return false;}
check=/1[012]|[1-9]/
if(!(parseDate[1].match(check))){alert("YYYY/M/D形式で入力してください！");return false;}
check=/31|[123]0|[12][1-9]|[1-9]/
if(!(parseDate[2].match(check))){alert("YYYY/M/D形式で入力してください！");return false;}
return true;
}

function isStr(parts) {
alert("適切な文字を入力してください！");
dataStr = parts.value;
if (dataStr==null || dataStr==""){return true;}
check = /[A-Za-z0-9]/;
if(!(dataStr.match(check))){alert("適切な文字を入力してください！");
return false;}
else{
return true;
}
// -->*/
</script>
<script src="inc/calendarlay.js" language="JavaScript"></script>
</HEAD>

<BODY  onLoad="form1.text1.focus();clock();">
<?php
include '../inc/clock.inc';
include '../inc/kakunou.php';
?>


<div class="wrapper">
<HEADER>

<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>

<DIV id="sclock">
<p id="clock" lang="en">　</p>
</DIV>

</HEADER>
<?php
include '../inc/headmenu.inc';

$_SESSION['modori'] = "";
$_SESSION['back")'] = "";
$_SESSION['back1")'] = "";
$admin=$_SESSION['admin'];
$ng=$_SESSION['ng'];
$kensa=$_SESSION['kensa'];

if(empty($_POST)){
?>
	<div class="boxA">
	<DIV id="block02">
	<h1>検索</h1>
	<!-- 検索はじめ　id="kensaku"　 -->
	<DIV class="kensaku" id="kensaku">

	<form id="form1" name="calf1" method="POST" action="search.php" onkeydown="if(event.keyCode==13){event.returnValue=false};">

	<table>
	<tr><th class="c1">管理番号</th>
	<td>
	<INPUT type="text" class="w3" id="text1" name="id1" value="<?php echo $_SESSION['id1'];?>" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text2.focus();}" onblur="if(!(isStr(this))){text1.focus();}">
	<input type="text" class="w10"  id="text2" name="id2" value="<?php echo $_SESSION['id2'];?>" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text3.focus()};" onblur="if(!(isStr(this))){text2.focus()};" size="10" />～
	<input type="text" class="w10" id="text3" name="id3" value="<?php echo $_SESSION['id3'];?>" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text5.focus()};" onblur="if(!(isStr(this))){text3.focus()};" size="10" />
	<br>
	</td></tr>

    <tr>
      <th class="c1">製造番号</th>
      <TD class="w20"><INPUT type="text" id="text5" name="fnum" value="<?php echo $_SESSION['fnum'];?>" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text6.focus()};" onblur="if(!(isStr(this))){text5.focus()};" size="14"></TD>
    </tr>

	<?php
	// ①DB接続しSQLを発行してデータを取得
	$dbh = get_db_connect($_COOKIE['DSN_Campany']);
	$errs = array();
	?>
	<tr>
	<th class="c1">名称</th>
	<TD class="w20">
	<select name="nam" id="text6" onkeydown="if((event.keyCode==13)){text7.focus()};">
	<?php
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_kibutsu,NN_kibutsu';
	$PH_FROM = 'tb_c_kibutsu';
	$PH_WHERE = 'Mark_Kibutsu IS NOT NULL and C_UseState is true Order by C_kibutsu;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['num'])){$SESSION_value="";}else{$SESSION_value=$_POST['num'];}
	$data = Create_List($dbh,$sql,'C_kibutsu','NN_kibutsu',$SESSION_value);
	echo $data;
	?>
	</select></TD>
	</tr>

	<TR>
	<th class="c1">型式番号</th>
	<TD><INPUT  class="W20" type="text" name="katashiki_code" value="<?php $_SESSION['katashiki_code']?>" id="text7" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text8.focus()};" onblur="if(!(isStr(this))){text7.focus()};" size="14"></TD>
	</TR>
	
	<tr>
	<th CLASS="C1"><?php echo $p1 ;?></th>
	<TD>
	<select CLASS="W20" name="sec1" id="text8" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text81.focus()};">
	<?php
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_SEC1 ,NN_SEC1 ';
	$PH_FROM = 'tb_C_SEC1 ';
	$PH_WHERE = ' C_UseState_SEC1 is true Order by C_SEC1;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['sec1'])){$SESSION_value="";}else{$SESSION_value=$_POST['sec1'];}
	$data = Create_List($dbh,$sql,'C_SEC1','NN_SEC1',$SESSION_value);
	echo $data;
	?>
	</select></TD>
	</tr>

	<tr>
	<th CLASS="C1"><?php echo $p2 ;?></th>
	<TD>
	<select CLASS="W20" name="sec2" id="text81" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text9.focus()};">
	<?php
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_SEC2 ,NN_SEC2 ';
	$PH_FROM = 'tb_C_SEC2 ';
	$PH_WHERE = ' C_UseState_SEC2 is true Order by C_SEC2;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['sec2'])){$SESSION_value="";}else{$SESSION_value=$_POST['sec2'];}
	$data = Create_List($dbh,$sql,'C_SEC2','NN_SEC2',$SESSION_value);
	echo $data;
	?>
	</select></TD>
	</tr>

	<?php if($mas_info_s3){
	?>
	<tr>
	<th CLASS="C1"><?php echo $p3;?></th>
	<TD>
	<select CLASS="W20" name="sec3" id="text9" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text10.focus()};">
	<?php
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_SEC3 ,NN_SEC3 ';
	$PH_FROM = 'tb_C_SEC3 ';
	$PH_WHERE = ' C_UseState_SEC3 is true Order by C_SEC3;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['sec3'])){$SESSION_value="";}else{$SESSION_value=$_POST['sec3'];}
	$data = Create_List($dbh,$sql,'C_SEC3','NN_SEC3',$SESSION_value);
	echo $data;
	?>
	</select></TD>
	</tr>
	<?php }
	?>

	<?php 
	if($mas_info_s4){
	?>
	<tr>
	<th CLASS="C1"><?php echo $p4;?></th>
	<TD>
	<select CLASS="W20" name="sec3" id="text10" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text11.focus()};">
	<?php
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_SEC4 ,NN_SEC4 ';
	$PH_FROM = 'tb_C_SEC4 ';
	$PH_WHERE = ' C_UseState_SEC4 is true Order by C_SEC4;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['sec4'])){$SESSION_value="";}else{$SESSION_value=$_POST['sec4'];}
	$data = Create_List($dbh,$sql,'C_SEC4','NN_SEC4',$SESSION_value);
	echo $data;
	?>
	</select></TD>
	</tr>
	<?php 
	}
	?>


	<?php 
	if($mas_info_s5){
	?>
	<tr>
	<th CLASS="C1"><?php echo $p5;?></th>
	<TD>
	<select CLASS="W20" name="sec3" id="text11" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text12.focus()};">
	<?php
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_SEC5 ,NN_SEC5 ';
	$PH_FROM = 'tb_C_SEC5 ';
	$PH_WHERE = ' C_UseState_SEC5 is true Order by C_SEC5;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['sec5'])){$SESSION_value="";}else{$SESSION_value=$_POST['sec5'];}
	$data = Create_List($dbh,$sql,'C_SEC5','NN_SEC5',$SESSION_value);
	echo $data;
	?>
	</select></TD>
	</tr>
	<?php
	}
	?>

	<TR>
     <th CLASS="C1">サイズ</th>
     <TD><INPUT CLASS="W10" type="text" name="size" value="<?php $_SESSION['size']?>" id="text12" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text101.focus()};" onblur="if(!(isStr(this))){text12.focus()};" >
	<input type="checkbox" name="aimai" id="text101" onkeydown="if((event.keyCode==13)){text13.focus()};" VALUE="TRUE" <?php if($_SESSION['aimai']){echo "checked"; }?> >
	<P class="small_chr">あいまい検索</P></TD>
	</TR>
	<?php
	if($kanrijoutaihyouji){
	?>
    <TR>
      <th CLASS="C1">管理状態</TH>
      <TD>

		<select name="kanrijoutai" id="text13"  onkeydown="if((event.keyCode==13)){text14.focus()};">
		<?php
		$nashi="";
		$ichi="";
		$ni="";
		$san="";
		$yon="";
		if($_SESSION['kanrijoutai']==""){
			$nashi=" selected";
		}elseif($_SESSION['kanrijoutai']=='1'){
			$ichi=" selected";
		}elseif($_SESSION['kanrijoutai']=='2'){
			$ni=" selected";
		}elseif($_SESSION['kanrijoutai']=='3'){
			$san=" selected";
		}elseif($_SESSION['kanrijoutai']=='4'){
			$yon=" selected";
		}
		echo "<OPTION value=''".$nashi.">指定なし</OPTION>";
		echo "<OPTION value=1".$ichi.">使用</OPTION>";
		echo "<OPTION value=2".$ni.">保管</OPTION>";
		echo "<OPTION value=3".$san.">廃棄</OPTION>";
		if($ng){
			echo "<OPTION value=4".$yon.">未処置</OPTION>";
		}?>
		</select></TD>
    	</TR>
	<?php 
	}
	if($kensashukihyouji){
	?>
	
	<TR>
	<th CLASS="C1">検査周期</TH>
	<TD>
	<?php
	$s3="";
	$s6="";
	$s12="";
	$s24="";
	$s36="";
	$s60="";
	$S100="";
	$x=$_SESSION['shuki'];
		if(strlen($x)==0){
			$x=100;
		}
		switch($x){
			case 3:
				$s3=" selected";
			case 6:
				$s6=" selected";
			case 12:
				$s12=" selected";
			case 24:
				$s24=" selected";
			case 36:
				$s36=" selected";
			case 60:
				$s60=" selected";
			case 100:
				$s100=" selected";
			}
	?>
			<select CLASS="W10" name="shuki" id="text14"  onkeydown="if((event.keyCode==13)){text15.focus()};">
				<option value="" <?=$s100?>>指定なし</option>
				<option value="3" <?=$s3?>>3ヶ月</option>
				<option value="6" <?=$s6?>>6ヶ月</option>
				<option value="12" <?=$s12?>>12ヶ月</option>
				<option value="24" <?=$s24?>>24ヶ月</option>
				<option value="36" <?=$s36?>>36ヶ月</option>
				<option value="60" <?=$s60?>>60ヶ月</option>
			</select></TD>
		</TR>
	<?php
	}
	?>
	<TR>
	<th CLASS="C1">品番</th>
	<TD><INPUT CLASS="W20" type="text" name="hinban" value="<?=$_SESSION['hinban']?>" id="text15" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text17.focus()};" onblur="if(!(isStr(this))){text15.focus()};" ></TD>
	</TR>
	<tr>
	<TD style="padding-top:10px;" colspan="2" align="center">
	<input type="submit" id="text17" NAME="KENSAKU" value="検索実行(G)" accesskey="g" onkeydown="if((event.keyCode==13)){this.form.submit()}else if((event.keyCode==37 || event.keyCode==38)){text15.focus()};"  >
	<input type="submit" id="text18" NAME="KENSAKU" value="集計(S)" accesskey="s" onkeydown="if((event.keyCode==13)){this.form.submit()}else if((event.keyCode==37 || event.keyCode==38)){text15.focus()};"  >
	<input type="submit" NAME="KENSAKU" value="取消" /></TD>
	</tr>
	</table>
	</form>
	</div>

	<!-- 検索終わり -->
	</DIV>

	<DIV id="block04">
	<h1>目的別検索</h1>
	<DIV class="kensaku" id="kensaku1">
	<FORM id="form2" NAME="KEKKA" method="POST" action="listing_kekka.php" onkeydown="if(event.keyCode==13){event.returnValue=false};">
	<TABLE>
	<TR>
	<TD><h1>校正結果</h1></TD>
	</TR>

	<TR>
	<?php
	//$dt=new DateTime();
	//$h1 = $dt->modify('-1 month');
	?>
	<TD style="padding-top : 10px;font-size : 0.8em ; vertical-align: middle;"><INPUT type="text" NAME="Y1_KDATE" SIZE="6" value="<?php if(strlen($_SESSION['Y1_KDATE'])>0){echo $_SESSION['Y1_KDATE'];}else{echo date('Y', strtotime('-1 month'));}?>" style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME="M1_KDATE" SIZE="3" value="<?php if(strlen($_SESSION['M1_KDATE'])>0){echo $_SESSION['M1_KDATE'];}else{echo date('n',strtotime('-1 month'));}?>" strstyle="ime-mode:disabled;">
	月
	～
	<INPUT type="text" NAME="Y2_KDATE" SIZE="6" value="<?php if(strlen($_SESSION['Y2_KDATE'])>0){echo $_SESSION['Y2_KDATE'];}else{echo date('Y',strtotime('-1 month'));}?>" style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME="M2_KDATE" SIZE="3" value="<?php if(strlen($_SESSION['M2_KDATE'])>0){echo $_SESSION['M2_KDATE'];}else{echo date('n',strtotime('-1 month'));}?>" style="ime-mode:disabled;">
	月</td>
	</TR>
	<?php
	//if cbool(Session.Contents("NG")) then
	?>
	<TR>
	<TD><p class="ckbox"><input type="checkbox" name="OK" VALUE="true" <?php if($_SESSION['OK']){echo "checked ";}?>>
	合格（ＯＫ）</p><p><input type="checkbox" name="NOGOOD" VALUE="true" <?php if($_SESSION['NOGOOD']){echo " checked "; }?>>
	不合格（ＮＧ）</p><p><input type="checkbox" name="YOUCHUI" VALUE="true" <?php if($_SESSION['YOUCHUI']){echo " checked "; }?> >
	要注意</p></TD>
	</TR>
	<TR>
	<TD><p>
	<input type="checkbox" name="HJKIKAKU" VALUE="true" <?php if($_SESSION['HJKIKAKU']){echo " checked "; } ?>>
	ＨＪ規格（日高計量士事務所規格）</p></TD>
	</TR>
	<TR>
	<TD>
	<p><input type="checkbox" name="MISHOCHI" VALUE="true" <?php if($_SESSION['MISHOCHI']){echo " checked "; } ?> >
	未処置
	</p><p><input type="checkbox" name="HAIKI" VALUE="true" <?php if($_SESSION['HAIKI']){echo " checked "; } ?>>
	廃棄・廃却</p></TD>
	</TR>

	<TR>
	<TD><input type="submit" name="KEKKA" VALUE="校正結果表示" onkeydown="if((event.keyCode==13)){this.form.submit()}">&emsp;
	<input type="submit" name="KEKKA" VALUE="集計">&emsp;
	<input type="submit" name="KEKKA" value="取消" /></TD>
	</TR>
	</TABLE>
	</FORM>

	<?php 
	if($kouseiyoteihyouji){
		if($admin){?>
		<TABLE>
		<FORM id="form3" NAME="CALYOTEI" method="POST" action="listing_yotei.php" onkeydown="if(event.keyCode==13){event.returnValue=false};">
		<TR>
		<TD><h1>校正予定</h1></TD>
		</TR>
		<TR>
		<TD style="padding-top : 10px;font-size : 0.8em ; vertical-align: middle;">
		<INPUT type="text" NAME="Y1_YDATE" SIZE="6" value="<?php if(strlen($_SESSION['Y1_YDATE'])>0){echo $_SESSION['Y1_YDATE'];}else{echo date('Y');}?>"  style="ime-mode:disabled;">	年
		<INPUT type="text" NAME="M1_YDATE" SIZE="3" value="<?php if(strlen($_SESSION['M1_YDATE'])>0){echo $_SESSION['M1_YDATE'];}else{echo date('n');}?>"  style="ime-mode:disabled;">	月	～
		<INPUT type="text" NAME="Y2_YDATE" SIZE="6" value="<?php if(strlen($_SESSION['Y2_YDATE'])>0){echo $_SESSION['Y2_YDATE'];}else{echo date('Y');}?>" style="ime-mode:disabled;">	年
		<INPUT type="text" NAME="M2_YDATE" SIZE="3" value="<?php if(strlen($_SESSION['M2_YDATE'])>0){echo $_SESSION['M2_YDATE'];}else{echo date('N');} ?>" style="ime-mode:disabled;">	月</td>
		</TR>
		<TR>
		<TD style="padding-top:10px;" ><input type="submit" name="YOTEI" VALUE="校正予定">&emsp;
		<input type="submit" name="YOTEI" VALUE="集計">&emsp;
		<input type="submit" name="YOTEI" value="取消" /></TD>
		</TR>
		</TABLE>
		</FORM>
		<?php
		}
		?>
		<TABLE>
		<FORM id="form4" NAME="CALtougetsu" method="POST" action="listing_yotei.php">
		<TR>
		<TD><h1><?=date('Y');?>年<?=date('m');?>月　校正予定　一覧</h1></TD>
		</TR>
		<TR>
		<INPUT type="hidden" NAME="Y1_YDATE" value="<?=date('Y');?>">
		<INPUT type="hidden" NAME="M1_YDATE" value="<?=date('n');?>">
		<INPUT type="hidden" NAME="Y2_YDATE" value="<?=date('Y');?>">
		<INPUT type="hidden" NAME="M2_YDATE" value="<?=date('n');?>">
		<TD COLSPAN="9"><input type="submit" name="tougetsu" VALUE="当月校正予定">&emsp;
		<input type="submit" name="tougetsu"  VALUE="集計"></TD>
		</TR></FORM>
		</TABLE>
		<?php 
	}?>

	<?php
	//'if cbool(Session.Contents("NG")) then
	if($kigengirehyouji){
		if($admin){
			?>
			<TABLE>
			<FORM id="form5" NAME="CALkigen" method="POST" action="listing.php">
			<TR>
			<td><h1><?=date('Y');?>年<?=date('m');?>月現在　校正期限切れ　一覧</h1></TD>
			</TR>
			<TR>
			<td>
			<input type="hidden" NAME="Y1_YDATE" value="<?=date('y');?>">
			<input type="hidden" NAME="M1_YDATE" value="<?=date('m');?>">
			<input class="w15" type="submit" style="width:150px;" name="kigen" VALUE="<?=date('y');?>年<?=date('n');?>月現在期限切れ">&emsp;
			<input type="submit" name="kigen" VALUE="集計">&emsp;
			<input type="submit" name="kigen" value="取消" /></TD>
			<TR>
			<TD style="padding-top : 10px;font-size : 0.8em ; vertical-align: middle;"><INPUT type="text" NAME="Y1_kiDATE" SIZE="6" value="<?php if(strlen($_SESSION['Y1_kiDATE'])>0){echo $_SESSION['Y1_kiDATE'];}else{echo date('Y');}?>" style="ime-mode:disabled">	年
			<input type="text" NAME="M1_kiDATE" SIZE="3" value="<?php if(strlen($_SESSION['M1_kiDATE'])>0){echo $_SESSION['M1_kiDATE'];}else{echo date('n');}?>" style="ime-mode:disabled">	月　～　
			<input type="text" NAME="Y2_kiDATE" SIZE="6" value="<?php if(strlen($_SESSION['Y2_kiDATE'])>0){echo $_SESSION['Y2_kiDATE'];}else{echo date('Y');}?>" style="ime-mode:disabled">年
			<input type="text" NAME="M2_kiDATE" SIZE="3" value="<?php if(strlen($_SESSION['M2_kiDATE'])>0){echo $_SESSION['M2_kiDATE'];}else{echo date('n');}?>" style="ime-mode:disabled">	月</TD>
			</TR>
			<TR>
			<TD style="padding-top:10px;" ><input type="submit" name="kigen" VALUE="期限切れ">&emsp;
			<input type="submit" name="kigen" VALUE="期限切れ集計">&emsp;
			<input type="submit" name="kigen" value="取消" /></TD>
			</TR>
			<TR>
			<TD><p class="ckbox"><input type="checkbox" name="kigen_mishochi" VALUE="true" <?php if($_SESSION['kigen_mishochi']){echo " checked " ;}?> >	未処置</p>
			<p><input type="checkbox" name="kigen_haiki" VALUE="true" <?php if($_SESSION['kigen_haiki']){echo " checked "; }?> >	廃棄・廃却</p></TD>
			</TR>
			</TR></FORM>
			</TABLE>
			<?php
		}
	}?>
	</DIV>
	</DIV>

	<?php
	if($kakushulisthyouji and ($m_haiki or $m_henkou or $m_ichiren)){

		//'if session.contents("admin") then
		?>
		<DIV id="block03">
		<h1>各種リスト</h1>
		<?php
		if($kakushulisthyouji){
			//'if ADMIN then
			$_SESSION['modori']=9
			?>
			<DIV id="kensaku5" >
			<form method="POST" action="search.php">
			<table>
    		<tr>
    		<?php
			if($t_henko){?>
				<tr>
				<td><a class="button" href="checklist.php?action=up_list&hyouji_mode=10">修正リスト</td>
    			</tr>
				<?php
			}
    		if($sakujo){?>
				<tr>
				<td><a class="button" href="checklist.php?action=del_list&hyouji_mode=10">廃棄リスト</td>
    			</tr>
				<?php
			}
    		if($m_ichiren){?>
				<tr>
				<td><a href="ichirenlist.php"><img id="photo" src="img/一連登録リスト.gif"  border="0"></td>
    			</tr>
			<?php
			}?>
			</table>
			</form>
			</div>
			<?php
		}?>
		</DIV>
	<?php
	}
	//'=========フォームからの変遷
}else{

	$kikan='2001/04/01';
	$admin=$_SESSION['admin'];
	$flag=False;
/*
	$NM_DB = $_COOKIE['DSN_Campany'];
	$PH_SELECE = 'C_SEC5 ,NN_SEC5 ';
	$PH_FROM = 'tb_C_SEC5 ';
	$PH_WHERE = ' C_UseState_SEC5 is true Order by C_SEC5;';
	$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
	if(empty($_POST['sec5'])){$SESSION_value="";}else{$SESSION_value=$_POST['sec5'];}
	$data = Create_List($dbh,$sql,'C_SEC5','NN_SEC5',$SESSION_value);
	echo $data;
	
	Set db=Server.CreateObject("ADODB.Connection")
	db.Provider="Microsoft.Jet.OLEDB.4.0"
	db.Mode=1
	db.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	db.Open
	'SQL="SELECT 管理記号,管理数字,管理補助記号,管理補助数字,製造番号,全名称,所番地2,最小値,最大値,目量,サイズ,通り側,止まり側,登録年月日,備考1,型式,所番地3,最新校正日,マスタID ,IIf(型式コード=""N03"" Or 型式コード=""N08"" Or 型式コード=""N10"",""hight"",""std"") AS 型式コード1 FROM iマスター "
	*/
	
	//'管理記号
	
	if($_POST['id1']){
		if(!$flag){
			$SQL ="WHERE ";
		}
		$SQL .="管理記号='".$_POST['id1']."' ";
		$flag = True;
	}
	$_SESSION['id1'] = $_POST['id1'];
//error_log($SQL,"3","./debug2.log");
	//'管理数字

	if(!empty($_POST['id2']) and !empty($_POST['id3'])){
		if($flag){
			$SQL .= "AND ";
		}else{
			$SQL = "WHERE ";
		}
		$SQL .= "管理数字>=".$_POST['id2']." and 管理数字<=".$_POST['id3']." ";
		$flag = True;




	}elseif(!empty($_POST['id2']) and empty($_POST['id3'])){
		if($flag){
			$SQL .= "AND ";
		}else{
			$SQL = "WHERE ";
		}
		$SQL .= "管理数字=".$_POST['id2']." ";
		$flag = True;
	}elseif(empty($_POST['id2']) and !empty($_POST['id3'])){
		if(!$flag){
			$SQL .= "AND ";
		}else{
			$SQL = "WHERE ";
		}
		$SQL .= "管理数字=".$_POST['id3']." ";
		$flag = True;
	}
	$_SESSION['id2'] = $_POST['id2'];
	$_SESSION['id3'] = $_POST['id3'];

	/*'管理数字2
	'	If Request.Form("id3")<>"" Then
	'		If flag Then
	'			SQL=SQL & "AND "
	'			SQL1=SQL1 & "&"
	'		Else
	'			SQL=SQL & "WHERE "
	'		End If
	'		SQL=SQL & "管理数字<=" & Request.Form("id3")& " "
	'		SQL1=SQL1 & "管理数字<=" & Request.Form("id3")& ""
	'		flag=True
	'	End If

	'管理補助記号
	'	If Request.Form("id4")<>"" Then
	'		If flag Then
	'			SQL=SQL & "AND "
	'			SQL1=SQL1 & "&"
	'		Else
	'			SQL=SQL & "WHERE "
	'		End If
	'		SQL=SQL & "管理補助記号='" & Request.Form("id4")& "' "
	'		SQL1=SQL1 & "管理補助記号='" & Request.Form("id4")& "'"
	'		flag=True
	'	End If
	*/
	//'製造番号
	if(!empty($_POST['fnum'])){
		if($flag){
			$SQL .= "AND ";
			$SQL1 .= "&";
		}else{
			$SQL = "WHERE ";
		}
		$SQL .= "製造番号='".$_POST['fnum']."' ";
		$flag = True;
	}
	$_SESSION["fnum"] = $_POST["fnum"];

	//'器物分類名
	if(!empty($_POST["nam"]) and $_POST["nam"]<>"指定なし"){
		if($flag){
			$SQL .= "AND ";
			$SQL1 .= "&";
		}else{
			$SQL = "WHERE ";
		}
		$SQL .= "器物分類コード='".$_POST["nam"]."' ";
		$flag = True;
	}
	$_SESSION["nam"]= $_POST["nam"];

	//'型式番号
	if(!empty($_POST["katashiki_code"])){
		if($flag){
			$SQL .= "AND ";
			$SQL1 .= "&";
		}else{
		$SQL .= "WHERE ";
		}
		$SQL .= "型式番号='".$_POST["katashiki_code"]."' ";
		$flag = True;
	}	
	$_SESSION["katashiki_code"] = $_POST["katashiki_code"];

	//'所番地１
	if(!empty($_POST["sec1"]) and $_POST["sec1"]<>"指定なし"){
		if($flag){
			$SQL .= "AND ";
			$SQL1 .= "&";
		}else{
			$SQL .= "WHERE ";
		}
		$SQL .= "所番地分類1='".$_POST["sec1"]."' ";
		$flag = True;
	}
	$_SESSION["sec1"] = $_POST["sec1"];

	//'所番地２
	if(!empty($_POST["sec2"]) and $_POST["sec2"]<>"指定なし"){
		if($flag){
			$SQL .= "AND ";
			$SQL1 .= "&";
		}else{
			$SQL .= "WHERE ";
		}
		$SQL .= "所番地分類2='".$_POST["sec2"]."' ";
		$flag = True;
	}
	$_SESSION["sec2"]= $_POST["sec2"];

	//所番地３
	if (($_POST["sec3"]!="" && $_POST["sec3"]!="指定なし")){
		if($flag){
	  		$SQL .= "AND ";
	  		$SQL1 = "&";
		}else{
	  		$SQL .= "WHERE ";
		} 
		$SQL .= "所番地分類3='".$_POST["sec3"]."' ";
		$flag = true;
	} 
	$_SESSION["sec3"]= $_POST["sec3"];

	//所番地4
	if(($_POST["sec4"]!="" && $_POST["sec4"]!="指定なし")){
		if ($flag){
	  		$SQL .= "AND ";
	  		$SQL1 .= "&";
		}else{
	  		$SQL .= "WHERE ";
		} 
		$SQL .= "所番地分類4='".$_POST["sec4"]."' ";
		$flag = true;
  	} 
  
  	$_SESSION["sec4"] = $_POST["sec4"];
  
  	//所番地5
  	if(($_POST["sec5"]!="" && $_POST["sec5"]!="指定なし")){
		if($flag){
	  		$SQL .= "AND ";
	  		$SQL1 .= "&";
		}else{
	  		$SQL .= "WHERE ";
		} 
		$SQL .= "置き場1='".$_POST["sec5"]."' ";
		$flag = true;
  	} 
  	$_SESSION["sec5"] = $_POST["sec5"];
  
	 //サイズ
  	if($_POST["size"]!=""){
		if($flag){
	  		$SQL .= "AND ";
	  		$SQL1 .= "&";
		}else{
	  		$SQL .= "WHERE ";
		} 
		if(is_numeric($_POST["size"])){
	  		$SQL .= "(サイズ='".$_POST["size"]."' or 最大値=".$_POST["size"].	") ";
		}else{
	  		if ($_POST["aimai"]){
				$SQL .= "サイズ like '%".$_POST["size"]."%' ";
	  		}else{
				$SQL .= "サイズ='".$_POST["size"]."' ";
	  		} 
		}
		$flag=true;
	} 
  	$_SESSION["size"] = $_POST["size"];

	//管理状態
	if(($_POST["kanrijoutai"]!="" && $_POST["kanrijoutai"]!="指定なし")){
  		if($flag){
    		$SQL .= "AND ";
    		$SQL1 .= "&";
  		}else{
    		$SQL .= "WHERE ";
  		} 
  		$SQL .= "使用区分コード='".$_POST["kanrijoutai"]."' ";
  		$flag = true;
	} 
	$_SESSION["kanrijoutai"] = $_POST["kanrijoutai"];

	//検査周期
	if(($_POST["shuki"]!="" && $_POST["shuki"]!="指定なし")){
		if($flag){
	  		$SQL .= "AND ";
	  		$SQL1 .= "&";
		}else{
	  		$SQL .= "WHERE ";
		}
		$SQL .= "検査周期=".$_POST["shuki"]." ";
		$flag = true;
  	} 
  	$_SESSION["shuki"] = $_POST["shuki"];
  
  	//最新校正日
  	if($_POST["data1"]!=""){
		if($flag){
	  		$SQL .= "AND ";
	  		$SQL1 .= "&";
		}else{
	  		$SQL .= "WHERE ";
		}
		if ($_POST["data2"]==""){
	    	$data2=$_POST["data1"];
		}else{
	  		$data2=$_POST["data2"];
		}
		$SQL .= "最新校正日 between #".$_POST["data1"]."# and #".$data2."# ";
		$flag=true;
	  } 
  	$_SESSION["data1"] = $_POST["data1"];
  	$_SESSION["data2"] = $_POST["data2"];
  
	  //品番
  	if($_POST["hinban"]!=""){
		if($flag){
	  		$SQL .= "AND ";
	  		$SQL1 .= "&";
		}else{
	  		$SQL .= "WHERE ";
		}
		$SQL=$SQL."品番='".$_POST["hinban"]."' ";
		$flag=true;
  	} 
  	$_SESSION["hinban"] = $_POST["hinban"];
  
 	 //制約
  	if(!$admin && ("ID_kaishamei")=="mannou"){
		if($flag){
	  		$SQL .= "AND ";
		}else{
	  		$SQL .= "WHERE ";
		}
		$SQL .= "最新校正日>=#".$kikan."# ";
		$flag=true;
  	} 
  	unset($_SESSION["order1"]);
  	unset($_SESSION["order2"]);
  	unset($_SESSION["order3"]);
  	unset($_SESSION["order4"]);
  	unset($_SESSION["order5"]);
  	unset($_SESSION["order6"]);

	$_SESSION["back"] = $SQL;

	//031206
	//===========検索
	if($_POST["KENSAKU"]=="集計(S)"){
		$_SESSION['SHUKEI_MODE'] = 1;
		header("Location: "."TABLE.php");
  	} 
  
  	//value="取消"
  	if($_POST["KENSAKU"]=="取消"){
		//Sessionデータの格納（クリア）
		unset($_SESSION["id1"]);
		unset($_SESSION["id2"]);
		unset($_SESSION["id3"]);
		unset($_SESSION["id4"]);
		unset($_SESSION["nam"]);
		unset($_SESSION["fnum"]);
		unset($_SESSION["katashiki_code"]);
		unset($_SESSION["sec1"]);
		unset($_SESSION["sec2"]);
		unset($_SESSION["sec3"]);
		unset($_SESSION["sec5"]);
		unset($_SESSION["size"]);
		unset($_SESSION["aimai"]);
		unset($_SESSION["kanrijoutai"]);
		unset($_SESSION["shuki"]);
		unset($_SESSION["data1"]);
		unset($_SESSION["data2"]);
		unset($_SESSION["hinban"]);
		header("Location: "."SEARCH.php");
  	} 
error_log("\n[".date('Y-m-d H:i:s')."]".$SQL."\n","3","./debug.log");
  
  	header("Location: ".SITE_URL."./do/listing.php");
  	//030414>
} 
  
?>
  



<!--#include file=inc/uni_func.asp -->
<DIV class="separate"></DIV>
</div>
<?php include '../inc/footer.php'; ?>
</BODY>
</html>