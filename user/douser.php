<?php include "doconn.php"; ?>
<?php include "dosess.php";
$yp = $mt;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>列表与管理-<?php echo $ba;?></title>
<meta name="keywords" content="<?php echo $sitemeta;?>" />
<link href="do_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(Obj){
return document.getElementById(Obj);
}
function Trim(Str){
return  Str.replace(/(^\s*)|(\s*$)/g,"");
}
//全选
function CheckAll(form){
for (var i=0;i<form.elements.length;i++){
var e = form.elements[i];
if (e.name != 'chkall')
e.checked = form.chkall.checked;
}
}
function GetAll(form){
for(var i=0;i<form.elements.length;i++){
var e = form.elements[i];
if(e.checked) val += ",". e.value;
}
return val;
}
//过滤文本左右两端的空格
function GetRequest(Url,Sendtxt,GetFunction){
if(window.ActiveXObject){
var xmlHttpRequest = new ActiveXObject("Microsoft.XMLHTTP");
}else{
var xmlHttpRequest = new XMLHttpRequest();
}
xmlHttpRequest.onreadystatechange = function(){
if(xmlHttpRequest.readyState == 4){
if(xmlHttpRequest.status == 200){
GetFunction(xmlHttpRequest.responseText);
}
}
}
xmlHttpRequest.open("post",Url,true);
xmlHttpRequest.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlHttpRequest.send(Sendtxt);
}
//单删用户名
function deuser(act,ids){
if (window.confirm("你真的要删除该内容么？（不可恢复）")==true){
SendUrl = "duajax.php";
Sendtxt = "Act="+act+"&id="+ids+"&T="+Math.random();
GetRequest(SendUrl,Sendtxt,function(GetText){
if(GetText == "0"){
	alert("ID"+ids+"内容已被删除!");
top.location.href = top.location.href;
}else{
	alert(GetText);
top.location.href = top.location.href;
}
});
}
}
//批删用户名
function dauser(act,ids){
if (window.confirm("你真的要删除本页所有选中的内容么？（不可恢复）")==true){
var str = document.getElementsByName("ID");
var objarray=str.length;
var ll="";
for (i=0;i<objarray;i++){
if(str[i].checked == true){
ll+=str[i].value+",";
}
}
if(ll == ""){
alert("请先选择～！");
return false;
}
SendUrl = "duajax.php";
Sendtxt = "Act="+act+"&id="+ll+"&T="+Math.random();
GetRequest(SendUrl,Sendtxt,function(GetText){
if(GetText == "0"){
	alert("ID为"+ll+"内容已被批量删除!");
top.location.href = top.location.href;
}else{
	alert(GetText);
//top.location.href = top.location.href;
}
});
}
}
//更改用户名
function douser(act,ids){
var va=$("us"+ids).innerHTML;
var pf=window.prompt("修改为：",va);
if(pf!=null){
SendUrl = "duajax.php";
Sendtxt = "Act="+act+"&old="+escape(va)+"&id="+ids+"&tian="+escape(pf)+"&T="+Math.random();
GetRequest(SendUrl,Sendtxt,function(GetText){
if(GetText == "0"){
	alert("修改为："+pf+" 成功!");
top.location.href = top.location.href;
}else{
	alert(GetText);
top.location.href = top.location.href;
}
});
}
}
//更改用户名
function doname(act,ids){
var va=$("na"+ids).innerHTML;
var pf=window.prompt("修改为：",va);
if(pf!=null){
SendUrl = "duajax.php";
Sendtxt = "Act="+act+"&old="+escape(va)+"&id="+ids+"&tian="+escape(pf)+"&T="+Math.random();
GetRequest(SendUrl,Sendtxt,function(GetText){
if(GetText == "0"){
	alert("修改为："+pf+" 成功!");
top.location.href = top.location.href;
}else{
	alert(GetText);
top.location.href = top.location.href;
}
});
}
}
//修改状态
function doedit(act,ids){
var va=$("pa"+ids).innerHTML;
var pf=window.prompt("请输入状态（0:默认可查|1设定可查|-1不可查）：",va);
if(pf!=null){
SendUrl = "duajax.php";
Sendtxt = "Act="+act+"&old="+escape(va)+"&id="+ids+"&tian="+escape(pf)+"&T="+Math.random();
GetRequest(SendUrl,Sendtxt,function(GetText){
if(GetText == "0"){
	alert("状态值改为"+pf+"成功!");
top.location.href = top.location.href;
}else{
	alert(GetText);
top.location.href = top.location.href;
}
});
}
}
</script>
<style type="text/css">
/*自定义css*/
input[type=text]{width:254px;}
input[type=submit]{padding:3px 6px;}
input[type=button]{padding:3px 6px;}
.table span{color:red;}
.table a {color:blue;}
</style>
</head>
<body>
<div id="main">
<h2><span>内容管理</span></h2>
<div id='fu'>
<table border="0" cellpadding="0">
<tr><td valign="top">
<div id="md">
<fieldset class="w">
<legend><?php echo $ks; ?>内容管理</legend>
<?php
$page = tram($_GET["page"]);
$keys = tram($_GET["keys"]);
$rv = tram($_GET["a"]);
$pw = tram($_GET["d"]);
if(strlen($keys)>0){
$sqs = "WHERE `le` LIKE '%{$keys}%' or `ge` LIKE '%{$keys}%' or `rn` LIKE '%{$keys}%'";
}else{
$sqs = "";
}
if(strlen($rv)>0 && strlen($pw)>0){
$sw = " ORDER BY `{$rv}` {$pw}";
}else{
$sw = " ORDER BY `hi` DESC";
}
$db=ConnectMysqli::getIntance($conn);
$sql="SELECT COUNT(*)  FROM `kudi` " . $sqs;
$list=$db->getRow($sql);
$recs=$list['COUNT(*)'];
$pagecount = bcdiv($recs+$pagesize-1,$pagesize,0); //算出总页数
$urls = "&name={$keys}";
if(strlen($rv)>0){ $urls .= '&a='.$rv;}
if(strlen($pw)>0){ $urls .= '&d='.$pw;}
if(strlen($keys)>0){ $urls .= '&keys='.$keys;}
if(!isset($page) || $page=="") $page = 1; //如果没有指定显示页码，缺省为显示第一页
if(!is_numeric($page)) $page = 1;
if($page<1) $page = 1; //如果页码比1小，则显示第一页
if($page>$pagecount) $page = $pagecount; //如果页码比总页数大，则显示最后一页
$p = $page * $pagesize + 1 - $pagesize -1;
if($p<0) $p = 0; //如果
$sql="SELECT * FROM `kudi` $sqs $sw limit $p, $pagesize";
$list=$db->getAll($sql);
if($pw=="asc"){ $xx = 'desc';}else{$xx = 'asc';}
$xx .= '&keys='.$keys;
$yy = "?a={$mk}&d={$xx}";
//echo json_encode($list);
echo "<div style=\"margin:0 auto;overflow-x:auto;width:98%;max-width:888px;\">";
echo "\r\n<!--startprint-->\r\n";
echo "<table cellspacing=\"0\" class=\"table\"> \r\n";
$ii=0;
foreach ($list as $pc ) {
$ii++;
if($ii=="1"){
$li=0;
foreach ($pc as $mk => $iv ) {
if(stristr($dp,"-{$mk}-")){
}else{
$li++;
}
}
echo "\r\n<thead>\r\n<tr>\r\n";
//tper($Keys)
?>
<td colspan="11"><form action="" name="dirform" method="get"><input name="keys" maxlength="19" type="text" value="请输入<?php echo $ks; ?>或<?php echo $ck; ?>" onfocus="this.value=''" /><input name="Submit" type="submit" value="找查询"></form></td><tr>
<form action="" name="form" method="get"  >
<tr class="tt">
<td width="60"><a href="?a=hi&d=<?php echo $xx;?>">ID</a></td>
<td>查询条件(<b><?php echo $ks; ?></b>)</td>
<td><?php
if(strlen($ck)<2){
}else{?><?php echo $ck;} ?><?php
if(strlen($xd)<2){
}else{?><br><?php echo $xd;} ?></td>
<td><?php
if(strlen($em)<2){
}else{?><?php echo $em; } ?><br>支付时间</td>
<td width="38">可查<br>状态</td>
<td width="38">支付<br>状态</td>
<td width="128">
<a href="?a=nt&d=<?php echo $xx;?>">创建时间</a><br>
<a href="?a=ty&d=<?php echo $xx;?>">最后修改</a>
</td>
<td width="15"><input type="checkbox" name="chkall" onClick="CheckAll(this.form)" title="全选"></td>
<td width="45"><input type="button" name="ld" value="批删" onClick="return dauser('dauser','ID');" style="" /></td>
</tr>
<?php
echo "\r\n</thead>\r\n";
echo "\r\n<tbody>\r\n";
}
$arys = $pc;
$id = $arys['hi'];
$cks = $arys['check'];
?>
<tr>
<td><?php echo $id;?></td>
<td><a href="javascript:douser('douser','<?php echo $id;?>')" id="us<?php echo $id;?>"><?php echo $arys['le'];?></a></td>
<td><?php
if(strlen($ck)<2){
}else{?><?php echo $arys['fe'];}?><?php
if(strlen($xd)<2){
}else{?><br><?php echo $arys['ge'];}?>
</td>
<td><?php
if(strlen($em)<2){
}else{?><?php echo $arys['ze'];}?><br><?php echo $arys['ht'];?></td>
<td><?php
if($arys['check']=="1"){
echo "<b>可查</b>";
}elseif($arys['check']=="0"){
echo "默认";
}elseif($arys['check']=="-1"){
echo "<span>已禁</span>";
}else{
echo "<b>未知</b>";
}
?><a href="javascript:doedit('doedit','<?php echo $id;?>')" id="pa<?php echo $id;?>"><?php echo $arys['check'];?></a></td>
<td><?php
if($arys['pe']=="1"){
echo "<b>已付</b>";
}elseif($arys['pe']=="0"){
echo "待付";
}else{
echo "<b>未知</b>";
}
?></td>
<td>
<?php echo $arys['nt'];?><br>
<?php echo $arys['ty'];?></td>
<td>
<input type="checkbox" name="ID" value="<?php echo $id;?>">
</td><td width="30">
<?php if($cks<0){ ?>
<a href="javascript:deuser('deuser','<?php echo $id;?>')">删</a>
<?php }else{ ?>
<a href="javascript:deuser('deuser','<?php echo $id;?>')">删</a>
<?php } ?>
<a href="doedit.php?id=<?php echo $id;?>"  target="_blank">&nbsp;改</a>
</td>
</tr>
<?php
}
if($ii<1){
echo "<tr>\r\n";
echo "<td data-label=\"查询提示：\" colspan=\"{$li}\"><h2>暂无：增加或导入后才可查询</h2></td>\r\n";
echo "</tr>\r\n";
echo "<tr>\r\n";
echo "<td data-label=\"提示：\" colspan=\"{$li}\">\r\n";
echo "点右侧<strong>单个增加</strong> 或 <strong>导入</strong></td>\r\n";
echo "</tr>\r\n";
echo "</tbody>\r\n";
echo "</table>\r\n";
}else{
echo "</tbody>\r\n";
if($pagecount>1){ //页码比0大，表示有数据
echo "<tr><td colspan=\"{$li}\">";
if($page>1){
echo '<a href="?page=1' . $urls . '">首页</a> ';
echo '<a href="?page='. ($page-1) . '' . $urls . '">前页</a> ';
	}
if($page<$pagecount){
echo '<a href="?page='. ($page+1) . '' . $urls . '">后页</a> ';
echo '<a href="?page=' . $pagecount . '' . $urls . '">尾页</a> ';
	}
echo '页次: <span>' . $page . '</span>/<span>' . $pagecount . '</span>页 ';
echo '<span>' . $pagesize . '</span>条/页 ';
echo '共<span>' . $recs . '</span>条 </td><tr>';
}
echo '</form>';
echo "</table>\r\n";
}
echo "\r\n<!--endprint-->\r\n</div>\r\n";
?>
</fieldset></div>
</td><td valign="top">
<?php include "doleft.php";?>
</td></tr></table>
</div></div>
<?php echo $pt; ?>
</body>
</html>