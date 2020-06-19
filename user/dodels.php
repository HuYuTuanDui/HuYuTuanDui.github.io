<?php include "doconn.php"; ?>
<?php include "dosess.php"; ?>
<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
$ss = tram($_GET['p']);//模糊
$ab = tram($_GET['keys']);//模糊
if(!$ab){
}else{
$ab = ef($ab);
$ja = date('YmdHis');
$db=ConnectMysqli::getIntance();
$list=$db->deleteOne("kudi","`rn` = '{$ab}'");
if($list){
webalert("批次{$ab}已经清空! ","dodels.php");
}else{
webalert("批次{$ab}清空失败! ","dodels.php");
}
}
$at=filemtime($op);
$et=date("Y-m-d H:i:s",$at);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>批次操作-<?php echo $ba;?></title>
<meta name="keywords" content="<?php echo $sitemeta;?>" />
<link href="do_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function $(Obj){
return document.getElementById(Obj);
}
function Trim(Str){
return  Str.replace(/(^\s*)|(\s*$)/g,"");
}
function del(act,ids){
if (window.confirm("确定要删除该批次内容么？（不可恢复）")==true){
top.location.href = "?act=del&keys="+ids;
}
}
</script>
<style type="text/css">
/*自定义css*/
input[type=text]{width:254px;height:24px;}
input[type=submit]{padding:5px 15px;background-color:#0180CF;color:#FFFFFF;}
input[type=button]{padding:5px 15px;background-color:#0180CF;color:#FFFFFF;}
</style>
</head>
<body>
<div id="main">
<h2><span>批次操作</span></h2>
<div id='fu'>
<table border="0" cellpadding="0">
<tr><td valign="top">
<div id="md">
<fieldset class="w">
<legend>批次操作</legend>
<table cellspacing="0" class="table">
<form name="al" action="" method="post" onsubmit="">
<tr ><td align="right" style="width:120px;"><b>时间批次</b></td><td align="left">
<select name="cd" id="cd" onchange="window.location='?p='+this.value;" onBlur="lo(8)" />
<?php
$db=ConnectMysqli::getIntance($conn);
$sql="SELECT DISTINCT `rn` FROM `kudi` order by `hi` desc";
$pass=$db->query($sql);
$pss="-";$ii=0;
while($row = mysqli_fetch_array($pass)){
$fw = $row['rn'];
$pss .= $fw."-";  $ii++;
if($ii=="1"){ $pst= $fw;}
if("-{$fw}-"=="-{$ss}-"){
echo "<option value=\"{$fw}\" selected>$fw</option>\r\n";
}else{
echo "<option value=\"{$fw}\">$fw</option>\r\n";
}
}
if(!stristr($pss,"-{$ss}-")){ $ss= $pst;}
?>
</select>
</td></tr>
<tr><td align="right">相关说明</td><td align="left">
<?php
if(strlen($ss)>6){
$sql="SELECT COUNT(*)  FROM `kudi` WHERE `rn` = '{$ss}'";
$list=$db->getRow($sql);
$recs=$list['COUNT(*)'];
echo "1.<a href=\"douser.php?keys={$ss}\" target=\"_blank\"><b>点我查看</b></a>批次{$ss}的<b>{$recs}</b>条信息。<br>";
echo "2.<a href=\"dodown.php?keys={$ss}\" target=\"_blank\"><b>点我下载</b></a>批次{$ss}的<b>{$recs}</b>条信息。<br>";
echo "3.<a href=\"javascript:del('del','{$ss}')\"><b>点我清空</b></a>该批次的<b>{$recs}</b>条信息。<b>谨慎操作，不可恢复</b>。<br>";
}else{
echo "1.暂无可用批次。<br>";
}
?>
</td></tr>
<tr><td align="left" colspan="2">
<?php
if(strlen($ss)>6){
$sql="SELECT `rn`,`pe`, COUNT(*) FROM `kudi` group by `rn`,`pe` ";
$pass=$db->query($sql);
echo "<table class='table' cellspacing=\"0\" style='width:300px;'>";
echo "<tr class=tt><td width=150>支付状态</td><td width=150>支付统计(单)</td></tr>\r\n";
while($row=mysqli_fetch_row($pass)){
$ns = $row[0];$oc = tper($row[1]);
if($ns==$ss){
echo "<tr><td>$oc</td><td>".$row[2]."单</td></tr>\r\n";
}
}
echo "</table>\r\n";
$sql="SELECT `rn`, `pe`, SUM(`ge`) as bg, COUNT(`hi`) as cc FROM `kudi` group by `rn`,`pe` ";
$pass=$db->query($sql);
echo "<table class='table' cellspacing=\"0\" style='width:300px;'>";
echo "<tr class=tt><td width=150>支付状态</td><td width=150>支付统计(元)</td></tr>\r\n";
while($row=mysqli_fetch_row($pass)){
$ns = $row[0]; $oc = tper($row[1]);
if($ns==$ss){
echo "<tr><td>$oc</td><td>￥".$row[2]."</td></tr>\r\n";
}
}
echo "</table>\r\n";
}else{
echo "1.暂无可用批次。<br>";
}
?>
</td></tr>
</form></table>
1. 该功能用于导入失误的多条同批次数据。
</fieldset></div>
</td><td valign="top">
<?php include "doleft.php";?>
</td></tr></table>
</div></div>
<?php echo $pt; ?>
</body>
</html>