<?php include "doconn.php";?>
<?php include "dosess.php";?>
<?php
/**
*尊重著作权 请勿删改以下信息
* @author    Yujianyue <admin@ewuyi.net>
* @copyright Copyright (c) 2014-2112 12391.Net
*/
$act = tram($_GET["act"]);
$ofo = tram($_GET["file"]);
if(strlen($act)<1) $act = tram($_POST["act"]);
if(strlen($ofo)<1) $ofo = tram($_POST["file"]);
switch ($act) {
case "name":
ig($qi,$zh);
$db=ConnectMysqli::getIntance($conn);
$sql="SELECT COUNT(*)  FROM `user` WHERE `ge`='{$ofo}'";
$list=$db->getRow($sql);
$recs=$list['COUNT(*)'];
if($recs>0){
exit("404");
}else{
exit("0");
}
break;
default:
exit("No Such Act : $act !");
}
?>