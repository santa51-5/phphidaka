
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<title>計測機器管理システム（ログイン）</title>
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/login.css">
<LINK REL="stylesheet" TYPE="text/css" HREF="../inc/basic.css">
</head>

<?php include '../inc/clock.inc';?>


<body oncontextmenu="return false;" onload="clock();form1.text1.focus();eventSet();positionSet();">
<div class="wrapper">
<HEADER>
<?php

require_once('../inc/config.php');
require_once('../helpers/db_helper.php');
require_once('../helpers/extra_helper.php');

/* 会社別毎に変更する
$campany = "koritsu1404" ; //コーリツ様
$campany_root = "koritsu_UxbV87vz"; //コーリツ様
$_SESSION['ID_Customer'] = 'koritsu1404';
$_SESSION['DSN_Company'] = 'mysql:dbname=db_koritsu1404;host=localhost;charset=utf8';
*/
?>

<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>
<DIV id=sclock>
<p id="clock" lang="en">　</p>
</DIV>
<div class=loginfo>
<span class=infoDate>前回ログイン：<?php echo GetPREVLOG(); ?></span>
</div>
</HEADER>

<div class=contentsLOGIN>

<?php
if(empty($_POST['usrid'])){
?>

<DIV id="login-bg" >  <!---top : 70px;left : 160px; --->
<p class=title_campany><?php echo $_COOKIE['campanyName'];?> 様</p>

<form id="form1"  method="POST" action="login.php" onkeydown="if(event.keyCode==13){event.returnValue=false};">
<!--onkeypress="if(event.keyCode==13){event.returnValue=false};" -->

<p class=TITLElogin>ログイン</p>
<table id="info" class="tatsu1" >
    <tr class="id">
    <td class="ttl">ユーザID：</td>
    <td class="field"><input type="text" id="text1" name="usrid"  size="23" maxlength="8"  onkeydown="if((event.keyCode==13)){text2.focus()};"></td>
    </tr>
    <tr  class="pw">
      <td class="ttl">パスワード：</td>
      <td class="field"><input type="password" id="text2" name="usr_passwd" onkeydown="if((event.keyCode==13)){text3.focus()};" size="23"></td>
    </tr>
    <tr>
	<td class="ttl">&nbsp;</td>
	<td align=center>
	<input type="submit" id="text3" value="ログイン" onkeydown="if(event.keyCode==13){if(errChk()){this.form.submit()}else{text1.focus()}};">
	<input type="reset" value="取消" />
	</td>

	</tr>

</table>
</form>
</DIV>
<?php
}else{
	//var_dump($_COOKIE['DSN_Company']);
    //データベース接続
    $dbh = get_db_connect($_COOKIE['DSN_Campany']);//_Campany();//db_***
    $errs = array();

    //formからのPOST
	$usrid=get_post("usrid");
    $usr_passwd = get_post('usr_passwd');
//var_dump($_COOKIE['DSN_Company']);
    if (!usr_master_id_exists2($dbh, $usrid,$_COOKIE['campany'])) {
        $errs['mngusr_id'] = 'メールアドレスが登録されていません。';
//    } elseif (!filter_var($mngusr_id, FILTER_VALIDATE_EMAIL)) {
//        $errs['mngusr_id'] = 'メールアドレスの形式が正しくないです';
    } elseif (!check_words($usrid, 100)) {
        $errs['mngusr_id'] = 'メール欄は必須、100文字以下で入力してください';
    }

    if (!check_words($usr_passwd, 50)) {
        $errs['usr_passwd'] = 'パスワードは必須、50文字以下で入力してください';
    } elseif (!$member = select_member2($dbh, $usrid, password_hash(get_post('usr_passwd'), PASSWORD_DEFAULT),$_COOKIE['campany'])) {
        $errs['usr_passwd'] = 'パスワードとメールアドレスが正しくありません';
    }
	//	var_dump($errs);

    //ログインする
    if (empty($errs)) {
		session_start();
		// セッション変数を削除
		$_SESSION = array();

        session_regenerate_id(true);
        $_SESSION['uid'] = $member['ID_USRCustomer'];
        $_SESSION['cnam'] = $member['Campany_Name'];
        $_SESSION['unam'] = $member['Name_Customer'];
        $_SESSION['bmn'] = $member['NN_ManageSection'];
		$_SESSION['new']=$member['f_DISP_Menu1'];
		$_SESSION['henkou']=$member['f_DISP_Menu2'];
		$_SESSION['kensaku']=$member['f_DISP_Menu3'];
		$_SESSION['sakujo']=$member['f_DISP_Menu8'];
		$_SESSION['jidou']=$member['f_DISP_Menu4'];
		$_SESSION['kigen']=$member['f_DISP_Menu5'];
		$_SESSION['NG']=$member['f_DISP_Menu6'];
		$_SESSION['HJ']=$member['f_DISP_Menu7'];
		$_SESSION['admin']=$member['f_DISP_Menu_ADMIN'];
		$_SESSION['henkou']=$member['f_DISP_Menu_Change'];
		$_SESSION['master']=$member['f_DISP_Menu9'];

		//$_SESSION['ID_Customer'] = 'koritsu1404';
		//$_SESSION['DSN_Company'] = 'mysql:dbname=db_koritsu1404;host=localhost;charset=utf8';
		//log記録
		//insert_log_data($dbh, $member['ID_USRCustomer'],'login',"通常ログイン");
		insert_log_data2($dbh, $member['ID_USRCustomer'],'login',"通常ログイン",$member['ID_Customer']);
	
		//得意先別の情報取得
    	$dbh = get_db_connect(DSN_master);//db_masterのtb_hmasterに接続
    	$errs = array();
		$data = tokuisaki($dbh,$_COOKIE['campany']);
//error_log(print_r($data,true),"3","./debug.log");//var_dump($data);
		$_SESSION['ID_kaishamei']=$data['ID_Customer'];//	rss("id")
		$_SESSION['kaishamei']=$data['Campany_Name'];//rss("会社名")
		$_SESSION['tantouin']=$data['Name_Customer'];//rss("担当員")
		$_SESSION['p1']=$data['NN_SEC1'];//rss("所番地分類1")
		$_SESSION['p2']=$data['NN_SEC2'];//rss("所番地分類2")
		$_SESSION['p3']=$data['NN_SEC3'];//rss("所番地分類3")
		$_SESSION['p4']=$data['NN_SEC4'];//rss("所番地分類4")
		$_SESSION['p5']=$data['NN_SEC5'];//rss("置き場1")
		//$_SESSION['p6']=$data['NN_SEC6'];//rss("置き場2")
		$_SESSION['m_jidou']=$data['f_AutoCreateDATA'];//rss("自動作成機能")
		$_SESSION['db_path']=$data['db_path'];//rss("db_path")
		$_SESSION['data_path']=$data['data_path'];//rss("data_path")
		$_SESSION['kanrijoutaihyouji']=$data['f_DISP_ManageStatus'];//rss("管理状態表示")
		$_SESSION['kensashukihyouji']=$data['f_DISP_InspectCycle'];//rss("検査周期表示")
		$_SESSION['detakakuninranhyouji']=$data['f_DISP_DATAConfirmation'];//rss("データ確認欄表示")
		$_SESSION['kouseikekahyouji']=$data['f_DISP_CALRisultDetails'];//rss("校正結果詳細表示")
		$_SESSION['kigengirehyouji']=$data['f_DISP_Expired'];//rss("期限切れ表示")
		$_SESSION['kouseiyoteihyouji']=$data['f_DISP_CALPlans'];//rss("校正予定表示")
		$_SESSION['kakushulisthyouji']=$data['f_DISP_VariousLIST'];//rss("各種リスト表示")
		$_SESSION['m_shinkisakusei']=$data['f_NEWCreate'];//rss("新規作成")
		$_SESSION['m_henkou']=$data['f_Changable'];//rss("変更")
		$_SESSION['m_haiki']=$data['f_Disposal'];//rss("廃棄")
		$_SESSION['s_h']=$data['f_SuportReport'];//rss("補助資料")
		$_SESSION['s_n']=$data['f_NGList'];//rss("不合格報告書")
		$_SESSION['s_y']=$data['f_CautionList'];//rss("要注意報告書")
		$_SESSION['s_l']=$data['f_ImplementationList'];//rss("実施リスト")
		$_SESSION['mas_info']=$data['f_MasterInfoManage'];//rss("マスター情報管理")
		$_SESSION['mas_info_s1']=$data['f_UseSEC1'];//rss("所番地1")
		$_SESSION['mas_info_s2']=$data['f_UseSEC2'];//rss("所番地2")
		$_SESSION['mas_info_s3']=$data['f_UseSEC3'];//rss("所番地3")
		$_SESSION['mas_info_s4']=$data['f_UseSEC4'];//rss("所番地4")
		$_SESSION['mas_info_s5']=$data['f_UseSEC5'];//rss("置き場1表示")
		//$_SESSION['mas_info_s6']=$data['f_UseSEC6'];//rss("置き場2表示")
		$_SESSION['mas_info_kibutsu']=$data['Campany_Name'];//rss("器物分類コード")
		$_SESSION['henkou_kanri']=$data['f_ChangeManege'];//rss("変更管理")
		$_SESSION['nyukainfo']=$data['f_AcceptanceInfo'];//rss("入荷情報")
		$_SESSION['hanei']=null;
		setcookie('ID_Customer',$_SESSION['uid'],time()+60*60*24*7);//") = Session.Contents("ID_kaishamei")
		setcookie('campany_root',$campany_root,time()+60*60*24*7);//") = campany_root
//error_log(print_r($_SESSION,true),"3","./debug.log");
		//menuへ
//exit;
		header('Location: '.SITE_URL.'./do/menu.php');
        exit;
    }else{
		//log_process usrid&":"& Request.Form("passwd") , 8 , "不一致"
		insert_log_data2 ($dbh, $usrid,'login','不一致'.$usr_passwd,$_COOKIE['campany']);
		?>
		<p class=title_campany><?php echo $_COOKIE['campanyName'];?> 様</p>

		<p class=title_campany>IDまたはパスワードが間違っています</p>
		<div class=ms_timemout>
		<p>再度ログインを行ってください</p>
		<p>ユーザＩＤ　：<?php echo $usrid;?></p>
		<p>日　　　時　：<?php echo date("Y/m/d H:i:s");?></p>
		</div>
		<div class=TOlogin><a  id="login"  href="" onclick="history.back(); return false;">ログイン画面へ</a>
		</div>
	<?php	
	}		
}
include '../inc/footer.php'; ?>
</div>
</body>