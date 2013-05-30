<?php
//********弹出alert框并跳转到指定页面******//
function alert($message,$url='',$isAlert=true,$title='提示'){
	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>',$title,'</title></head><body>';
	echo '<script type="text/javascript">';
	echo $isAlert?'alert("'.$message.'");':'';
	echo $url==''?'history.back();':'location.href="'.$url.'";';
	echo '</script>';
	echo '</body></html>';
	exit();
}
?>