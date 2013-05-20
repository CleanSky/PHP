<?php
/*=============================================================================
# 六间房笔试题一：读取一个文件，将其Base64编码，每76个字符加一个换行 
=============================================================================*/
header('Content-Type: text/html; charset=utf-8');
$body=file_get_contents('base64.txt');
$base_body=base64_encode($body);
$count=1;
for($i=0;$i<strlen($base_body);$i=$i+76){
	$index=($count-1)*76;
	@$all_str.='<p>'.substr($base_body,$index,76).'</p>';
	$count++;
}
echo $all_str;
?>