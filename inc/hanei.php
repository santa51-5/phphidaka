<?php
function hanei{
/*ここから、後々完成させる
sec_henkou_hanei;
new_hanei;
del_hanei;
p_hanei;
fukatsu_hanei;
ここまで*/

$SESSION['hanei']=true;
}

function sec_henkou_hanei{

	Set dbs=Server.CreateObject("ADODB.Connection")
	dbs.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs.Mode=3
	dbs.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/inew.mdb")
	dbs.Open

	sqls="Select * from trans where 進捗 = false ;"

	Set rss=Server.CreateObject("ADODB.Recordset")
	rss.Open SQLs,dbs,3,3

	if rss.recordcount>0 then
	rss.movefirst
	for i=1 to rss.recordcount

	Set dbs2=Server.CreateObject("ADODB.Connection")
	dbs2.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs2.Mode=1
	dbs2.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	dbs2.Open
	sqls2="Select * from iマスター where マスタＩＤ = " & rss("mas_id")
	Set rss2=Server.CreateObject("ADODB.Recordset")
	rss2.Open SQLs2,dbs2,3,3

	s1=null:s2=null:s3=null:ss1=null:ss2=null:ss3=null
	s1=rss("sec1"):s2=rss("sec2"):s3=rss("sec3"):ss1=rss2("所番地分類1"):ss2=rss2("所番地分類2"):ss3=rss2("所番地分類3")

	if isnull(s1) then s1="" :end if
	if isnull(s2) then s2="" :end if
	if isnull(s3) then s3="" :end if
	if isnull(ss1) then ss1="" :end if
	if isnull(ss2) then ss2="" :end if
	if isnull(ss3) then ss3="" :end if

	c_hanei=0
	if s1<>ss1 then c_hanei=1 :end if
	if s2<>ss2 then c_hanei=1 :end if
	if s3<>ss3 then c_hanei=1 :end if

	if c_hanei=0 AND rss("進捗")=FALSE then
		RSS.UPDATE "進捗",TRUE 'SQLs="UPDATE trans SET 進捗=true WHERE mas_id=" & rss("mas_id") & ";"
		'dbs2.Execute(SQLs)
	end if

	'if c_hanei=1 then response.redirect "debug.asp?st1="&s1&s2&rss("mas_id")

	rss2.close
	dbs2.close
	set rss2=nothing
	set dbs2=nothing

	rss.movenext
	next

	end if

rss.close
dbs.close
set rss=nothing
set dbs=nothing

end sub

sub new_hanei

	Set dbs=Server.CreateObject("ADODB.Connection")
	dbs.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs.Mode=2
	dbs.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/inew.mdb")
	dbs.Open

	sqls="Select * from newmaster where import = false ;"
	
	Set rss=Server.CreateObject("ADODB.Recordset")
	rss.Open SQLs,dbs,3,3

	if rss.recordcount>0 then
	rss.movefirst
	for i=1 to rss.recordcount
	
	Set dbs2=Server.CreateObject("ADODB.Connection")
	dbs2.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs2.Mode=1
	dbs2.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	dbs2.Open
	sqls2="Select * from iマスター where 管理記号 = '" & rss("管理記号") & "' and 管理数字=" & rss("管理数字")
	Set rss2=Server.CreateObject("ADODB.Recordset")
	rss2.Open SQLs2,dbs2,3,3

	c_hanei=0
	if rss2.recordcount>0 then c_hanei=1 :end if
	'response.redirect "debug.asp?st1="&c_hanei&rss2.recordcount

	if c_hanei=1 AND rss("import")=FALSE then
		rss.update "import",true 'SQLs="UPDATE newmaster SET import=true WHERE 管理記号 = '" & rss("管理記号") & "' and 管理数字=" & rss("管理数字")
		'dbs2.Execute(SQLs)
	end if

	rss2.close
	dbs2.close
	set rss2=nothing
	set dbs2=nothing

	rss.movenext
	next

	end if

rss.close
dbs.close
set rss=nothing
set dbs=nothing

}


sub del_hanei

	Set dbs=Server.CreateObject("ADODB.Connection")
	dbs.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs.Mode=3
	dbs.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/inew.mdb")
	dbs.Open

	sqls="Select * from del where import = false ;"
	
	Set rss=Server.CreateObject("ADODB.Recordset")
	rss.Open SQLs,dbs,3,3

	if rss.recordcount>0 then
	rss.movefirst
	for i=1 to rss.recordcount
	
	Set dbs2=Server.CreateObject("ADODB.Connection")
	dbs2.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs2.Mode=1
	dbs2.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	dbs2.Open
	sqls2="Select * from iマスター where マスタＩＤ = " & rss("mas_id")
	Set rss2=Server.CreateObject("ADODB.Recordset")
	rss2.Open SQLs2,dbs2,3,3

	c_hanei=0
	if rss2("使用区分コード")=3 then c_hanei=1 

	if c_hanei=1 AND rss("import")=FALSE then
		rss.update "import",true 'SQLs="UPDATE trans SET import=true WHERE mas_id=" & rss("mas_id") & ";"
		'dbs2.Execute(SQLs)
	end if

	rss2.close
	dbs2.close
	set rss2=nothing
	set dbs2=nothing

	rss.movenext
	next

	end if

rss.close
dbs.close
set rss=nothing
set dbs=nothing

end sub

sub p_hanei
'所番地変更

	Set dbs=Server.CreateObject("ADODB.Connection")
	dbs.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs.Mode=3
	dbs.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/inew.mdb")
	dbs.Open

	sqls="Select * from m_code where 進捗 = false ;"
	
	Set rss=Server.CreateObject("ADODB.Recordset")
	rss.Open SQLs,dbs,3,3

	if rss.recordcount>0 then
	rss.movefirst
	for i=1 to rss.recordcount
	
	Set dbs2=Server.CreateObject("ADODB.Connection")
	dbs2.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs2.Mode=1
	dbs2.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	dbs2.Open

select case left(rss("mas_id"),1)
case 1
tb_name="i所番地分類1"
fd_name="hid"
p="コード"
pp=p1
case 2
tb_name="i所番地分類2"
fd_name="hid"
p="コード"
pp=p2
case 3
tb_name="i所番地分類3"
fd_name="hid"
p="コード"
pp=p3
case 4
tb_name="i器物分類コード"
fd_name="hid"
app=" where 記号 is not NUll"
p="名称"
pp="記号"
end select


	sqls2="Select * from " & tb_name & " where " & fd_name & " = " & rss("mas_id")
	Set rss2=Server.CreateObject("ADODB.Recordset")
	rss2.Open SQLs2,dbs2,3,3

	c_hanei=0

select case rss("id4")
case 1 '変更
	if rss2("所番地分類2")=rss("id1") or rss2("所番地2")=rss("id2") then c_hanei=1 :end if

	if c_hanei=1 AND rss("進捗")=FALSE then
		rss.update "進捗",true 'SQLs="UPDATE trans SET import=true WHERE mas_id=" & rss("mas_id") & ";"
		'dbs2.Execute(SQLs)
	end if
	
case 2 '削除
	if rss2("使用状態")=FALSE then c_hanei=1  :end if

	if c_hanei=1 AND rss("進捗")=FALSE then
		rss.update "進捗",true 'SQLs="UPDATE trans SET import=true WHERE mas_id=" & rss("mas_id") & ";"
		'dbs2.Execute(SQLs)
	end if

case 3 '追加
if rss2.recordcount>0 then

	if rss2("使用状態")=true then c_hanei=1  :end if

	if c_hanei=1 AND rss("進捗")=FALSE then
		rss.update "進捗",true 'SQLs="UPDATE trans SET import=true WHERE mas_id=" & rss("mas_id") & ";"
		'dbs2.Execute(SQLs)
	end if
end if
end select


	rss2.close
	dbs2.close
	set rss2=nothing
	set dbs2=nothing

	rss.movenext
	next

	end if

rss.close
dbs.close
set rss=nothing
set dbs=nothing

end sub



sub fukatsu_hanei

	Set dbs=Server.CreateObject("ADODB.Connection")
	dbs.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs.Mode=3
	dbs.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/inew.mdb")
	dbs.Open

	sqls="Select * from fukatsu where import = false ;"
	
	Set rss=Server.CreateObject("ADODB.Recordset")
	rss.Open SQLs,dbs,3,3

	if rss.recordcount>0 then
	rss.movefirst
	for i=1 to rss.recordcount
	
	Set dbs2=Server.CreateObject("ADODB.Connection")
	dbs2.Provider="Microsoft.Jet.OLEDB.4.0"
	dbs2.Mode=1
	dbs2.ConnectionString=Server.MapPath("./cgi-bin/mydb/" & ID_kaishamei & "/imaster.mdb")
	dbs2.Open
	sqls2="Select * from iマスター where マスタＩＤ = " & rss("mas_id")
	Set rss2=Server.CreateObject("ADODB.Recordset")
	rss2.Open SQLs2,dbs2,3,3

	c_hanei=0
	if rss2("使用区分コード")=1 then c_hanei=1 

	if c_hanei=1 AND rss("import")=FALSE then
		rss.update "import",true 'SQLs="UPDATE trans SET import=true WHERE mas_id=" & rss("mas_id") & ";"
		'dbs2.Execute(SQLs)
	end if

	rss2.close
	dbs2.close
	set rss2=nothing
	set dbs2=nothing

	rss.movenext
	next

	end if

rss.close
dbs.close
set rss=nothing
set dbs=nothing

end sub


%>