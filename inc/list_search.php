<DIV class="noprint" id="listing_search">

<?php 
print "<form action=listing.asp method=post>";

print "<table class='listing_search_nav'><tr><th width=50px>";
print "<span class='listing_search_page'>PAGE</span></th><td width=150px><input type=text id=text1 name=JUMP size=5 VALUE=".$intPageCurrent
."> / ".$intPageCount."</td>";
print "<TD width=50px><INPUT TYPE=submit value=JAMP></TD>";
print "</form>";

//前のページ
if ($intPageCurrent>1){
  print "<td WIDTH=80px><a class='pre_next' href='listing.php?page="
  .$intPageCurrent-1
  ."&pl_start=".intval(($intPageCurrent-2)/10)*10
  ."&pagesize=".$intPageSize
  ."&order=".rawurlencode($strOrderBy)
  ."'>前へ</a></td>";
}else{
  print "<TD WIDTH=80px></TD>";
} 

//次のページ

if ($intPageCurrent<$intPageCount){
  print "<td WIDTH=80px><a class='pre_next' href='listing.php?page="
  .$intPageCurrent+1
  ."&pl_start=".intval(($intPageCurrent)/10)*10
  ."&pagesize=".$intPageSize
  ."&order=".rawurlencode($strOrderBy)
  ."'>次へ</a></td>";
} 

//ここからnav
//Prev
print "<TD><ul class='listing_search_nav_ul'>";
if ($pl_start>1){
  print "<li><a href='listing.php?page="
  .($pl_start-9)
  ."&pagesize=".$intPageSize
  ."&pl_start=".$pl_start-10
  ."&order=".rawurlencode($strOrderBy)
  ."'><<<</a></li>";
} 

//++
//
if ($pl_start<=0){
  $pl_start=0;
} 
$pl_count=$pl_start+1;
$pl_end=$pl_start+10;
while($pl_count<=$pl_end && $pl_count<=$intPageCount){
  if ($pl_count==$intPageCurrent){
    print "<li><span>".$pl_count."</span></li>";
  }else{
    print "<li><a href='listing.php?page=".$pl_count
    ."&pagesize=".$intPageSize
    ."&pl_start=".$pl_start
    ."&order=".rawurlencode($strOrderBy)
    ."'>"
    .$pl_count."</a></li>";
  } 
  $pl_count=$pl_count+1;
} 

//Next
if ($pl_end<$intPageCount){
  print "<li><a class=pre_next href='listing.php?page="
  .$pl_start+11
  ."&pl_start=".$pl_start+10
  ."&pagesize=".$intPageSize
  ."&order=".rawurlencode($strOrderBy)
  ."'>>>></a></li>";
} 

print "</ul></TD></tr></table>";
?>
<TABLE>
<form action="listing.php" method="post">
<TR>
<th width=75px><span class=listing_search_page>表示件数</span></th>
<td width=100px>
<div>
<select size="1" name="pagesize">

<? 
for ($intI=10; $intI<=100; $intI=$intI+10){
  $strOption="<option value='".$intI."'";
  if ($intI==$intPageSize){
    $strOption=$strOption." selected";
  } 
  $strOption=$strOption.">".$intI."行</option>";
  print $strOption;
}
?>

</select></div></td>
<th width=80px><span class=listing_search_page>並び替え</span></th>
<td style="padding-left:30px;">①<select size=1 name=order1>

<option value="管理番号">管理番号</option>
<option value="器物分類コード"
<? 
if (strpos("order1"),"器物分類コード")
{
  echo " selected";
} 

?>
  >名称</option>

  <option value="型式コード"



  <? 
if ((strpos(("order1"),"型式コード",1) ? strpos(("order1"),"型式コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >型式</option>

  <option value="所番地分類1"



  <? 
if ((strpos(("order1"),"所番地分類1",1) ? strpos(("order1"),"所番地分類1",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p1;?></option>


  <option value="所番地分類2"



  <? 
if ((strpos(("order1"),"所番地分類2",1) ? strpos(("order1"),"所番地分類2",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p2;?></option>

  <option value="所番地分類3"



  <? 
if ((strpos(("order1"),"所番地分類3",1) ? strpos(("order1"),"所番地分類3",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p3;?></option>

  <option value="検査周期"



  <? 
if ((strpos(("order1"),"検査周期",1) ? strpos(("order1"),"検査周期",1)+1 : 0)$response->write" selected")
{
} 

?>
  >検査周期</option>

  <option value="使用区分コード"



  <? 
if ((strpos(("order1"),"使用区分コード",1) ? strpos(("order1"),"使用区分コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >管理状態</option>

  <option value="isize"



  <? 
if ((strpos(("order1"),"isize",1) ? strpos(("order1"),"isize",1)+1 : 0)$response->write" selected")
{
} 

?>
  >サイズ</option>

  <option value="最新校正日"



  <? 
if ((strpos(("order1"),"最新校正日",1) ? strpos(("order1"),"最新校正日",1)+1 : 0)$response->write" selected")
{
} 

?>
  >最新校正日</option>

</select>
</td>

<td>
<select size=1 name=order2>
 <option value=""



<? 
if ((strpos(("order2"),"DESC",1) ? strpos(("order2"),"DESC",1)+1 : 0)$response->write" selected")
{
} 

?>

  >昇順</option>
  <option value="DESC"



  <? 
if ((strpos(("order2"),"DESC",1) ? strpos(("order2"),"DESC",1)+1 : 0)$response->write" selected")
{
} 

?>
  >降順</option>

</select>
</td>


<td>②<select size=1 name=order3>
<OPTION value="NULL"

<? 
if (("order3")=="NULL")
{

  print " selected";
} 

?>
>指定なし</OPTION>
 <option value="管理番号"



<? 
if (("order3")=="管理番号")
{

  print " selected";
} 

?>

  >管理番号</option>
  <option value="器物分類コード"



  <? 
if ((strpos(("order3"),"器物分類コード",1) ? strpos(("order3"),"器物分類コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >名称</option>
  <option value="型式コード"



  <? 
if ((strpos(("order3"),"型式コード",1) ? strpos(("order3"),"型式コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >型式</option>

  <option value="所番地分類1"



  <? 
if ((strpos(("order3"),"所番地分類1",1) ? strpos(("order3"),"所番地分類1",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p1;?></option>


  <option value="所番地分類2"



  <? 
if ((strpos(("order3"),"所番地分類2",1) ? strpos(("order3"),"所番地分類2",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p2;?></option>

  <option value="所番地分類3"



  <? 
if ((strpos(("order3"),"所番地分類3",1) ? strpos(("order3"),"所番地分類3",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p3;?></option>

  <option value="検査周期"



  <? 
if ((strpos(("order3"),"検査周期",1) ? strpos(("order3"),"検査周期",1)+1 : 0)$response->write" selected")
{
} 

?>
  >検査周期</option>

  <option value="使用区分コード"



  <? 
if ((strpos(("order3"),"使用区分コード",1) ? strpos(("order3"),"使用区分コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >管理状態</option>

  <option value="isize"



  <? 
if ((strpos(("order3"),"isize",1) ? strpos(("order3"),"isize",1)+1 : 0)$response->write" selected")
{
} 

?>
  >サイズ</option>

  <option value="最新校正日"



  <? 
if ((strpos(("order3"),"最新校正日",1) ? strpos(("order3"),"最新校正日",1)+1 : 0)$response->write" selected")
{
} 

?>
  >最新校正日</option>

</select>
</td>

<td>
<select size=1 name=order4>
 <option value=""



<? 
if ((strpos(("order4"),"DESC",1) ? strpos(("order4"),"DESC",1)+1 : 0)$response->write" selected")
{
} 

?>

  >昇順</option>
  <option value="DESC"



  <? 
if ((strpos(("order4"),"DESC",1) ? strpos(("order4"),"DESC",1)+1 : 0)$response->write" selected")
{
} 

?>
  >降順</option>

</select>
</td>



<td>③<select size=1 name=order5>
	<OPTION value="NULL"

	<? 
if (("order3")=="NULL")
{

  print " selected";
} 

?>
	>指定なし</OPTION>

<option value="管理番号"



<? 
if (("order5")=="管理番号")
{

  print " selected";
} 

?>

  >管理番号</option>
  <option value="器物分類コード"



  <? 
if ((strpos(("order5"),"器物分類コード",1) ? strpos(("order5"),"器物分類コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >名称</option>
  <option value="型式コード"



  <? 
if ((strpos(("order5"),"型式コード",1) ? strpos(("order5"),"型式コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >型式</option>

  <option value="所番地分類1"



  <? 
if ((strpos(("order5"),"所番地分類1",1) ? strpos(("order5"),"所番地分類1",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p1;?></option>


  <option value="所番地分類2"



  <? 
if ((strpos(("order5"),"所番地分類2",1) ? strpos(("order5"),"所番地分類2",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p2;?></option>

  <option value="所番地分類3"



  <? 
if ((strpos(("order5"),"所番地分類3",1) ? strpos(("order5"),"所番地分類3",1)+1 : 0)$response->write" selected")
{
} 

?>
  ><? echo $p3;?></option>

  <option value="検査周期"



  <? 
if ((strpos(("order5"),"検査周期",1) ? strpos(("order5"),"検査周期",1)+1 : 0)$response->write" selected")
{
} 

?>
  >検査周期</option>

  <option value="使用区分コード"



  <? 
if ((strpos(("order5"),"使用区分コード",1) ? strpos(("order5"),"使用区分コード",1)+1 : 0)$response->write" selected")
{
} 

?>
  >管理状態</option>

  <option value="isize"



  <? 
if ((strpos(("order5"),"isize",1) ? strpos(("order5"),"isize",1)+1 : 0)$response->write" selected")
{
} 

?>
  >サイズ</option>

  <option value="最新校正日"



  <? 
if ((strpos(("order5"),"最新校正日",1) ? strpos(("order5"),"最新校正日",1)+1 : 0)$response->write" selected")
{
} 

?>
  >最新校正日</option>

</select>
</td>


<td>
<select size=1 name=order6>
 <option value=""



<? 
if ((strpos(("order6"),"DESC",1) ? strpos(("order6"),"DESC",1)+1 : 0)$response->write" selected")
{
} 

?>

  >昇順</option>
  <option value="DESC"



  <? 
if ((strpos(("order6"),"DESC",1) ? strpos(("order6"),"DESC",1)+1 : 0)$response->write" selected")
{
} 

?>
  >降順</option>

</select>
</td>



<td>
<input type="submit" name="setting"  value="再設定" align=middle >
</td>
<td>
<input type="submit" name="setting" value="リセット" align=middle >
</td>

<td>
<a class=buttonB href='listing_p.asp?<? echo ("BACK1");?>'>印刷</td>

</tr>

</form></table>



</div>

