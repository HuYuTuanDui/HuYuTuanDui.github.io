<?php include "doconn.php"; ?>
<?php include "dosess.php"; ?>
<?php
$act=Tram($_POST['Act']);
$ids=Tram($_POST['id']);
$tian=Tram($_POST['tian']);
$mh=Tram($_POST['old']);
if($act=="dauser"){
}else{
$db=ConnectMysqli::getIntance($conn);
$sql="select * from `kudi` where `hi` = '{$ids}'";
$iz=$db->getRow($sql);
$wt = $iz['le'];
$wt = tu($wt);
if(strlen($wt)<1){ exit("404:参数ID = $ids 异常!"); }
}
switch ($act){
//################################################################
case "douser": //课改查询条件
$tian = unescape($tian);
$vs = preg_replace("/[^A-Z^a-z^0-9^_^@^\-^\.^\x{4e00}-\x{9fa5}]+/u", '_', $tian);
$list = array();
$list['le'] = $tian;
$db=ConnectMysqli::getIntance();
$list=$db->update("kudi", $list," `hi` = {$ids}");
if($list){exit("0");}else{exit("查询条件 修改为 $tian ({$vs}) 失败");}
break;
//################################################################
case "doedit": //修改状态
$tian = unescape($tian);
if(stristr("|0|1|2|-1|","|{$tian}|")){
}else{
exit("状态 $tian 为不在0,1,2,-1范围内。");
}
$list = array();
$list['check'] = $tian;
$db=ConnectMysqli::getIntance();
$list=$db->updata("kudi", $list," `hi` = {$ids}");
if($list){exit("0");}else{exit("$wt 状态 修改为 $tian 失败");}
break;
//################################################################
case "deuser": //单删
$db=ConnectMysqli::getIntance();
$echos=$db->deleteOne("kudi","hi={$ids}");
if($echos){exit("0");}else{exit("单个删除 $ids 失败");}
break;
//################################################################
case "dauser": //批删
$ids = str_replace(",@","",$ids."@");
$db=ConnectMysqli::getIntance();
$echos=$db->deleteAll("kudi","`hi` in({$ids})");
if($echos){exit("0");}else{exit("批量删除 $tian 失败");}
break;
//################################################################
default:
exit("404:不认识的指令{$act}");
break;
}
?>