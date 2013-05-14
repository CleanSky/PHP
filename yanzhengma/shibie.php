<?php
/* 对数值数值进行排序，找到第二多的元素，因为第一多的元素是背景色，第二多才是字符颜色，换句话说，如果每个字符都使用不同的颜色，或者背景色不是那么单调，我还怎么分离出字符颜色呢？ */
function getMostRepeated($array){
    $count = array_count_values($array);
    arsort($count);
    $keys = array_keys($count);

    return $keys[1];
}
/* 读取验证码图片，并将像素RGB读入二维数组，然后分离出有效字符 */
function fixImg($url){
    $img = imagecreatefrompng($url);

    $with = imagesx($img);
    $height = imagesy($img);
    $middle = $height / 2;

    $colors = array();

    for ($i = 0; $i < $with; ++$i) {
        $color = imagecolorat($img, $i, $middle);// 读取中线的像素颜色，中线肯定会切到字符。。。
        $colors[] = $color;
    }

    $mainColor = getMostRepeated($colors);// 分离出字符颜色
    $pic = array();

    for ($x = 0; $x < $with; ++$x) {
    	$flag = true;
        for ($y = 0; $y < $height; ++$y) {
            $currentColor = imagecolorat($img, $x, $y);
            $pos = 0;// 原图片用的是斜体，为了方便分割字符，转成正体，所以用斜体是没用的。。。
            if($y < 16){
            	$pos = 0;
            }elseif($y >= 16 && $y <= 20){
            	$pos = 1;
            	$pic[$y][0] = 0;
            }elseif($y >= 21 && $y <= 26){
            	$pos = 2;
            	$pic[$y][0] = $pic[$y][1] = 0;
            }else{
            	$pos = 3;
            	$pic[$y][0] = $pic[$y][1] = $pic[$y][2] = 0;
            }
						// 因为干扰像素和字符的颜色完全不同，轻而易举的分离出字符色，字符像素点置1，所以干扰像素颜色至少要有部分是和字符颜色相同才行！
            if ($currentColor !== $mainColor) {
            	$pic[$y][$x+$pos] = 0;
            }else{
            	$pic[$y][$x+$pos] = 1;
            	$flag = false;
            }
        }
    }

    return $pic;
}
// 传说中的特征码
$char = array(
'A'=>'000000000000000000010000000000000000010110000000000000001111100000000000000011101000000000000011111000000000000001111110000000000001011100110000000000111110000110000000001110100000110000000111100000000110000000111111000000110000000111111111000110000000000011111110110000000000000111111110000000000000000111111110000000000000001111111000000000000000011111110000000000000000001110000000000000000000110',
'B'=>'111111111111111111110111111111111111111110111111111111111111110110000000110000000110110000000110000000110110000000110000000110110000001110000000110111000011111000000110111111111001100011110011111110001111111100001110100001111111100000000000000111101000',
'C'=>'000001011110000000000000011111111111110000000111111111111110000001110100001111111000011100000000000011100011000000000000001100011000000000000001110110000000000000001110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000001100011000000000000001100011000000000000011000',
'D'=>'111111111111111111110111111111111111111110111111111111111111110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110111000000000000001110011000000000000011100011110000000000111100001111000000001111000000111111111111111000000011111111111100000000000111111110000000',
'E'=>'111111111111111111110111111111111111111110111111111111111111110110000000110000000110110000000110000000110110000000110000000110110000000110000000110110000000110000000110110000000110000000110110000000110000000110110000000000000000110000000000000000000110',
'F'=>'111111111111111111110111111111111111111110111111111111111111110110000000110000000000110000000110000000000110000000110000000000110000000110000000000110000000110000000000110000000110000000000110000000110000000000110000000000000000000',
'G'=>'000001011110000000000000011111111111110000000111111111111110000001110100001111111000011100000000000011100011000000000000001100011000000000000001110110000000000000001110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000001111111110011000000001111111100011000000001111111100',
'H'=>'111111111111111111110111111111111111111110111111111111111111110000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000111111111111111111110111111111111111111110111111111111111111110',
'I'=>'111111111111111111110111111111111111111110111111111111111111110',
'J'=>'111111111111111111111111111111111111111111111111111111111111110',
'K'=>'111111111111111111110111111111111111111110111111111111111111110000000000110000000000000000001110000000000000000011011000000000000001111001110000000000011110001111000000000111100000111100000001110000000001110000011100000000000111000111000000000000011100110000000000000001110100000000000000000110000000000000000000010',
'L'=>'111111111111111111110111111111111111111110111111111111111111110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110',
'M'=>'111111111111111111110111111111111111111110111111000000000000000111111100000000000000000111111110000000000000000111111000000000000000011111111100000000000000001111110000000000000000111111100000000000000000111100000000000000011111100000000000010111000000000000001111100000000000011111101000000000000111110000000000000011100000000000000000111111111111111111110111111111111111111110111111111111111111110',
'N'=>'111111111111111111110111111111111111111110111110000000000000000011111000000000000000000111100000000000000000001110000000000000000000111100000000000000000011110000000000000000000111000000000000000000001110000000000000000001111100000000000000000111110000000000000000001111000000000000000000011110111111111111111111110111111111111111111110',
'O'=>'000001011110000000000000011111111111100000000111111111111110000001110100000011111000011100000000000011100011000000000000001100011000000000000001110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110111000000000000000110011000000000000011100011110000000000111100001111000000001111000000111111111111111000000001111111111100000000000111111110000000',
'P'=>'111111111111111111110111111111111111111110111111111111111111110110000000011000000000110000000011000000000110000000011000000000110000000111000000000110000000111000000000111100001110000000000011111111100000000000011111111000000000000000111110000000000000',
'Q'=>'000001011110000000000000011111111111100000000111111111111110000001110100001111111000011100000000000011100011000000000000001100010000000000000001110110000000000000000110110000000000000000110110000000000000000110110000000000000000110110000000000000000110111000000000000000111011000000000000011111011110000000000111101001111000000001111001000111111111111110000000001111111111000000000000111111110000000',
'R'=>'111111111111111111110111111111111111111110111111111111111111110110000000110000000000110000000110000000000110000000110000000000110000000110000000000110000001111100000000111001011101111000000111111111001111110000011111111000011110000001110110000000111100000000000000000001110000000000000000001110000000000000000000010',
'S'=>'000111000000000001000001111110000000001100011111111000000001100011000111100000000110110000011110000000110110000001110000000110110000001110000000110110000000111000000110110000000011100011100111000000011111111100011000000001111111000000000000001111100000',
'T'=>'110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000111111111111111111110111111111111111111110111111111111111111110110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000',
'T '=>'110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000111111111111111111110111111111111111111110111111111111111111110110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000',//vt时t左边会被侵占掉一列
'U'=>'111111111111111110000111111111111111110000111111111111111111100000000000000000001100000000000000000001110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000000110000000000000000001100000000000000000111100111111111111111111000111111111111111000000',
'V'=>'111100000000000000000111111000000000000000111111111000000000000000001111110000000000000000111111100000000000000000111111110000000000000001111111000000000000000001111110000000000000000011110000000000000001111110000000000010111101000000000000111110000000000001011111000000000000111111000000000000001110100000000000000111100000000000000000',//少读一列
'W'=>'111111000000000000000111111111000000000000111111111110000000000000000111111111110000000000001111111110000000000000001111111110000000000000000111110000000000000011111110000000001111111001000000011111111100000000011111110000000000000111111000000000000000111111000000000000000111111111110000000000000000111111111110000000000011111111111000000000000001111111110000000000000000111110000000000000011111110000000001111111001000000011111111100000000001111111000000000000111110100000000000000',
'X'=>'000000000000000000010110000000000000000110111100000000000011100111111000000000111000001111000000001100000000011110000011000000000000111110110000000000000111111100000000000000001111000000000000000001111100000000000001111001111000000000011110001111110000000111100000011110000001110000000000111100011100000000000001110110000000000000001110100000000000000000010',
'Y'=>'110000000000000000000111100000000000000000111111000000000000000001111000000000000000000011111000000000000000000111110000000000000000111111111111110000000000111111111110000000001111111111110000000011100000000000000001111000000000000000111100000000000000001110000000000000000011100000000000000000110000000000000000000100000000000000000000',
'Z'=>'000000000000000000110110000000000000011110110000000000001111110110000000000011111110110000000000111100110110000000011110000110110000000111100000110110000011111000000110110001111100000000110110011111000000000110110111100000000000110111110000000000000110111100000000000000110111000000000000000110',
'0'=>'000001011110100000000000111111111111110000001111111101111110000011100000000000011100011000000000000001100110000000000000001110110000000000000000110110000000000000000110110000000000000000110111000000000000011100011111000000000111100001111111110111111000000011111111111100000000000111111110000000',
'1'=>'001100000000000000110001100000000000000110011000000000000000110011000000000000000110011111111111111111110011111111111111111110111111111111111111110000000000000000000110000000000000000000110000000000000000000110000000000000000000110',
'2'=>'000000000000000000110001100000000000111110011000000000000111110011000000000001101110110000000000011000110110000000000111000110110000000001110000110110000000011100000110111000000111000000110111100001111000000110011111111100000000110001111111000000000110000111110000000000110',
'3'=>'011000000000000001100010000000000000001100110000000110000000110110000000110000000110110000000110000000110110000000110000000110110000001110000000110111000011011000001110111111111011000011100011111110001111111100001110100001111111000000000000000111101000',
'4'=>'000000000000110000000000000000011110000000000000000111110000000000000001100110000000000001111000110000000000011110000110000000000111100000110000000001110000000110000000011100000000110000000111111111111111111110111111111111111111110111111111111111111110000000000000110000000000000000000110000000000000000000110000000',
'5'=>'111111111000000001100111111111000000001110110000011000000000110110000011000000000110110000011000000000110110000011000000000110110000001100000000110110000001110000001110110000001110000111100110000000111111111100110000000011111111000110000000001111100000',
'6'=>'000001011110111000000000011111111111110000001111111111111111000001110100101000011100011000001100000001100011000001000000001110110000011000000000110110000011000000000110110000011000000000110110000011100000000110110000011110000011100111000001111111111100011000000111111111000000000000001111000000',
'7'=>'110000000000000000000110000000000000000010110000000000000111110110000000000011111110110000000000111111100110000000011111000000110000001111100000000110000011101000000000110001111000000000000110111110000000000000111110000000000000000111100000000000000000111000000000000000000',
'8'=>'000000000000011110000000111000000111111000001111110011111111100011111111111100001100011000111111000001110110000011100000000110110000011110000000110110000001110000000110110000001111000000110111001011111000000110111111110011100011100011111110001111111100001110100001111111000000000000000111100000',
'9'=>'000011111100000000000001111111110000001100001111111110000001100011100000111000000110111000000011100000110110000000001100000110110000000001100000110110000000001100000110110000000001100001100111000000011000011100011111000111001111000001111111111111111000000111111111111000000000000111111110000000',
);

$arr = fixImg("https://xxxxxxxxxx");// 哦，这里隐去某社区域名和验证码地址，为了支持https，你的php环境要开启openssl
for($i = 0;$i < 10;$i++)
	unset($arr[$i]);// 前10行是空白

$y = 0;// 采用从上到下，从左到右顺序读特征码，从第0行开始（实际是第10行）
$len = 31;// 多读一行，JQ超过20行，且J后面几行占了上个字符的位置
$code = array();// 分离出来的字符特征码
$str = '';

while($y < count($arr[10])){
	$flag = true;// 全0是空白竖线
	$line = '';
	for($i = 10;$i < $len;$i++){
		if($arr[$i][$y])
			$flag = false;
		$line .= $arr[$i][$y];
	}
	$isw = false;
	$isy = false;
	// 对vw的特殊处理
	if($str === $char['V'] || $str === $char['W']){
		$flag = true;
		$isw = true;
	}elseif($str === $char['Y'] || $str === $char['A']){
		$isy = true;
		$flag = true;
	}

	if($flag){
		if(strlen($str) > 21)
			$code[] = $str;
		$str = '';
	}else{
		$str .= $line;
	}
	if($isw){
		$str = '00'.substr($line,2,strlen($line));
		if($str === '000000000000000000000')
			$str = '';
		$isw = false;
	}
	if($isy){
		$str = $line;
		if($str === '000000000000000000000')
			$str = '';
		$isy = false;
	}
	$y++;

}

// 输出字符
foreach($code as $v){
	$match = false;
	foreach($char as $key => $v2){
		if($v === $v2){
			echo $key;
			$match = true;
		}
	}
	if(!$match)
		echo '?';// 没匹配到的字符输出问号
}
?>