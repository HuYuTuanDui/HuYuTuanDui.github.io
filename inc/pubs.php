<?php

//本页不需要修改
function tram($Key){
$Keys = Trim($Key);
$Keys = addslashes($Keys);
return $Keys;
}

//本页不需要修改
function webalert($Key,$urls){
$html="<script>\r\n";
$html.="alert('".$Key."');\r\n";
if(!$urls || $urls==""){
$html.="history.go(-1);\r\n";
}else{
$html.="top.location='{$urls}';\r\n";
}
$html.="</script>";
exit($html);
}
function pr($str){
Return (preg_match("/(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/",$str))?true:false;
}
function tc($str){
Return (preg_match("/^1[3456789]\d{9,9}$/",$str))?true:false;
}
function we($Key,$urls){
$html="<script>\r\n";
$html.="alert('".$Key."');\r\n";
$html.="top.location='{$urls}';\r\n";
$html.="</script>";
exit($html);
}
function paylog($arary,$errno)  {
$ff = "./inc/rec/".date('Y-m-d').".logs.php";//按天存回执
$rr = date('Y-m-d H:i:s')."\t[{$errno}]\t".$arary;
if(!file_exists($ff)){
$rr = '<?php exit(); ?>'."\r\n".$rr;
}
$file = fopen($ff,'a+');
fwrite($file,"\r\n".$rr);
fclose($file);
}
Function isinstr($hangzhi,$bc,$vo){
if($hangzhi."_"==$bc."_"){
return "yes";
}else{
return "nos";
}
}
function charaget($data){
if(!empty($data) ){
//$fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
$fileType = mb_detect_encoding($data , array('GBK','GB2312','UTF-8','LATIN1','BIG5')) ;
if( $fileType != 'UTF-8'){
$data = mb_convert_encoding($data ,'utf-8' , $fileType);
}
}
return $data;
}
function nu($data){
if(!empty($data) ){
$fileType = mb_detect_encoding($data , array('UTF-8','GBK','LATIN1','BIG5')) ;
if( $fileType != 'GBK'){
$data = mb_convert_encoding($data ,'GBK' , $fileType);
}
}
return $data;
}
Function hr($Keys){
$Keys = str_replace(array("\""), "&quot;", $Keys);
$Keys = str_replace(array("<"), "&lt;", $Keys);
$Keys = str_replace(array(">"), "&gt;", $Keys);
$Keys = str_replace(array("\r\n", "\r", "\n"), "<br>", $Keys);
return $Keys;
}
function chstr($str,$in){
$tmparr = explode($in,$str);
if(count($tmparr)>1){
return true;
}else{
return false;
}
}
function ccurl($url , $post = '' , $referer = '' , $ip = '8.8.8.8') {
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 600);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);	
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Accept-Language: ch-CN","X-FORWARDED-FOR:$ip","CLIENT-IP:$ip"));
	curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	if ($referer) {
		curl_setopt($curl, CURLOPT_REFERER, $referer);
	} else {
		curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
	}
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	if (!empty($post)) {
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
	}
		curl_setopt($curl, CURLOPT_COOKIE, '');
	$nres = curl_exec($curl);
	curl_close($curl);
	if ($nres) {
		return $nres;
	}
}
function wu($arr){
foreach($arr as $k=>$v) {
if(!is_array($v) && stristr("|time|context|","|{$k}|") ){
if(stristr("|time|","|{$k}|")){echo "<h4>$v</h4>\r\n";}else{echo "$v\r\n";}
}
else
if(is_array($v))
wu($v);
}
}
?>