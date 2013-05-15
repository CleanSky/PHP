<?php
header("Content-type: text/html; charset=utf-8");
function chinesesubstr($str, $start, $len) {
	$strlen = strlen($str);
	$clen = 0;
	for ($i = 0; $i < $strlen; $i++, $clen++) {
		if ($clen >= $start + $len)
			break;
		if (ord(substr($str, $i, 1)) > 0xa0) {
			if ($clen >= $start)
				$tmpstr .= substr($str, $i, 2);
			$i++;
		} else {
			if ($clen >= $start)
				$tmpstr .= substr($str, $i, 1);
		}
	}

	return $tmpstr;
}

function showShort($str, $len) {
	$tempstr = chinesesubstr($str, 0, $len);
	if ($str <> $tempstr)
		$tempstr .= "...";//以。。。结尾

	return $tempstr;
}

$str = "我是谁，你猜猜！";
echo showShort($str, 7);
?>
