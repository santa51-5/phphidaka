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
<LINK REL="stylesheet" TYPE="text/css" HREF="..inc/search_css.css>
<LINK REL="stylesheet" TYPE="text/css" HREF="..inc/headmenu_css.css>
</style>

<script  type="text/javascript" language="JavaScript">
<!--
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
// -->
</script>

<?php
include '../inc/clock.inc';
include '../inc/kakunou.php';
?>

<script src="inc/calendarlay.js" language="JavaScript"></script>
</HEAD>

<BODY  onLoad="form1.text1.focus();clock();">
<div class="wrapper">
<HEADER>

<h1>ｍｍ－ｓｙｓｔｅｍ 計測機器管理台帳</h1>

<DIV id=sclock>
<p id="clock" lang="en">　</p>
</DIV>

</HEADER>
<?php
include '..inc/headmenu.inc';

$_SESSION['modori'] = "";
$_SESSION['back")'] = "";
$_SESSION['back1")'] = "";
$admin=$_SESSION['admin'];
$ng=$_SESSION['ng'];
$kensa=$_SESSION['kensa'];

if(empty($_POST){
?>
<div class=boxA>
<DIV id=block02>
<h1>検索</h1>
<!-- 検索はじめ　id="kensaku"　 -->
<DIV class="kensaku" id="kensaku" >

<form id="form1" name=calf1 method="POST" action="search.asp" onkeydown="if(event.keyCode==13){event.returnValue=false};">

<table>
<tr><th class=c1>
管理番号</th>
<td>
<INPUT type=text class=w3 id=text1 name=id1 value=<?php $_SESSION["id1"];?> style=ime-mode:disabled; onkeydown=if((event.keyCode==13)){text2.focus();} onblur=if(!(isStr(this))){text1.focus();} >
<input type=text class=w10  id=text2 name=id2 value=<?php $_SESSION["id2"];?> style=ime-mode:disabled; onkeydown=if((event.keyCode==13)){text3.focus()}; onblur=if(!(isStr(this))){text2.focus()}; size=10 />
～
<input type=text class=w10 id=text3 name=id3 value=<?php $_SESSION["id3"]?> style=ime-mode:disabled; onkeydown=if((event.keyCode==13)){text5.focus()}; onblur=if(!(isStr(this))){text3.focus()}; size=10 />
<br>
</td></tr>

    <tr>
      <th class=c1>製造番号</th>
      <TD class=w20><INPUT type="text" id="text5" name="fnum" value="<%=session.Contents("fnum")%>" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text6.focus()};" onblur="if(!(isStr(this))){text5.focus()};" size="14"></TD>
    </tr>

<?php

$NM_DB = $_COOKIE['DSN_Campany']
$PH_SELECE = " C_kibutsu,NN_kibutsu"
$PH_FROM = "tb_c_kibutsu"
$PH_WHERE = "  Mark_Kibutsu IS NOT NULL and C_UseState=true Order by C_kibutsu;"

// ①DB接続しSQLを発行してデータを取得
$dbh = get_db_connect($_COOKIE['DSN_Campany']);
$errs = array();
$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
if ($data = Record_Load($dbh,$sql)) {
	// ②テーブルのデータをoptionタグに整形
	if($_SESSION['num']===""){
		$data .= '<option value selected>指定なし</OPTION>';
	}else{
		'<OPTION value="" >指定なし</OPTION>';
	}
	foreach($data as $data_val){
    	$data .= "<option value='". $data_val['C_kibutsu'];
		if($_SESSION['nam']===$data_val['C_kibutsu']){
			$data .=' selected ';
		}
    	$data .= "'>". $data_val['NN_kibutsu']. "</option>";
	}
}?>
<tr>
<th class=c1>名称</th>
<TD class=w20>
<select name="nam" id="text6" onkeydown="if((event.keyCode==13)){text7.focus()};">
<?
echo $data;
}
?>
</select></TD>
</tr>

<TR>
<th class=c1>型式番号</th>
<TD><INPUT  class=W20 type=text name=katashiki_code value=<?php $_SESSION["katashiki_code"]?> id=text7 style=ime-mode:disabled; onkeydown=if((event.keyCode==13)){text8.focus()}; onblur=if(!(isStr(this))){text7.focus()}; size=14></TD>
</TR>
<?
$NM_DB = $_COOKIE['DSN_Campany']
$PH_SELECE = "C_SEC1 ,NN_SEC1 ";
$PH_FROM = "tb_C_SEC1 ";
$PH_WHERE = " C_UseState_SEC1 =yes Order by C_SEC1;";
?>
<tr>
<th CLASS=C1><%=p1%></th>
<TD>
<select CLASS=W20 name=sec1 id=text8 style=ime-mode:disabled; onkeydown=if((event.keyCode==13)){text81.focus()};>
<?
disp_list2 ;

// ①DB接続しSQLを発行してデータを取得
$dbh = get_db_connect($_COOKIE['DSN_Campany']);
$errs = array();
$sql = 'select '.$PH_SELECE.' from '.$PH_FROM.' where '.$PH_WHERE;
if ($data = Record_Load($dbh,$sql)) {
	// ②テーブルのデータをoptionタグに整形
	if($_SESSION['num']===""){
		$data .= '<option value selected>指定なし</OPTION>';
	}else{
		'<OPTION value="" >指定なし</OPTION>';
	}
	foreach($data as $data_val){
    	$data .= "<option value='". $data_val['器物分類コード'];
		if($_SESSION['nam']===$data_val['器物分類コード']){
			$data .=' selected ';
		}
    	$data .= "'>". $data_val['器物分類名']. "</option>";
	}
}?>


IF SESSION.CONTENTS("sec1")="" THEN
		RESPONSE.WRITE "<OPTION value="""" selected>指定なし</OPTION>"
	ELSE
		RESPONSE.WRITE "<OPTION value="""" >指定なし</OPTION>"
	END IF%>
	<%
for intR = 0 to UBound(avarCust,2)
SLC=""
IF SESSION.CONTENTS("sec1")=avarCust(conCustID,intR) THEN
	SLC=" SELECTED"
end if
response.write "<option value='" _
 & avarCust(conCustID,intR) & "'" & SLC &">" _
& avarCust(conCustName,intR) _
& "</option>" & vbNewLine
next
%>
	</select></TD>
    </tr>
<%
NM_DB = "imaster.mdb"
PH_SELECE = "所番地分類2,所番地2"
PH_FROM = "i所番地分類2"
PH_WHERE = " 使用状態=yes Order by 所番地分類2;"
GET_avarCust NM_DB,PH_SELECE,PH_FROM,PH_WHERE
%>
<tr>
<th CLASS=C1><%=p2%></th>
<TD>
<select CLASS=W20 name="sec2" id="text81" onkeydown="if((event.keyCode==13)){text9.focus()};">
<% IF SESSION.CONTENTS("sec2")="" THEN
RESPONSE.WRITE "<OPTION value="""" selected>指定なし</OPTION>"
ELSE
		RESPONSE.WRITE "<OPTION value="""" >指定なし</OPTION>"
	END IF%>
<%
for intR = 0 to UBound(avarCust,2)
SLC=""
IF SESSION.CONTENTS("sec2")=avarCust(conCustID,intR) THEN
	SLC=" SELECTED"
end if
response.write "<option value='" _
 & avarCust(conCustID,intR) & "'" & SLC &">" _
& avarCust(conCustName,intR) _
& "</option>" & vbNewLine
next
%>
</select></TD>
<TD colspan="7" width="70"><br></TD>
</tr>

<TR>
      <th CLASS=C1><%=p3%></TH>
      <TD><SELECT CLASS=W20 name="sec3" id="text9" onkeydown="if((event.keyCode==13)){text10.focus()};">
        <% IF SESSION.CONTENTS("sec3")="" THEN
		RESPONSE.WRITE "<OPTION value="""" selected>指定なし</OPTION>"
	ELSE
		RESPONSE.WRITE "<OPTION value="""" >指定なし</OPTION>"
	END IF%>
        <%
NM_DB = "imaster.mdb"
PH_SELECE = "所番地分類3,所番地3"
PH_FROM = "i所番地分類3"
PH_WHERE = " 使用状態=yes Order by 所番地分類3;"
GET_avarCust NM_DB,PH_SELECE,PH_FROM,PH_WHERE

	for intR = 0 to UBound(avarCust,2)
SLC=""
IF SESSION.CONTENTS("sec3")=avarCust(conCustID,intR) THEN
	SLC=" SELECTED"
end if
response.write "<option value='" _
 & avarCust(conCustID,intR) & "'" & SLC &">" _
& avarCust(conCustName,intR) _
& "</option>" & vbNewLine
	next
	%>

      </SELECT></TD>
    </TR>


<%'-------

if mas_info_s4 then

'-------
%>


    <TR>
      <th CLASS=C1><%=p4%></th>
      <TD><SELECT CLASS=W20 name="sec4" id="text10" onkeydown="if((event.keyCode==13)){text11.focus()};">
        <% IF SESSION.CONTENTS("sec4")="" THEN
		RESPONSE.WRITE "<OPTION value="""" selected>指定なし</OPTION>"
	ELSE
		RESPONSE.WRITE "<OPTION value="""" >指定なし</OPTION>"
	END IF%>
        <%
NM_DB = "imaster.mdb"
PH_SELECE = "所番地分類4,所番地4"
PH_FROM = "i所番地分類4"
PH_WHERE = " 使用状態=yes Order by 所番地分類4;"
GET_avarCust NM_DB,PH_SELECE,PH_FROM,PH_WHERE

	for intR = 0 to UBound(avarCust,2)
SLC=""
IF SESSION.CONTENTS("sec4")=avarCust(conCustID,intR) THEN
	SLC=" SELECTED"
end if
response.write "<option value='" _
 & avarCust(conCustID,intR) & "'" & SLC &">" _
& avarCust(conCustName,intR) _
& "</option>" & vbNewLine
	next
	%>

      </SELECT></TD>
    </TR>



<%'---------

end if

'-----------
%>



<%'--------------------%>
<%'-------

if mas_info_s5 then

'-------
%>

    <tr>
      <th CLASS=C1><%=p5%></TH>
    <TD><INPUT CLASS=W20 type="text" value="<%=session.Contents("sec5")%>" id="text11" name="sec5"  style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text12.focus()};" onblur="if(!(isStr(this))){text11.focus()};" size="14"></TD>
    </tr>


<%'---------

end if

'-----------
%>


    <TR>
      <th CLASS=C1>サイズ</th>
      <TD><INPUT CLASS=W10 type="text" name="size" value="<%=session.Contents("size")%>" id="text12" style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text101.focus()};" onblur="if(!(isStr(this))){text12.focus()};" >
	<input type="checkbox" name="aimai" id="text101" onkeydown="if((event.keyCode==13)){text13.focus()};" VALUE=TRUE <%if session.Contents("aimai")=TRUE then RESPONSE.WRITE "checked" end if%> >
<P class=small_chr>あいまい検索</P></TD>
    </TR>



<%
if kanrijoutaihyouji then
%>


    <TR>
      <th CLASS=C1>管理状態</TH>
      <TD>

		<select name="kanrijoutai" id="text13"  onkeydown="if((event.keyCode==13)){text14.focus()};">
			<%
			nashi=""
			ichi=""
			ni=""
			san=""
			yon=""
			if session.contents("kanrijoutai")="" then
				nashi=" selected"
			elseif session.contents("kanrijoutai")=1 then
				ichi=" selected"
			elseif session.contents("kanrijoutai")=2 then
				ni=" selected"
			elseif session.contents("kanrijoutai")=3 then
				san=" selected"
			elseif session.contents("kanrijoutai")=4 then
				yon=" selected"
			end if
			RESPONSE.WRITE "<OPTION value=''" & nashi & ">指定なし</OPTION>"
			RESPONSE.WRITE "<OPTION value=1" & ichi & ">使用</OPTION>"
			RESPONSE.WRITE "<OPTION value=2" & ni & ">保管</OPTION>"
			RESPONSE.WRITE "<OPTION value=3" & san & ">廃棄</OPTION>"
			if ng then
			RESPONSE.WRITE "<OPTION value=4" & yon & ">未処置</OPTION>"
			end if%>
		</select></TD>
    </TR>


<%
end if


if kensashukihyouji then
%>

    <TR>
      <th CLASS=C1>検査周期</TH>
      <TD>
<%
s3=""
s6=""
s12=""
s24=""
s36=""
s60=""
S100=""
x=Session.contents("shuki")
if len(x)=0 then
x=100
end if

select case x
case 3
s3=" selected"
case 6
s6=" selected"
case 12
s12=" selected"
case 24
s24=" selected"
case 36
s36=" selected"
case 60
s60=" selected"
case 100
s100=" selected"
end select
%>


		<select CLASS=W10 name="shuki" id="text14"  onkeydown="if((event.keyCode==13)){text15.focus()};">
			<option value="" <%=s100%>>指定なし</option>
			<option value="3" <%=s3%>>3ヶ月</option>
			<option value="6" <%=s6%>>6ヶ月</option>
			<option value="12" <%=s12%>>12ヶ月</option>
			<option value="24" <%=s24%>>24ヶ月</option>
			<option value="36" <%=s36%>>36ヶ月</option>
			<option value="60" <%=s60%>>60ヶ月</option>
		</select></TD>


    </TR>


<%end if%>



	<TR>
	<th CLASS=C1>品番</th>
	<TD><INPUT CLASS=W20 type="text" name="hinban" value="<%=session.Contents("hinban")%>" id="text15"
style="ime-mode:disabled;" onkeydown="if((event.keyCode==13)){text17.focus()};" onblur="if(!(isStr(this))){text15.focus()};" ></TD>
	</TR>


	<tr >
	<TD style="padding-top:10px;" colspan=2 align=center>
	<input type="submit" id="text17" NAME="KENSAKU" value=検索実行(G) accesskey="g" onkeydown="if((event.keyCode==13)){this.form.submit()}else if((event.keyCode==37 || event.keyCode==38)){text15.focus()};"  >
	<input type="submit" id="text18" NAME="KENSAKU" value=集計(S) accesskey="s" onkeydown="if((event.keyCode==13)){this.form.submit()}else if((event.keyCode==37 || event.keyCode==38)){text15.focus()};"  >
	<input type="submit" NAME="KENSAKU" value="取消" /></TD>
	</tr>



</table>
</form>
</div>
<!-- 検索終わり -->


</DIV>

<DIV id=block04>

<h1>目的別検索</h1>

<DIV class=kensaku id=kensaku1 >


<FORM id=form2 NAME=KEKKA method=POST action=listing_kekka.asp onkeydown=if(event.keyCode==13){event.returnValue=false};>

<TABLE>

<TR>
	<TD><h1>校正結果</h1></TD>
</TR>

<TR>
<%
h1=dateadd("m",-1,now)
%>
	<TD style="padding-top : 10px;font-size : 0.8em ; vertical-align: middle;"><INPUT type="text" NAME=Y1_KDATE SIZE=6 value= <%IF LEN(SESSION.CONTENTS("Y1_KDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("Y1_KDATE") ELSE RESPONSE.WRITE YEAR(h1) END IF%> style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME=M1_KDATE SIZE=3 value=<%IF LEN(SESSION.CONTENTS("M1_KDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("M1_KDATE") ELSE RESPONSE.WRITE month(h1) END IF%> style="ime-mode:disabled;">
	月
	～
	<INPUT type="text" NAME=Y2_KDATE SIZE=6 value=<%IF LEN(SESSION.CONTENTS("Y2_KDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("Y2_KDATE") ELSE RESPONSE.WRITE YEAR(h1) END IF%> style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME=M2_KDATE SIZE=3 value=<%IF LEN(SESSION.CONTENTS("M2_KDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("M2_KDATE") ELSE RESPONSE.WRITE month(h1) END IF%> style="ime-mode:disabled;">
	月</td>
</TR>
<%
'if cbool(Session.Contents("NG")) then
%>
<TR>
	<TD><p class="ckbox"><input type="checkbox" name=OK VALUE=true <%if session.Contents("OK")=TRUE then RESPONSE.WRITE "checked " end if%> >
	合格（ＯＫ）</p><p><input type="checkbox" name=NOGOOD VALUE=true <%if session.Contents("NOGOOD")=TRUE then %> checked <%end if%> >
	不合格（ＮＧ）</p><p><input type="checkbox" name=YOUCHUI VALUE=true <%if session.Contents("YOUCHUI")=TRUE then %> checked <%end if%> >
	要注意</p></TD>
</TR>
<TR>
	<TD><p>
	<input type="checkbox" name=HJKIKAKU VALUE=true <%if session.Contents("HJKIKAKU")=TRUE then %>checked<%end if%>>
	ＨＪ規格（日高計量士事務所規格）</p></TD>
</TR>
<TR>
	<TD>
	<p><input type="checkbox" name=MISHOCHI VALUE=true <%if session.Contents("MISHOCHI")=TRUE then %>checked<%end if%> >
	未処置
	</p><p><input type="checkbox" name=HAIKI VALUE=true <%if session.Contents("HAIKI")=TRUE then %>checked<%end if%>>
	廃棄・廃却</p></TD>
</TR>
<%'end if%>
<TR>

	<TD><input type="submit" name=KEKKA VALUE=校正結果表示 onkeydown="if((event.keyCode==13)){this.form.submit()}">&emsp;
	<input type="submit" name=KEKKA VALUE=集計>&emsp;
	<input type="submit" name=KEKKA value=取消 /></TD>

</TR>
</TABLE>
</FORM>


<%if kouseiyoteihyouji then%>
<%if admin then  'if kensaku then%>
<TABLE>
<FORM id=form3 NAME=CALYOTEI method="POST" action="listing_yotei.asp" onkeydown="if(event.keyCode==13){event.returnValue=false};">
<TR>
	<TD><h1>校正予定</h1></TD>
</TR>
<TR>
	<TD style="padding-top : 10px;font-size : 0.8em ; vertical-align: middle;">
<INPUT type="text" NAME=Y1_YDATE SIZE=6 value= <%IF LEN(SESSION.CONTENTS("Y1_YDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("Y1_YDATE") ELSE RESPONSE.WRITE YEAR(now) END IF %>  style="ime-mode:disabled;">
	年
<INPUT type="text" NAME=M1_YDATE SIZE=3 value= <%IF LEN(SESSION.CONTENTS("M1_YDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("M1_YDATE") ELSE RESPONSE.WRITE MONTH(now) END IF %>  style="ime-mode:disabled;">
	月
	～
	<INPUT type="text" NAME=Y2_YDATE SIZE=6 value= <%IF LEN(SESSION.CONTENTS("Y2_YDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("Y2_YDATE") ELSE RESPONSE.WRITE YEAR(now) END IF %> style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME=M2_YDATE SIZE=3 value =<%IF LEN(SESSION.CONTENTS("M2_YDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("M2_YDATE") ELSE RESPONSE.WRITE MONTH(now) END IF %> style="ime-mode:disabled;">
	月</td>
</TR>

<TR>
	<TD style="padding-top:10px;" ><input type="submit" name=YOTEI VALUE=校正予定>&emsp;
	<input type="submit" name=YOTEI VALUE=集計>&emsp;
	<input type="submit" name=YOTEI value="取消" /></TD>
</TR>
</TABLE>
</FORM>
<%end if%>

<TABLE>
<FORM id=form4 NAME=CALtougetsu method="POST" action="listing_yotei.asp";">

<TR>
	<TD><h1><%=year(now)%>年<%=month(now)%>月　校正予定　一覧</h1></TD>
</TR>
<TR>
	<INPUT type="hidden" NAME=Y1_YDATE value=<%=year(now)%>>
	<INPUT type="hidden" NAME=M1_YDATE value=<%=month(now)%>>
	<INPUT type="hidden" NAME=Y2_YDATE value=<%=year(now)%>>
	<INPUT type="hidden" NAME=M2_YDATE value=<%=month(now)%>>

	<TD COLSPAN=9><input type="submit" name=tougetsu VALUE=当月校正予定>&emsp;
	<input type="submit" name=tougetsu  VALUE=集計></TD>

</TR></FORM>
</TABLE>
<%end if%>

<%
'if cbool(Session.Contents("NG")) then
if kigengirehyouji then
if ADMIN then
%>

<TABLE>
<FORM id=form5 NAME=CALkigen method="POST" action="listing.asp" ;">

<TR>
	<td><h1><%=year(now)%>年<%=month(now)%>月現在　校正期限切れ　一覧</h1></TD>
</TR>
<TR>
	<td>
	<INPUT type="hidden" NAME=Y1_YDATE value=<%=year(now)%>>
	<INPUT type="hidden" NAME=M1_YDATE value=<%=month(now)%>>
	<input class="w15" type="submit" style="width : 150px;" name=kigen VALUE=<%=year(now)%>年<%=month(now)%>月現在期限切れ>&emsp;
	<input type="submit" name=kigen VALUE=集計>&emsp;
	<input type="submit" name=kigen value="取消" /></TD>


<TR>
	<TD style="padding-top : 10px;font-size : 0.8em ; vertical-align: middle;"><INPUT type="text" NAME=Y1_kiDATE SIZE=6 value=<%IF LEN(SESSION.CONTENTS("Y1_kiDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("Y1_kiDATE") ELSE RESPONSE.WRITE YEAR(now) END IF %> style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME=M1_kiDATE SIZE=3 value=<%IF LEN(SESSION.CONTENTS("M1_kiDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("M1_kiDATE") ELSE RESPONSE.WRITE MONTH(now) END IF %> style="ime-mode:disabled;">
	月　～　
	<INPUT type="text" NAME=Y2_kiDATE SIZE=6 value=<%IF LEN(SESSION.CONTENTS("Y2_kiDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("Y2_kiDATE") ELSE RESPONSE.WRITE YEAR(now) END IF %> style="ime-mode:disabled;">
	年
	<INPUT type="text" NAME=M2_kiDATE SIZE=3 value=<%IF LEN(SESSION.CONTENTS("M2_kiDATE"))>0 THEN RESPONSE.WRITE SESSION.CONTENTS("M2_kiDATE") ELSE RESPONSE.WRITE MONTH(now) END IF %> style="ime-mode:disabled;">
	月</TD>
</TR>
<TR>
	<TD style="padding-top:10px;" ><input type="submit" name=kigen VALUE=期限切れ>&emsp;
	<input type="submit" name=kigen VALUE=期限切れ集計>&emsp;
	<input type="submit" name=kigen value="取消" /></TD>
</TR>

<TR>
	<TD><p class="ckbox"><input type="checkbox" name=kigen_mishochi VALUE=true <%if session.Contents("kigen_mishochi")=true then %> checked <% end if%> >
	未処置</p><p><input type="checkbox" name=kigen_haiki VALUE=true <%if session.Contents("kigen_haiki")=true then %> checked <% end if%> >
	廃棄・廃却</p></TD>
</TR>


</TR></FORM>
</TABLE>
<%end if%>
<%end if%>
</DIV>

</DIV>


<%
if kakushulisthyouji and (m_haiki or m_henkou or m_ichiren) then
'if session.contents("admin") then%>

<DIV id=block03>
<h1>各種リスト</h1>
<%
if kakushulisthyouji then
'if ADMIN then
session.contents("modori")=9%>

<DIV id="kensaku5" >

<form method="POST" action="search.asp">
<table>
    <tr>
    <%if t_henko then%><tr>
	<td><a class="button" href=checklist.asp?action=up_list&hyouji_mode=10>修正リスト</td>
    </tr><%end if%>
    <%if sakujo then%><tr>
	<td><a class="button" href=checklist.asp?action=del_list&hyouji_mode=10>廃棄リスト</td>
    </tr><%end if%>
    <%if m_ichiren then%><tr>
	<td><a href=ichirenlist.asp?><img id=photo src=img/一連登録リスト.gif  border=0></td>
    </tr><%end if%>
</table>
</form>
</div>
<%'end if%>
<%end if%>
</DIV>
<%'end if%>
<%end if%>


<%

'=========フォームからの変遷

Else

dim kikan
kikan=#2001/04/01#
admin=cbool(session.contents("admin"))

	flag=False
	dim SQL,SQL2
	Set db=Server.CreateObject("ADODB.Connection")
	db.Provider="Microsoft.Jet.OLEDB.4.0"
	db.Mode=1
	db.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	db.Open
	'SQL="SELECT 管理記号,管理数字,管理補助記号,管理補助数字,製造番号,全名称,所番地2,最小値,最大値,目量,サイズ,通り側,止まり側,登録年月日,備考1,型式,所番地3,最新校正日,マスタID ,IIf(型式コード=""N03"" Or 型式コード=""N08"" Or 型式コード=""N10"",""hight"",""std"") AS 型式コード1 FROM iマスター "

'管理記号
	If Request.Form("id1")<>"" Then
		If flag=False Then
			SQL=SQL & "WHERE "
		end if
		SQL=SQL & "管理記号='" & Request.Form("id1") & "' "
		flag=True
	End If
		Session.contents("id1")= Request.Form("id1")

'管理数字

	If Request.Form("id2")<>""  and Request.Form("id3")<>"" Then

		If flag Then
			SQL=SQL & "AND "
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "管理数字>=" & Request.Form("id2") & " and 管理数字<=" & Request.Form("id3")& " "

		flag=True
	elseif Request.Form("id2")<>""  and Request.Form("id3")="" Then
		If flag Then
			SQL=SQL & "AND "
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "管理数字=" & Request.Form("id2") & " "

		flag=True
	elseif Request.Form("id2")=""  and Request.Form("id3")<>"" Then
		If flag Then
			SQL=SQL & "AND "
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "管理数字=" & Request.Form("id3") & " "

		flag=True
	End If
		Session.contents("id2")= Request.Form("id2")
		Session.contents("id3")= Request.Form("id3")

'管理数字2
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




'製造番号
	If Request.Form("fnum")<>"" Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "製造番号='" & Request.Form("fnum") & "' "
		flag=True
	End If
		Session.contents("fnum")= Request.Form("fnum")

'器物分類名
	If (Request.Form("nam")<>"" and Request.Form("nam")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "器物分類コード='" & Request.Form("nam") & "' "
		flag=True
	End If
		Session.contents("nam")= Request.Form("nam")

'型式番号
	If Request.Form("katashiki_code")<>""  Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "型式番号='" & Request.Form("katashiki_code") & "' "
		flag=True
	End If
		Session.contents("katashiki_code")= Request.Form("katashiki_code")


'所番地１
	If (Request.Form("sec1")<>"" and Request.Form("sec1")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "所番地分類1='" & Request.Form("sec1") & "' "
		flag=True
	End If
		Session.contents("sec1")= Request.Form("sec1")


'所番地２
	If (Request.Form("sec2")<>"" and Request.Form("sec2")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "所番地分類2='" & Request.Form("sec2") & "' "
		flag=True
	End If
		Session.contents("sec2")= Request.Form("sec2")

'所番地３
	If (Request.Form("sec3")<>"" and Request.Form("sec3")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "所番地分類3='" & Request.Form("sec3") & "' "
		flag=True
	End If
		Session.contents("sec3")= Request.Form("sec3")

'所番地4
	If (Request.Form("sec4")<>"" and Request.Form("sec4")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "所番地分類4='" & Request.Form("sec4") & "' "
		flag=True
	End If
		Session.contents("sec4")= Request.Form("sec4")


'所番地5
	If (Request.Form("sec5")<>"" and Request.Form("sec5")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "置き場1='" & Request.Form("sec5") & "' "
		flag=True
	End If
		Session.contents("sec5")= Request.Form("sec5")

'サイズ

	If Request.Form("size")<>""  Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		if isnumeric(Request.Form("size")) then
			SQL=SQL & "(サイズ='" & Request.Form("size") & "' or 最大値=" & Request.Form("size") & ") "
		else
			if Request.Form("aimai") then
				SQL=SQL & "サイズ like '%" & Request.Form("size") & "%' "
			else
				SQL=SQL & "サイズ='" & Request.Form("size") & "' "
			end if
		end if

		flag=True
	End If
		Session.contents("size")= Request.Form("size")

'管理状態

	If (Request.Form("kanrijoutai")<>"" and Request.Form("kanrijoutai")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "使用区分コード='" & Request.Form("kanrijoutai") & "' "
		flag=True
	End If
		Session.contents("kanrijoutai")= Request.Form("kanrijoutai")

'検査周期

	If (Request.Form("shuki")<>"" and Request.Form("shuki")<>"指定なし") Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "検査周期=" & Request.Form("shuki") & " "
		flag=True
	End If
		Session.contents("shuki")= Request.Form("shuki")

'最新校正日
	If Request.Form("data1")<>""  Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		if Request.Form("data2")="" then
			data2 = Request.Form("data1")
		else
		data2= Request.Form("data2")
		end if

		SQL=SQL & "最新校正日 between #" & Request.Form("data1") & "# and #" & data2 & "# "
		flag=True
	End If
		Session.contents("data1")= Request.Form("data1")
		Session.contents("data2")= Request.Form("data2")

'品番
	If Request.Form("hinban")<>"" Then
		If flag Then
			SQL=SQL & "AND "
			SQL1=SQL1 & "&"
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "品番='" & Request.Form("hinban") & "' "
		flag=True
	End If
		Session.contents("hinban")= Request.Form("hinban")
'制約
	If not admin and session.contents("ID_kaishamei")="mannou" Then
		If flag Then
			SQL=SQL & "AND "
		Else
			SQL=SQL & "WHERE "
		End If
		SQL=SQL & "最新校正日>=#" & kikan &"# "
		flag=True
	End If

session.contents.remove("order1")
session.contents.remove("order2")
session.contents.remove("order3")
session.contents.remove("order4")
session.contents.remove("order5")
session.contents.remove("order6")





	session.contents("back")=sql

	'031206
'===========検索
	IF request.form("KENSAKU") = "集計(S)"  then
		SESSION.CONTENTS("SHUKEI_MODE")=1
		Response.Redirect "TABLE.asp"
	END IF

'value="取消"
	IF request.form("KENSAKU") = "取消"  then
'Sessionデータの格納（クリア）
session.contents.remove("id1")
session.contents.remove("id2")
session.contents.remove("id3")
session.contents.remove("id4")
session.contents.remove("nam")
session.contents.remove("fnum")
session.contents.remove("katashiki_code")
session.contents.remove("sec1")
session.contents.remove("sec2")
session.contents.remove("sec3")
session.contents.remove("sec5")
session.contents.remove("size")
session.contents.remove("aimai")
session.contents.remove("kanrijoutai")
session.contents.remove("shuki")
session.contents.remove("data1")
session.contents.remove("data2")
session.contents.remove("hinban")
	Response.Redirect "SEARCH.asp"
	END IF

	Response.Redirect "listing.asp"
	'030414>


End If
%>

<!--#include file=inc/uni_func.asp -->
<DIV class=separate></DIV>

</div>
<!--#include file=inc/footer.asp -->


</BODY>


</html>
