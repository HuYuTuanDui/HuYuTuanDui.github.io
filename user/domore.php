<?php include "doconn.php"; ?>
<?php include "dosess.php"; ?>
<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
$txt001 = trim($_POST['txt001']);
$cf = trim($_POST['cf']);
$bo = trim($_POST['bo']);
$ou = trim($_POST['ou']);
$gn = trim($_POST['gn']);
$mp = trim($_POST['mp']);
$xh = trim($_POST['xh']);
$bm = trim($_POST['ei']);
if(!$txt001){
}else{
if (!unlink($ci)){
}else{
}
$txt001 = ef($txt001);
$cf = ef($cf);
$bo = ef($bo);
$ou = ef($ou);
$gn = ef($gn);
$mp = ef($mp);
$xh = ef($xh);
$ja = date('Y-m-d H:i:s');
$list = array();
$list['txt001'] = "'".$txt001."'";
$list['cf'] = "'".$cf."'";
$list['bo'] = "'".$bo."'";
$list['ou'] = "'".$ou."'";
if(strlen($gn)>6){
$list['gn'] = "'".$gn."'";
}
if(strlen($mp)>8){
$list['mp'] = "'".$mp."'";
}
if(strlen($xh)>10){
$list['xh'] = "'".$xh."'";
}
$list['ei'] = $bm;
$db=ConnectMysqli::getIntance($conn);
$list=$db->updata("conn", $list," `id` = {$qi}");
$db=ConnectMysqli::getIntance($conn);
$sql="select * from `conn` where `id` = {$qi}";
$info=$db->getRow($sql);
if(stristr("|NULL|null|","|{$info}|")){exit("用户名{$ofo}不存在!");}
$ov = json_encode($info);
file_put_contents($ci,'<?php exit() ?><!--cache-->'.$ov);
webalert("参数修改成功! ","domore.php");
}
$at=filemtime($ci);
$et=date("Y-m-d H:i:s",$at);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>更多设置-<?php echo $ba;?></title>
<meta name="keywords" content="<?php echo $sitemeta;?>" />
<link href="do_css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="dotype.js"></script>
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
<h2><span>更多设置</span></h2>
<div id='fu'>
<table border="0" cellpadding="0">
<tr><td valign="top">
<div id="md">
<fieldset class="w">
<legend>更多设置</legend>
<table cellspacing="0" class="table">
<form name="al" action="" method="post" onsubmit="return lo(0);">
<tr>
<td align="right" style="width:100px;"><?php echo $ks;?>：</td><td align="left">
<input name="txt001" id="txt001" type="text" value="<?php echo $ks;?>" onBlur="lo(1)" />
<span id="re" class="grey">条件1(第1列)：查询字段名称；比如:手机号码。</span>
</td></tr>
<tr>
<td align="right" style="width:100px;"><?php echo $ck;?>：</td><td align="left">
<input name="cf" id="cf" type="text" value="<?php echo $ck;?>" onBlur="lo(2)" />
<span id="cr" class="grey">条件2(第2列)：验证字段名称；比如:考生姓名。</span>
</td></tr>
<tr>
<td align="right" style="width:100px;"><?php echo $xd;?>：</td><td align="left">
<input name="bo" id="bo" type="text" value="<?php echo $xd;?>" onBlur="lo(3)" />
<span id="ue" class="grey">字段3(第3列)：应付金额字段；建议:应付金额。</span>
</td></tr>
<tr>
<td align="right" style="width:100px;"><?php echo $em;?>：</td><td align="left">
<input name="ou" id="ou" type="text" value="<?php echo $em;?>" onBlur="lo(4)" />
<span id="po" class="grey">自定义时间字段名称；比如:发货时间。</span>
</td></tr>
<tr style="display:none"><td align="right">支付设置：</td><td align="left">
<select name="ei" id="ei" onBlur="lo(7)" />
<option value="1"<?php if($ei.'_'=='1_'){?><?php echo " selected"; }?>>先支付再看结果__付费查询用途</option>
<option value="0"<?php if($ei.'_'=='0_'){?><?php echo " selected"; }?>>直接显所有结果__电费收费用途</option>
<option value="2"<?php if($ei.'_'=='2_'){?><?php echo " selected"; }?>>不用付费直接查__关闭付费功能</option>
</select> <span id="fa" class="grey"></span>
</td></tr>
<tr>
<td align="right" style="width:100px;">微信支付商户号：</td><td align="left">
<input name="gn" id="gn" type="text" value="<?php echo $eq;?>" onBlur="lo(5)" />
<span id="ta" class="grey">微信支付商户号;留空不修改。</span>
</td></tr>
<tr>
<td align="right" style="width:100px;">公众号APPID：</td><td align="left">
<input name="mp" id="mp" type="text" value="<?php echo $xm;?>" onBlur="lo(6)" />
<span id="da" class="grey">公众号APPID;留空不修改。</span>
</td></tr>
<tr>
<td align="right" style="width:100px;">API密钥：</td><td align="left">
<input name="xh" id="xh" type="text" value="<?php echo $ww;?>" onBlur="lo(9)" />
<span id="ag" class="grey">API密钥;留空不修改。</span>
</td></tr>
<tr><td align="right">&nbsp;</td><td align="left">
<input name="Submit" type="submit" id="sub" value="提交/修改" />
</td></tr><tr><td align="left" colspan="2">
<h4>以下仅供参考(可能不是本支付方式的说明)</h4>
1. 微信支付商户号：微信支付后台: 帐户设置-个人信息-登录账号。<br>
公众号APPID:公众号后台左侧微信支付进入查看(即可能得企业年付300认证过的公众号)。<br>
2. API密钥设置：微信支付后台: 帐户设置-安全设置-API安全-API密钥-设置API密钥。<br>
3. 商户类目对应资质、费率、结算周期：https://kf.qq.com/faq/140225MveaUz1501077rEfqI.html<br>
4. Native原生支付相关介绍:https://pay.weixin.qq.com/wiki/doc/api/native.php?chapter=3_1<br>
</td></tr></form></table>
</fieldset></div>
</td><td valign="top">
<?php include "doleft.php";?>
</td></tr></table>
</div></div>
<?php echo $pt; ?>
</body>
</html>