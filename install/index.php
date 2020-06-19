<?php
include "../inc/sqls.php";
$iz= $_POST["time"];
$userx= $_POST["name"];

//如果不支持CURRENT_TIMESTAMP(mysql<5.6)
//CURRENT_TIMESTAMP替换具体时间'2019-08-18 08:18:18'
Function conntable($qi,$zh){
$db=ConnectMysqli::getIntance($conn);
$sql="describe `conn`";
$pass=$db->query($sql);
if(!$pass){
//创建数据库结构
$gs="CREATE TABLE `conn` (
`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
`ey` varchar(32) DEFAULT '某某小学收费系统',
`ki` varchar(36) DEFAULT '查分吧',
`yo` varchar(128) DEFAULT 'http://add.12391.net',
`gn` varchar(36) DEFAULT '支付商户ID',
`mp` varchar(36) DEFAULT '公众号APPID',
`xh` varchar(36) DEFAULT 'API密钥',
`txt001` varchar(32) DEFAULT '手机号码',
`cf` varchar(32) DEFAULT '验证名称',
`bo` varchar(32) DEFAULT '应付费用',
`ou` varchar(32) DEFAULT '发生时间',
`dt` int(4) DEFAULT '1',
`mo` int(4) DEFAULT '1',
`ei` int(4) DEFAULT '1',
`yw` text,
`bu` text,
PRIMARY KEY (`id`)
) ENGINE={$qi} AUTO_INCREMENT=1 DEFAULT CHARSET=utf8";
$pass=$db->query($gs);
if($pass){
$retu = "创建conn成功";
$list = array();
$list['yw'] = "'查询页面说明'";
$list['bu'] = "'查询结果说明'";
$db=ConnectMysqli::getIntance($conn);
$echos=$db->inserta("conn",$list);
if($echos){
return "$retu : 写入初始数据成功! ";
}else{
return "$retu : 写入初始数据失败! ";
}
}else{
return "创建conn失败";
}
}else{
$sql="select * from `conn` ORDER BY `id` DESC LIMIT 1";
$echos=$db->getRow($sql);
$rp = $echos['ey'];
return "conn已创建成功;<br>读取配置标题【{$rp}】成功";
}
}
Function ig($qi,$zh){
$db=ConnectMysqli::getIntance($conn);
$sql="describe `user`";
$pass=$db->query($sql);
if(!$pass){
//创建数据库结构 默认密码253252545
$ql = md5("253252545");
$gs="CREATE TABLE `user` (
`id` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
`wi` varchar(32) DEFAULT 'admin@ewuyi.net',
`password` varchar(32) DEFAULT '{$ql}',
`si` datetime DEFAULT CURRENT_TIMESTAMP,
KEY `wi` (`wi`)
) ENGINE={$qi} DEFAULT CHARSET=utf8";
$pass=$db->query($gs);
if($pass){
$retu = "创建user成功";
$list = array();
$list['wi'] = "'{$zh}'";
$echos=$db->inserta("user",$list);
if($echos){
return "$retu : 写入初始数据成功!<br>通过<b>{$zh}</b>和密码<b>253252545</b>登录。 ";
}else{
return "$retu : 写入初始数据失败! ";
}
}else{
return "创建user失败";
}
}else{
$sql="select * from `user` ORDER BY `id` DESC LIMIT 1";
$echos=$db->getRow($sql);
$rp = $echos['wi'];
return "user已创建成功;<br>读取配置账号【{$rp}】成功(默认密码是<b>253252545</b>)";
}
}
Function se($qi,$zh){
$db=ConnectMysqli::getIntance($conn);
$sql="describe `kudi`";
$pass=$db->query($sql);
if(!$pass){
//创建数据库结构
$gs="CREATE TABLE `kudi` (
`hi` int(10) unsigned NOT NULL PRIMARY KEY AUTO_INCREMENT,
`rn` varchar(32) DEFAULT '-',
`le` varchar(32) NOT NULL,
`ls` varchar(128) DEFAULT '-',
`fe` varchar(32) DEFAULT '名称',
`ge` varchar(32) DEFAULT '0.88',
`ze` datetime DEFAULT CURRENT_TIMESTAMP,
`sa` text,
`check` int(4) NOT NULL DEFAULT '0',
`juan_isid` varchar(32) DEFAULT '-',
`fi` varchar(32) DEFAULT 'ali',
`pe` int(4) NOT NULL DEFAULT '0',
`sq` text,
`nt` datetime DEFAULT CURRENT_TIMESTAMP,
`ty` datetime DEFAULT CURRENT_TIMESTAMP,
`ot` datetime DEFAULT CURRENT_TIMESTAMP,
`ht` datetime DEFAULT CURRENT_TIMESTAMP,
KEY `le` (`le`),
KEY `juan_isid` (`juan_isid`)
) ENGINE={$qi} DEFAULT CHARSET=utf8";
$pass=$db->query($gs);
if($pass){
return "创建kudi成功";
}else{
return "创建kudi失败";
}
}else{
return "kudi已创建成功";
}
}
if(!stristr("-InnoDB-MYISAM-",$iz)){
?>
<h2>初始化设置</h2>
<h2>第一步</h2>手动修改inc/sqls.php,23-27行左右对应数据库参数。<br>
<form name="qm" method="post" action="" onsubmit="return sta(0);">
<h2>第二步</h2>本页根据实际情况选择数据库类型Innodb(或Myisam)。<br>
<select name="time" id="time" onBlur="sta(1)" >
<option value="InnoDB">InnoDB</option>
<option value="MYISAM">MYISAM</option>
</select>
<h2>第三步</h2>填写管理员账号（电子邮件格式）。<br>
<input name="name" type="text" class="vi" id="name" value="admin@ewuyi.net" placeholder="请输入姓名" onBlur="sta(2)" />
<h2>第四步</h2>点下方立即提交。<br>
<input type="submit" name="button" class="buts" id="sub" value="立即提交" />
<h2>相关说明</h2>
1. 这是测试版，1年前就已开发，最近测试通过，但未曾在实际环境使用。<br>
2. 推荐使用集成环境php(5.4-5.6) + mysql(5.6)。<br>
<h2>具备条件</h2>
需要管理员（使用者）具备FTP、域名绑定、网站空间使用、基本excel操作等技能。<br>
推荐有mysql管理软件经验，含数据备份、导入导出，表结构创建等。<br>
需要有认证公众号年付300那种并已申请支付(开通当面扫码付、域名白名单等)。<br>
该方式可能需要费率0.6%左右，教育系统可能可以申请到免费率接口自己努力下。<br>
</form>
<?php
}else{

if($userx){
 $userx = strtolower($userx);
 if(!preg_match('/^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,8}$/',$userx)){
exit("管理员账号得是邮件地址!后退继续");
 }
}

$wo = "<h2>忽略以上提示表不存在的报错</h2>";
$wo.= "<h2>创建conn表</h2>".conntable($iz,$userx);
$wo.= "<h2>创建user表</h2>".ig($iz,$userx);
$wo.= "<h2>创建kudi表</h2>".se($iz,$userx);
echo str_replace("成功","<span style='color:red;'>成功</span>",$wo);
echo "<h2>成功判断</h2>如果以上已有五个<span style='color:blue;'>红字成功</span>说明安装成功";
}
?>