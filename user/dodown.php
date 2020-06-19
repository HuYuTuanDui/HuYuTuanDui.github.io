<?php
include "doconn.php";
include "dosess.php";
$ms = Trim($_GET["keys"]);
preg_match_all('/[a-zA-Z0-9_]{10,36}/', $ms, $xe);
$xb = $xe[0][0];
$eb = date("YmdHis");
$dy = date("YmdHis");
$filename = "Down_{$xb}_{$eb}";
header("Content-Disposition:attachment;filename={$filename}.txt");
header('Expires:0');
header('Pragma:no-cache');
$db=ConnectMysqli::getIntance();
$sql="select `le`,`fe`,`ge`,`check`,`pe`,`ht` from `kudi` WHERE `rn` = '{$xb}' ORDER BY `check` DESC,`pe` DESC";
$list=$db->getAll($sql);
$ii=0;
foreach ($list as $pc ) {
$ii++;
if($ii=="1"){
$vv="No";
foreach ($pc as $mk => $iv ) {
$vv.="\t{$mk}";
}
$vv.= "\r\n序号\t{$ks}\t{$ck}\t应付金额({$xd})\t可查否\t支付否\t支付时间";
}
$vv.= "\r\n".$ii;
foreach ($pc as $mk => $iv ) {
$vv.="\t".$iv;
}
}
if($ii<1){
$vv = "错误:数据数为零";
}
echo "".$vv;
?>