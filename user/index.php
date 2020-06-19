<?php include "doconn.php";?>
<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
setcookie("wi","er",time()-60*60*24*1,"/");
setcookie("password","er",time()-60*60*24*1,"/");
$wi=tram($_POST['od']);
$password=tram($_POST['ne']);

if($wi){
 $wi = strtolower($wi);
 if(!preg_match('/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,8}$/',$wi)){
webalert("登录账号请使用邮件地址!","index.php");
exit();
 }

 if(!preg_match('/^[0-9A-Za-z]{6,18}$/',$password)){
webalert("登录密码6-16位数字字母组成!","index.php");
exit();
 }



$db=ConnectMysqli::getIntance($conn);
$sql="select * from `user` where `wi` = '{$wi}'";
$pass=$db->getRow($sql);
if(stristr("|NULL|null|","|{$pass}|")){webalert("用户名或用户名错误!","index.php");}
$pl = $pass['password'];
$ow = md5(md5($password).$qi);
$xs = date('Y-m-d H:i:s');
if($ow==md5($pl.$qi)){
setcookie('wi',md5($wi),time()+60*60*24*1,"/"); //1小时有效
setcookie('password',md5($pl.$qi),time()+60*60*24*1,"/"); //1小时有效
webalert("登录成功啦!","dotype.php");
exit();
}else{
webalert("登录失败：用户名与密码不匹配!","index.php");
exit();
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>用户登录-<?php echo $ba;?></title>
<meta name="keywords" content="<?php echo $sitemeta;?>" />
<link href="do_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="index.js?v=2016"></script>
</head>
<body>
<div id="main">
<h2><span><?php echo $ba;?>-管理员登录</span></h2>
<div id='fu'>
<table border="0" cellpadding="0">
<tr><td valign="top">
<div id="md">
<fieldset class="w">
<legend>
管理员登录
</legend>
<table cellspacing="0" class="table">
<form name="regsiter" action="index.php" method="post" onsubmit="return cl(0);">
<tr>
<td align="right" style="width:200px;">账号(邮箱)：</td>
<td align="left">
<input name="od" id="od" type="text" style="width:200px" onBlur="cl(1)" />
<span id="Result" class="grey"><b>提示</b>：开通时你留的邮箱地址。</span>
</td></tr><tr><td align="right">本站登录密码：</td><td align="left">
<input name="ne" id="ne" type="password" style="width:200px" onBlur="cl(2)" />
<span id="ri" class="grey"><b>提示</b>：输入本站登录密码。非邮箱密码。</span>
</td></tr><tr><td>&nbsp;</td><td colspan="2">
<input name="eg" type="submit" id="Submit" value="登录帐号" title="用户登录" />
</td></tr></form></table>
<?php
if(stristr($_SERVER['REQUEST_URI'],"/user/")) {
echo "安全建议，推荐修改后台目录user为只有自己知道的内容，访问的网址对应变化。<br>\r\n";
}
$fins = "../install/index.php";
if(file_exists($fins)){
echo "安全建议，安装完成并已正常使用，请删除文件{$fins}。更多提示见本页源文件。<br>\r\n";
}
?>
<!--
修改账号，手动修改数据库表user下us*me字段内容为你的邮件地址。<br>
忘记密码，手动修改数据库表user下pa*rd字段的MD5值(例253252545=<?php echo md5("253252545");?>)<br>
-->
</fieldset></div>
</td><td valign="top">
<?php include "doleft.php";?>
</td></tr></table>
</div></div>
<?php echo $pt;?>
</body>
</html>