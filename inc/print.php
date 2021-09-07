<script type="text/javascript">
//ボタン押下時の処理 
function doPrint(frame) { 
putSettings() // set settings // print and get settings when done 
bt1.style.visibility="hidden" //ボタンを見えないようにする 
factory.printing.portrait = true
factory.printing.Print(true);//印刷false, frame 
bt1.style.visibility="visible"//ボタンを見えるようにする 
} 

//ページ設定の情報を格納 
function putSettings() { 
with ( factory.printing ) { 
header ="&w&b&p/&P" //ヘッダー 
footer = "&b&d" //フッター 
leftMargin ="10" //左の余白のサイズ 
topMargin = "0" //上の余白のサイズ 
rightMargin ="10" //右の余白のサイズ 
bottomMargin ="0" //下の余白のサイズ 
}} 

</script> 
