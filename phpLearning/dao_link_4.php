<?php
/*
防盗链的PHP代码
使用方法:将上述代码保存为dao4.php,
比如测试用的validatecode.rar在站点http://163.com/download里面,
则用以下代码表示下载连接.
文件名?site=1&file=文件  
例如以下URL.复制到你的站点下试试
http://www.coolcodes.cn/dao4.php?site=1&file=validatecode.rar 
以上代码测试可用
*/
$ADMIN[defaulturl] = "http://www.163.com/404.htm";//盗链返回的地址
$okaysites = array("http://www.163.com/","http://163.com"); //白名单 
$ADMIN[url_1] = "http://www.163.com/download/";//下载地点1
$ADMIN[url_2] = "";//下载地点2，以此类推

$reffer = $HTTP_REFERER;
if($reffer) {
$yes = 0;
while(list($domain, $subarray) = each($okaysites)) {
if (ereg($subarray,"$reffer")) {
$yes = 1;
}
}
$theu = "url"."_"."$site";
if ($ADMIN[$theu] AND $yes == 1) {
header("Location: $ADMIN[$theu]/$file");
} else {
header("Location: $ADMIN[defaulturl]");
}
} else {
header("Location: $ADMIN[defaulturl]");
}

?>