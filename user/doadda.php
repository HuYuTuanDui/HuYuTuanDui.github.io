<?php include "doconn.php"; ?>
<?php include "dosess.php"; ?>
<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
$pu = tram($_POST['wf']);
$ke = tram($_POST['lf']);
$ur = tram($_POST['um']);
$wx = tram($_POST['nm']);
	$di = date("Y-m-d H:i:s"); //导入批次
	$tx = date("YmdHis"); //导入批次
	for ($i = 0; $i < 6; $i++) {
		$tx .= rand(0, 9);
	}
if(strlen($pu)<1){
}else{
if(strlen($pu)<2){ webalert("都得输入001!","doadda.php");}
if(strlen($ke)<2 && strlen($ck)>1){ webalert("都得输入002!","doadda.php");}
if(strlen($ur)<1 && strlen($xd)>1){ webalert("都得输入003!","doadda.php");}
if(!pr($ur)){ webalert("都得输入003!","doadda.php");}
$list = array();
$mu = "ea".date("Ymd");
$list['rn'] = "'{$mu}'";
$list['le'] = "'{$pu}'";
$list['fe'] = "'{$ke}'";
$list['ge'] = "'{$ur}'";
$list['ze'] = "'{$wx}'";
$db=ConnectMysqli::getIntance($conn);
$echos=$db->inserta("kudi",$list);
if($echos){
webalert("增加成功! ","douser.php");
}else{
webalert("增加失败! ","douser.php");
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>单个增加-<?php echo $ba;?></title>
<meta name="keywords" content="<?php echo $sitemeta;?>" />
<link href="do_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../inc/js/laydate.js"></script>
<script type="text/javascript">
function $(Obj){
return document.getElementById(Obj);
}
function Trim(Str){
return  Str.replace(/(^\s*)|(\s*$)/g,"");
}
function lo(Num){
if(Num == 1 || Num == 0){
if($("wf").value == ""){
$('wf').style.borderColor='red';
$("bl").innerHTML=" <strong>请填写<?php echo $ks; ?>！</strong>";
return false;
}else{
$('wf').style.borderColor='';
$("bl").innerHTML = "ok"
}
}
<?php
if(strlen($ck)<2){
}else{?>
if(Num == 2 || Num == 0){
if($("lf").value == ""){
$('lf').style.borderColor='red';
$("rg").innerHTML=" <strong>请填写<?php echo $ck; ?>！</strong>";
return false;
}else{
$('lf').style.borderColor='';
$("rg").innerHTML = "ok"
}
}
<?php
}
if(strlen($xd)<2){
}else{?>
if(Num == 3 || Num == 0){
var tl = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/;
if(!tl.test($("um").value)){
//if($("um").value == ""){
$('um').style.borderColor='red';
$("wy").innerHTML=" <strong>请填写<?php echo $xd; ?>,比如:1.88！</strong>";
return false;
}else{
$('um').style.borderColor='';
$("wy").innerHTML = "ok"
}
}
<?php
}
?>
}
</script>
<style type="text/css">
/*自定义css*/
input[type=text]{width:254px;}
input[type=submit]{width:120px;}
</style>
</head>
<body>
<div id="main">
<h2><span>单个增加</span></h2>
<div id='fu'>
<table border="0" cellpadding="0">
<tr><td valign="top">
<div id="md">
<fieldset class="w">
<legend>单个增加</legend>
<table cellspacing="0" class="table">
<form name="al" action="" method="post" onsubmit="return lo(0);">
<tr><td align="right" style="width:100px;"><?php echo $ks; ?>：</td><td align="left">
<input name="wf" id="wf" type="text" value="" onBlur="lo(1)" />
<span id="bl" class="grey">【必填】，用户输入查询的内容（<?php echo $ks; ?>）。</span>
</td></tr>
<tr style="<?php if(strlen($ck)<2){
echo "display:none;";
}?>"><td align="right" style="width:100px;"><?php echo $ck; ?>：</td><td align="left">
<input name="time" type="hidden" id="time" value="1">
<input name="xl" type="hidden" id="xl" value="1">
<input name="kp" type="hidden" id="kp" value="1">
<input name="lf" id="lf" type="text" onBlur="lo(2)" value="" />
<span id="rg" class="grey">【必填】，输入后请<strong>选择</strong><?php echo $ck; ?>。</span>
</td></tr>
<tr style="<?php if(strlen($xd)<2){
echo "display:none;";
}?>"><td align="right" style="width:100px;"><?php echo $xd; ?>：</td><td align="left">
<input name="um" id="um" type="text" value="" onBlur="lo(3)" />
<span id="wy" class="grey">【必填】，填写<?php echo $xd; ?>。</span>
</td></tr>
<tr style="<?php if(strlen($em)<2){
echo "display:none;";
}?>"><td align="right" style="width:100px;"><?php echo $em; ?>：</td><td align="left">
<input name="nm" id="nm" type="text" value="<?php echo $di;?>" onclick="laydate()" onBlur="lo(4)" />
<span id="pi" class="grey">【必填】，该单<strong><?php echo $em; ?></strong>。</span>
</td></tr>
<tr><td align="right">&nbsp;</td><td align="left">
<input name="Submit" type="submit" id="sub" value="提交增加" />
</td></tr><tr><td align="left" colspan="2">
</td></tr></form></table>
</fieldset></div>
</td><td valign="top">
<?php include "doleft.php";?>
</td></tr></table>
</div></div>
<?php echo $pt; ?>
</body>
</html>