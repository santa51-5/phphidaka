<?
function tokuisaki(a)

	DBName="PROVIDER=MICROSOFT.JET.OLEDB.4.0;DATA SOURCE=" & r_dir & "/do/cgi-bin/mydb/hmaster.mdb"

	'DBName="Driver={Microsoft Access Driver (*.mdb)};DBQ=" & Server.Mappath("../cgi-bin/mydb/hmaster.mdb")
	Set dbs=Server.CreateObject("ADODB.Connection")
	dbs.Open DBName
	SQL="SELECT * FROM 顧客テーブル WHERE id='" & a & "'"
	Set rss=dbs.Execute(SQL)


		Session.Contents("ID_kaishamei")	=	rss("id")
		Session.Contents("kaishamei")	=	rss("会社名")
		Session.Contents("tantouin")	=	rss("担当員")
		Session.Contents("p1")	=	rss("所番地分類1")
		Session.Contents("p2")	=	rss("所番地分類2")
		Session.Contents("p3")	=	rss("所番地分類3")
		Session.Contents("p4")	=	rss("所番地分類4")
		Session.Contents("p5")	=	rss("置き場1")
		'Session.Contents("p6")	=	rss("置き場2")
		Session.Contents("m_jidou")	=	rss("自動作成機能")
		Session.Contents("db_path")	=	rss("db_path")
		Session.Contents("data_path")	=	rss("data_path")
		Session.Contents("kanrijoutaihyouji")	=	rss("管理状態表示")
		Session.Contents("kensashukihyouji")	=	rss("検査周期表示")
		Session.Contents("detakakuninranhyouji")	=	rss("データ確認欄表示")
		Session.Contents("kouseikekahyouji")	=	rss("校正結果詳細表示")
		Session.Contents("kigengirehyouji")	=	rss("期限切れ表示")
		Session.Contents("kouseiyoteihyouji")	=	rss("校正予定表示")
		Session.Contents("kakushulisthyouji")	=	rss("各種リスト表示")
		Session.Contents("m_shinkisakusei")	=	rss("新規作成")
		Session.Contents("m_henkou")	=	rss("変更")
		Session.Contents("m_haiki")	=	rss("廃棄")
		Session.Contents("s_h")	=	rss("補助資料")
		Session.Contents("s_n")	=	rss("不合格報告書")
		Session.Contents("s_y")	=	rss("要注意報告書")
		Session.Contents("s_l")	=	rss("実施リスト")
		Session.Contents("mas_info")	=	rss("マスター情報管理")
		Session.Contents("mas_info_s1")	=	rss("所番地1")
		Session.Contents("mas_info_s2")	=	rss("所番地2")
		Session.Contents("mas_info_s3")	=	rss("所番地3")
		Session.Contents("mas_info_s4")	=	rss("所番地4")
		Session.Contents("mas_info_s5")	=	rss("置き場1表示")
		'Session.Contents("mas_info_s6")	=	rss("置き場2表示")
		Session.Contents("mas_info_kibutsu")	=	rss("器物分類コード")
		Session.Contents("SP_IT")	=	rss("特別機能稲垣鉄工")
		Session.Contents("henkou_kanri")	=	rss("変更管理")
		Session.Contents("m_ichiren")	=	rss("一覧登録リスト")
		Session.Contents("nyukainfo")	=	rss("入荷情報")
			rss.Close
	dbs.Close

	set rss=Nothing
	Set dbs=Nothing

Response.Cookies("test") = Session.Contents("ID_kaishamei")
Response.Cookies("test").Expires = Date + 10
Response.Cookies("campany_root") = campany_root
Response.Cookies("campany_root").Expires = Date + 10
'response.redirect "debug.asp?st1=" & Session.Contents("ID_kaishamei")

end sub
?>
