<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
//error_reporting(0);
$stime=microtime(true);
header("content-Type: text/html; charset=utf-8");//输出编码GBK
$stime=microtime(true);
$ci = "../inc/config.ini.php"; //数据库路径&缓存地址
include "../inc/sqls.php";
include "../inc/safe.php";
$pagesize = 10;
$qi = "yujianyue";
if(file_exists($ci)){
//读取conn.php.inc配置信息
$rp=file_get_contents($ci);
if(strlen($rp)<10){
echo "<h1>缓存读取无效02</h1>";
if(!unlink($op)){}
exit();
}
}
if(!file_exists($ci)){
$db=ConnectMysqli::getIntance($conn);
$sql="select * from `conn` ORDER BY `id` DESC LIMIT 1";
$echos=$db->getRow($sql);
$rp = json_encode($echos);
file_put_contents($ci,'<?php exit() ?><!--cache-->'.$rp);
}
$rp = explode('<!--cache-->',$rp);
$rp = $rp[1];
$jp=json_decode($rp,true);
$title=$jp['ey'];
$copyr=$jp['ki'];	
$ax=$jp['yo'];
$eq=$jp['gn'];
$xm=$jp['mp'];
$ww=$jp['xh'];
$mo = $jp['mo'];
$dt = $jp['dt'];
$ei = $jp['ei'];
$yw = $jp['yw'];
$bu = $jp['bu'];
$ks = $jp['txt001'];
$ck = $jp['cf'];
$xd = $jp['bo'];
$em = $jp['ou'];
$ba = $title; 	 	//标题别名定义
$qi = $jp['id']; 	 	//标题别名定义
$os = (DIRECTORY_SEPARATOR=='\\')?"windows":'linux';
//==============================
//作 用：警告后转入指定页面
//==============================

function tram($Key){
$Keys = Trim($Key);
$Keys = addslashes($Keys);
return $Keys;
}
Function webalert($Keys,$zh){
header("content-Type: text/html; charset=UTF-8");
$html = "<script>\r\n";
$html .= "alert('".$Keys."');";
$html .= "location.href='".$zh."';";
$html .= "</script>";
//$html = "<h1>$Keys $zh</h1>";
exit($html);
}
Function tper($Keys){
if($Keys."@"=="1@")  return "已付";
if($Keys."@"=="0@")  return "未付";
return "其他";
}
function charaget($data){
if(!empty($data) ){
$fileType = mb_detect_encoding($data , array('GB2312','GBK','UTF-8','LATIN1','BIG5')) ;
if( $fileType != 'UTF-8'){
$data = mb_convert_encoding($data ,'UTF-8' , $fileType);
}
}
return $data;
}
function tu($data){
if(!empty($data) ){
$fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
if( $fileType != 'UTF-8'){
$data = mb_convert_encoding($data ,'utf-8' , $fileType);
}
}
return $data;
}
function nu($data){
if(!empty($data) ){
$nc = mb_detect_encoding($data , array('UTF-8','GBK','GB2312','BIG5')) ;
if( $nc != 'GBK'){
$data = mb_convert_encoding($data ,'GBK' , $nc);
}
}
return $data;
}
function pr($str){
Return (preg_match("/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/",$str))?true:false;
}
function tp($data){
if(!empty($data) ){
$fileType = mb_detect_encoding($data , array('UTF-8','GBK','GB2312','LATIN1','BIG5')) ;
if( $fileType != 'UTF-8'){
$data = mb_convert_encoding($data ,'UTF-8' , $fileType);
}
}
return $data;
}
function gr($data){
if(!empty($data) ){
$fileType = mb_detect_encoding($data , array('GBK','GB2312','UTF-8','LATIN1','BIG5')) ;
}
return $fileType;
}
function yl($data){
if(!empty($data) ){
$fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
}
return $fileType;
}
function ds($data){
if(!empty($data) ){
$nc = mb_detect_encoding($data , array('UTF-8','GBK','GB2312','BIG5')) ;
}
return $nc;
}
Function ew($Key){
header("content-Type: text/html; charset=UTF-8");
$html = "<script>\r\n";
$html .= "alert('".$Key."');";
$html .= "history.go(-1);\r\n";
$html .= "</script>";
exit($html);
}
Function ef($Keys){
$Keys = strip_tags($Keys); 
$Keys = str_replace(array("\r\n", "\r", "\n"), "", $Keys); 
return addslashes($Keys); //addslashes(
}
Function hr($Keys){
$Keys = strip_tags($Keys); 
$Keys = str_replace(array("\r\n", "\r", "\n"), "<br>", $Keys); 
return addslashes($Keys); //addslashes(
}
function unescape($str){
$ret = '';
$len = strlen($str);
for ($i = 0; $i < $len; $i++){
if ($str[$i] == '%' && $str[$i+1] == 'u'){
$val = hexdec(substr($str, $i+2, 4));
if ($val < 0x7f) $ret .= chr($val);
else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
$i += 5;
}elseif ($str[$i] == '%'){
$ret .= urldecode(substr($str, $i, 3));
$i += 2;
}else{
$ret .= $str[$i];
}
}
return $ret;
}
function nk($str) {
$str = rawurldecode($str);
preg_match_all("/%u.{4}|&#x.{4};|&#d+;|.+/U",$str,$r);
$ar = $r[0];
foreach($ar as $k=>$v) {
if(substr($v,0,2) == "%u"){
$ar[$k] = iconv("UCS-2","GBK",pack("H4",substr($v,-4)));
}elseif(substr($v,0,3) == "&#x"){
$ar[$k] = iconv("UCS-2","GBK",pack("H4",substr($v,3,-1)));
}elseif(substr($v,0,2) == "&#") {
$ar[$k] = iconv("UCS-2","GBK",pack("n",substr($v,2,-1)));
}
}
return join("",$ar);
}
function txtwrite($ya,$dh){
$ku = fopen($ya,'a+');
fwrite($ku,$dh."\r\n");
fclose($ku);
}
function ml($wn){
return str_replace(array("\r\n", "\r", "\n", "\t"), "", $wn);
}
function xt($datedir){
$t="0123456789ABCDEFGXYZKPQ";
$s="";
for($i=0;$i<4;$i++)$s=$s.substr($t,rand(1,20),1);
if(!file_exists($datedir.$s.".xls.php")){
return $s;
}else{
return xt($datedir);
}
}
function pt($stime,$ba){
$ac = date("Y");
$etime=microtime(true);
$total=$etime-$stime;   //计算差值
return "<div id='dd'>
	&copy; $ac &nbsp;<a href='/' target='_self'>简易查询与定额收费系统(微信扫码付)</a>
	</div><!--{$total}秒-->";
}
$pt = pt($stime,$ba);
?>