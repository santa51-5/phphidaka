<script type="text/javascript"><!--
var yobi = new Array("日", "月", "火", "水",
                     "木", "金", "土");
function clock () {
    if(!document.getElementById) return;
    var obj = document.getElementById("clock");
    var now = new Date();
    var y = now.getFullYear();
    var m = now.getMonth() + 1; if(m < 10) m = "0" + m;
    var d = now.getDate();      if(d < 10) d = "0" + d;
    var yo = yobi[now.getDay()];
    var h = now.getHours();     if(h < 10) h = "0" + h;
    var n = now.getMinutes();   if(n < 10) n = "0" + n;
    var s = now.getSeconds();   if(s < 10) s = "0" + s;
    var timestr = y + "/" + m + "/" + d + " ("
        + yo + ") " + h + ":" + n + ":" + s;
    obj.innerHTML = timestr;
    setTimeout("clock();", 1000);
}
//-->
</script>
