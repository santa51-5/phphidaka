<%
dim intPageSize
dim intPageCount
dim intPageCurrent
dim strOrderBy
dim intRecordsShown
dim intI
dim strOption

'http://d.hatena.ne.jp/shenghuo/20090320/1237532558　参考
'PAGE(現在のページの決定)
if (len(request.QueryString("page")) = 0 and len(request.form("jump"))=0) or len(request.form("setting"))>0 then
	intPageCurrent = 1
elseif len(request.form("jump"))>0 then
	intPageCurrent = cint(request.form("jump"))'
else
	intPageCurrent = cint(request.QueryString("page")) '前次のページ移動
end if

'PAGESIZE(ページサイズの決定)
if len(request.QueryString("pagesize")) = 0 then
	if len(request.form("pagesize")) = 0 then
		intPageSize = 10
	elseif len(request.form("pagesize")) > 0 then
		intPageSize = cint(request.form("pagesize"))
	end if
else
	intPageSize = cint(request.QueryString("pagesize"))
end if

'pl_start(ページリストの頭決定)
if len(request.QueryString("pl_start")) = 0 then
	pl_start = 0
else
	pl_start = cint(request.QueryString("pl_start"))
end if
if len(request.form("jump"))>0 then
	pl_start = fix(request.form("jump")/10)*10
end if


'order(並べ替え決定) order3,order5


if len(request.form("order1")) > 0 then
 if request.form("order1")="管理番号" then
  strOrderBy = "管理記号 " & request.form("order2") & ",管理数字 " & request.form("order2") & ",管理補助記号,管理補助数字 "
 else
  strOrderBy = request.form("order1") & " " & request.form("order2")
 end if
session.contents("order1")=request.form("order1")
session.contents("order2")=request.form("order2")
end if

if len(request.form("order3")) > 0 then
 if request.form("order3")="管理番号" then
  strOrderBy = strorderby & ",管理記号 " & request.form("order4") & ",管理数字 " & request.form("order4") & ",管理補助記号,管理補助数字 "
 else
  strOrderBy = strorderby & "," & request.form("order3") &  request.form("order4")
 end if
session.contents("order3")=request.form("order3")
session.contents("order4")=request.form("order4")
end if

if len(request.form("order5"))> 0 then
 if request.form("order5")="管理番号" then
  strOrderBy = strorderby & ",管理記号 " & request.form("order6") & ",管理数字 " & request.form("order6") & ",管理補助記号,管理補助数字 "
 else
  strOrderBy = strorderby & "," & request.form("order5") & request.form("order6")
 end if
session.contents("order5")=request.form("order5")
session.contents("order6")=request.form("order6")
end if

if len(request.querystring("order"))>0 and len(strOrderBy)=0 then
strOrderBy=request.querystring("order")
end if

if len(strOrderBy)=0 or request.form("setting")="リセット" then
strOrderBy="管理記号,管理数字,管理補助記号,管理補助数字"
end if


'response.redirect "debug.asp?st1="&request.form("order1")&":"&request.form("order3")&":"&request.form("order5")&":"&strorderby&"→"&request.form("setting")

'データ格納
if len(request.QueryString("page"))>0 or not isnull(request.QueryString("page")) then
session.contents("page")=request.QueryString("page")
end if

if len(request.QueryString("pagesize"))>0 or not isnull(request.QueryString("pagesize")) then
session.contents("pagesize")=request.QueryString("pagesize")
end if

if len(request.QueryString("order"))>0 or not isnull(request.QueryString("order")) then
session.contents("order")=request.QueryString("order")
end if
if request.form("setting")="リセット" then
session.contents("order1")=null
session.contents("order2")=null
session.contents("order3")=null
session.contents("order4")=null
session.contents("order5")=null
session.contents("order6")=null
session.contents("page")=1
session.contents("pagesize")=10
end if
%>
