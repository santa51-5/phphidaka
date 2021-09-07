<SCRIPT>
<!--
function copy_r() {
	kill = new Function("return false");
	document.onmousedown = document.onselectstart = document.oncontextmenu = kill;
	for ( i = 0; i < document.images.length; i ++ ) {
		document.images[i].onmousedown = document.images[i].onmousemove = kill;
	}
}
//-->
</SCRIPT>