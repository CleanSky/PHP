<!DOCTYPE html>
<html lang="zh-CN">
<meta charset="utf-8">
<title>地址转换</title>
<img src="logo.jpg" width="200" height="70" border="0" alt="地址转换" title="地址转换">
<h3>地址转换</h3>

<form method="post">
请输入地址:<br />
<input name="source" size="72"><br /><br />
<input type="submit" name="btncode" value="转为迅雷下载地址">
<input type="submit" name="btncode" value="转为旋风下载地址">
<input type="submit" name="btncode" value="转为快车下载地址">
<input type="submit" name="btncode" value="转换成HTTP地址">
</form><p></p>

<?php
if(!empty($_POST['source'])) {

if($_POST['btncode']=='转为迅雷下载地址') {
$thunderencodeurl = "thunder://".base64_encode("AA".$_POST['source']."ZZ");
echo<<<eot
迅雷地址：{$thunderencodeurl}
eot;
}

if($_POST['btncode']=='转为旋风下载地址') {
$qqdlencodeurl = "qqdl://".base64_encode($_POST['source']);
echo<<<eot
旋风地址：{$qqdlencodeurl}
eot;
}

if($_POST['btncode']=='转为快车下载地址') {
$flashgetencodeurl = "flashget://".base64_encode("[FLASHGET]".$_POST['source']."[FLASHGET]");
echo<<<eot
快车地址：{$flashgetencodeurl}
eot;
}


if($_POST['btncode']=='转换成HTTP地址') {
if(stristr($_POST['source'],'thunder://')){
echo '<br /><br />原始地址：'.substr(base64_decode(str_ireplace("thunder://","",$_POST['source'])),2,-2);
}

if(stristr($_POST['source'],'flashget://')){
echo '<br /><br />原始地址：'.str_ireplace("[FLASHGET]","",base64_decode(str_ireplace("flashget://","",$_POST['source'])));
}
}

}
?>
