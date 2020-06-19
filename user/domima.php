<?php include "doconn.php"; ?>
<?php include "dosess.php"; ?>
<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
$za = tram($_POST['nm']);
$ft = tram($_POST['ws']);
$rm = tram($_POST['oa']);
$wh = tram($_POST['xi']);
if(!$ft || !$rm || !$wh){
}else{
$ng = $_COOKIE['wi'];
if($ng==$za){
}else{
//用户名和数据库不符合
webalert("记忆登录信息和实际不符，请重新登录1!","index.php");
}
$db=ConnectMysqli::getIntance($conn);
$sql="select * from `user` ORDER BY `id` DESC LIMIT 1";
$pass=$db->getRow($sql);
if(stristr("|NULL|null|","|{$pass}|")){
webalert("用户名不存在,建议重新登录!","index.php");
}
$wi = $pass['wi'];
if($ng==md5($wi)){
}else{
//用户名和数据库不符合
webalert("记忆登录信息和实际不符，请重新登录1!","index.php");
}
$pl = $pass['password'];
if(strlen($pl)<16){
webalert("数据库原始密码获取失败!","domima.php");
}
If($pl == md5($ft)){
If($rm == $wh){
$bi  = md5($wh);
$list = array();
$list['password'] = $bi;
$db=ConnectMysqli::getIntance();
$list=$db->update("user", $list," `wi` = '{$wi}'");
webalert("密码修改成功,请用新密码重新登陆! ","index.php");
}else{
webalert("操作终止：两次新密码不一致！","domima.php");
}
}else{
webalert("操作终止：原密码不正确！ ","domima.php");
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>修改密码-<?php echo $ba;?></title>
<meta name="keywords" content="<?php echo $sitemeta;?>" />
<link href="do_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="domima.js"></script>
</script>
<style type="text/css">
/*自定义css*/
input[type=text]{width:254px;}
input[type=submit]{width:120px;}
</style>
</head>
<body>
<div id="main">
<h2><span>查询系统设置</span></h2>
<div id='fu'>
<table border="0" cellpadding="0">
<tr><td valign="top">
<div id="md">
<fieldset class="w">
<legend>密码修改</legend>
<strong>修改密码</strong>
<table cellspacing="0" class="table">
<form name="al" action="" method="post" onsubmit="return lo(0);">
<tr style="display:none;">
<td align="right" style="width:100px;">登录帐号：</td><td align="left">
<input name="nm" id="nm" type="text" value="<?php echo $ng;?>" onBlur="lo(2)" />
<span id="pi" class="grey">【必填】，用户登录用户名，格式是电子邮件。</span>
</td></tr><tr><td align="right" style="width:100px;">原来密码：</td><td align="left">
<input name="ws" id="ws" type="text" value="" onBlur="lo(3)" />
<span id="ka" class="grey">【必填】，原来的登录密码，6-12位字母数字组合。</span>
</td></tr><tr><td align="right" style="width:100px;">新的密码：</td><td align="left">
<input name="oa" id="oa" type="text" value="" onBlur="lo(4)" />
<span id="lu" class="grey">【必填】，设置新登录密码，6-12位字母数字组合。</span>
</td></tr><tr><td align="right" style="width:100px;">新的密码：</td><td align="left">
<input name="xi" id="xi" type="text" value="" onBlur="lo(5)" />
<span id="mv" class="grey">【必填】，重复一遍新密码，6-12位字母数字组合。</span>
</td></tr><tr><td align="right">&nbsp;</td><td align="left">
<input name="Submit" type="submit" id="sub" value="提交/修改" />
</td></tr><tr><td align="left" colspan="2">
<p>注意事项&技巧</p>
1. 密码（以上三项）均由6-12字的数字字母组合，其他无效。<br>
2. 修改账号，手动修改数据库表user下wi字段内容为你的邮件地址。<br>
3. 忘记密码，手动修改数据库表user下password字段的MD5值(例253252545=<?php echo md5("253252545");?>)<br>
</td></tr></form></table>
</fieldset></div>
</td><td valign="top">
<?php include "doleft.php";?>
</td></tr></table>
</div></div>
<?php echo $pt; ?>
</body>
</html>