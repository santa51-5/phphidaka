<%
function GetPREVLOG()

On Error Resume Next

rs_dir=left(Server.Mappath("."),InStrRev(Server.Mappath("."),"\")-1)
if isnull(campany) or len(campany)=0 then campany= Request.Cookies("test")

DBNames="PROVIDER=MICROSOFT.JET.OLEDB.4.0;DATA SOURCE=" & rs_dir & "/do/cgi-bin/mydb/" & campany & "/info.mdb"

Set dbs=Server.CreateObject("ADODB.Connection")
dbs.Open DBNames
	sqls="SELECT MAX(LOGTime) as LOGTime FROM LogTimeTable WHERE LOGname <> 'tatsuya' group by LOGtype having LOGtype=1;"
	set rss=dbs.execute(sqls)
 if not rss.eof then
	if rss.RecordCount=0 then
		GetPREVLOG="初めてのログインです"
	else
		GetPREVLOG=rss("LOGTime")
	end if
 Else
  GetPREVLOG="初めてのログインです"
 end if
rss.close
dbs.close
set rss=nothing
set dbs=nothing

If Err.Number <> 0 Then
    GetPREVLOG="ありません"
End If
Err.Clear
On Error Goto 0
end function
%>
