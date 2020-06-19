<!doctype html><?php
include "./inc/conn.php";
$tts = date("YmdHis",time());
?>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $title;?></title>
<meta name="author" content="yujianyue, admin@ewuyi.net">
<meta name="copyright" content="www.12391.net">
<link href="inc/css/wapcha.css<?php echo $aj; ?>" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/js/newcha.js<?php echo $aj; ?>"></script>
</head>
<body onLoad="inst();">
<div class="html">
<div class="divs" id="divs">
<div id="head" class="head" onclick="location.href='?t=<?php echo $tts;?>';">
<?php echo $title;?>
</div>
<div class="main" id="main">
<?php
$stime=microtime(true);
$du = tram($_GET['id']);
$codes = tram($_GET['code']);
$tw = tram($_GET['name']);
if(!$tw && !$du){
?>
<form name="ex" method="GET" action="?t=<?php echo $tts;?>" onsubmit="return mi(0);">
<div class="so_box" id="11">
<input name="name" type="text" class="vi" id="name" value="" placeholder="请输入<?php echo $ks;?>" onfocus="st('name',1)" onBlur="mi(1)" />
</div>
<?php
if($mo=="1"){
?>
<div class="so_box" id="33">
<input name="code" type="text" class="vi" id="code" placeholder="请输入验证码" onfocus="this.value=''" onBlur="mi(3)" />
<div class="more" id="clearkey">
<img src="inc/code.php?t=<?php echo $tts;?>" id="Codes" onClick="this.src='inc/code.php?t='+new Date();" />
</div></div>
<?php }?>
<div class="so_but">
<input type="submit" name="button" class="buts" id="sub" value="查询并支付" />
</div>
<div class="so_bus" id="tishi">
说明:输入<?php echo $ks;?>
<?php if($mo=="1"){ ?>+验证码<?php } echo "查询"; ?>。<br>
<!--查询说明在这里添加：开始-->
<?php echo $yw; ?>
<!--查询说明在这里添加：结束-->
</div>
<div id="tishi1" style="display:none;">请输入<?php echo $ks;?></div>
<div id="tishi2" style="display:none;">请输入<?php echo $ck;?></div>
<div id="tishi4" style="display:none;">请输入4数字验证码</div>
</form>
<?php
}else{
if(!is_numeric($du)){
if($mo=="1"){
session_start();
if($codes!=$_SESSION['PHP_M2T']){
webalert("请正确输入验证码！","index.php");
}
}
//这里自行增加接受参数的过滤。
if(!$tw){
webalert("请输入$ks!","index.php");
}
if(strlen($tw)<1){
webalert("请输入$ks!","index.php");
}
if(strlen($tw)>36){
webalert("请输入$ks !(18字以内)","index.php");
}
$sqs = "WHERE `le` = '{$tw}'";
}else{
$sqs = "WHERE `hi` = '{$du}'";
}
$pagesize = "1"; //每页只显示一条
$page = tram($_GET["page"]);
$rv = tram($_GET["a"]);
$pw = tram($_GET["d"]);

if(strlen($rv)>0 && strlen($pw)>0){
if(!stristr("-DESC-ASC-","-{$pw}-")){ $pw="ASC";}
$sw = " AND `check` >= 0 ORDER BY `{$rv}` ASC";
}else{
$sw = " AND `check` >= 0 ORDER BY `ze` DESC";
}
$fc ="`hi`,`le`,`fe`,`ge`,`ze`,`sa`";
$db=ConnectMysqli::getIntance($conn);
$sql="SELECT COUNT(*)  FROM `kudi` " . $sqs;
$list=$db->getRow($sql);
$recs=$list['COUNT(*)'];
$pagecount = bcdiv($recs+$pagesize-1,$pagesize,0); //算出总页数
$urls = "&name={$tw}&code={$codes}";
if(strlen($rv)>0){ $urls .= '&a='.$rv;}
if(strlen($pw)>0){ $urls .= '&d='.$pw;}
if(strlen($keys)>0){ $urls .= '&keys='.$keys;}
if(!isset($page)) $page = 1; //如果没有指定显示页码，缺省为显示第一页
if(!is_numeric($page)) $page = 1;
if($page<1) $page = 1; //如果页码比1小，则显示第一页
if($page>$pagecount) $page = $pagecount; //如果页码比总页数大，则显示最后一页
$p = $page * $pagesize + 1 - $pagesize -1;
if($p<0) $p = 1; //如果
// echo "<!--{$recs} $pagecount -->";
$sql="SELECT {$fc} FROM `kudi` $sqs $sw";
$sql.=" limit $p, $pagesize";
$list=$db->getAll($sql);
//echo json_encode($list);
echo "<h1>&nbsp;</h1>\r\n";
echo "<div style=\"margin:0 auto;overflow-x:auto;width:98%;\">";
echo "\r\n<!--startprint-->\r\n";
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
}
$oo = array();
foreach ($pc as $mk => $iv ) {
$oo[$mk] = $iv;
}
$ep = $oo['hi'];
echo "\r\n<h1>查询结果{$ii}</h1>\r\n";
echo "\r\n<span style='display:none;' id='ids'>{$ep}</span>\r\n";
echo "<table cellspacing=\"0\" class=\"table\"> \r\n";
$ce = $oo['le'];
echo "\r\n<tr>";
echo "<td class=\"r\">$ks</td><td class=\"l\">$ce</td>";
echo "</tr>\r\n";
$om = $oo['fe'];
echo "\r\n<tr>";
echo "<td class=\"r\">$ck</td><td class=\"l\">$om</td>";
echo "</tr>\r\n";
$fr = $oo['ge'];
if(strlen($fr)>1){
if($oo['pe']<1){ $lh = "待付";}else{ $lh = "已付";}
echo "\r\n<tr>";
echo "<td class=\"r\">$xd</td><td class=\"l\">$fr</td>";
echo "</tr>\r\n";
if($oo['pe']<1 && $ei.'@'<>'2@'){
echo "\r\n<tr>";
echo "<td class=\"r\">支付方式</td><td class=\"l\" id=\"pays{$ep}\">稍等显示</td>";
echo "</tr>\r\n";
}
}
$tm = $oo['ze'];
$nd = $oo['sa'];
if(stristr($nd,"发货时间") || stristr($nd,$em) ){ //快递时间
echo "\r\n<!--备注有【发货时间】不显示系统时间 -->\r\n";
}else{
if(strlen($em)<2){
echo "\r\n<!-- 系统控制：不显示时间 -->\r\n";
}else{
echo "\r\n<tr>\r\n";
echo "<td class=\"r\">$em</td><td class=\"l\">$tm</td>\r\n";
echo "\r\n</tr>\r\n";
}
}
if(strlen($nd)>1){
$nd = str_replace("\r\n","<br>",$nd);
$rl = explode("<br>",$nd);
foreach($rl as $bj){
if(stristr($bj,":")){
$xo = explode(":",$bj);
$rh = $xo[0];
$lens = strlen($bj);
$len1 = strlen($rh);
$ee = substr($bj,$len1-$lens+1);
echo "\r\n<tr>";
echo "<td class=\"r\">$rh</td><td class=\"l\">$ee</td>";
echo "</tr>\r\n";
}else{
if(Trim($bj)==""){
echo "\r\n<!--kongbaihang-->\r\n";
}else{
echo "\r\n<!-- 备注：行：没有英文：则不分2列显示 -->\r\n";
echo "\r\n<tr>";
echo "<td class=\"l\" colspan=\"2\">$bj</td>";
echo "</tr>\r\n";
}
}
}
}
echo "</table>\r\n";
if($ei.'@'=='2@'){
}else{
echo "<script language=\"javascript\">\r\n";
echo "//var id={$ep};\r\n";
echo "setInterval(\"makeRequest('tenpay.php?id={$ep}&t=' + new Date())\",2500);\r\n";
echo "</script>\r\n";
}
}
if($ii<1){
echo "\r\n<h1>查询结果不存在</h1>\r\n";
echo "<table cellspacing=\"0\" class=\"table\"> \r\n";
echo "<tr>\r\n";
echo "<td class=\"r\">查询提示</td><td class=\"l\">没有查询到相关信息哦</td>\r\n";
echo "</tr>\r\n";
echo "</table>\r\n";
}else{
if($pagecount>1){ //页码比0大，表示有数据
echo "<br><table cellspacing=\"0\" class=\"table\"> \r\n";
echo "<tr><td colspan=\"{$li}\">";
if($page>1){
echo '<a href="?page=1' . $urls . '">第<b>1</b>条</a> ';
echo '<a href="?page='. ($page-1) . '' . $urls . '">前1条</a> ';
	}
if($page<$pagecount){
echo '<a href="?page='. ($page+1) . '' . $urls . '">后1条</a> ';
echo '<a href="?page=' . $pagecount . '' . $urls . '">第<b>'.$pagecount.'</b>条</a> ';
	}
echo '当前第<b>' . $page . '</b>/<b>' . $pagecount . '</b>条 ';
//echo '<span>' . $pagesize . '</span>条/页 ';
//echo '共<span>' . $recs . '</span>条 </td><tr>';
echo "</table>\r\n";
}
}
echo "\r\n<!--endprint-->\r\n</div>\r\n";
?>
<div class="so_bus" >
<!--查询结果说明：开始-->
<?php echo $bu; ?>
<!--查询结果说明：结束-->
</div>
<div class="so_but">
<input type="button" class="buts" value="返回查询" id="reset" onclick="location.href='?t=back';">
</div>
<?php
}
$etime=microtime(true);
$total=$etime-$stime;
echo "<!----页面执行时间：{$total} ]秒--->";
?>
</div>
<div class="boto" id="boto">
&copy;<?php echo date('Y');?>&nbsp;
<a href="<?php echo $ax;?>" target="_blank"><?php echo $copyr;?></a>
</div>
</div>
</div>
</body>
<!--
应急联系：15058593138 （付费故障报修+快速提问）
-->
</html>