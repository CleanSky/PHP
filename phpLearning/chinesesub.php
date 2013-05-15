<?php
//http://blog.1dnet.net
//$str 待截取的字符串
//$len 截取的字符个数
//$chars 已经截取的字符数
//$res   保存的字符串
//$chars 保存已经截取的字符串个数
//$offset 截取的偏移量
//$length 字符串的字节数
//若$len>$str的字符个数，造成无谓的while循环，($offset<$length限定)
function utf8sub($str,$len){
    if($len<=0){
        return ;
    }
    $res="";
    $offset=0;
    $chars=0;
    $length=strlen($str);
    while($chars<$len && $offset<$length){

        $hign=decbin(ord(substr($str,$offset,1)));
            if(strlen($hign)<8){
                $count=1;
            }elseif(substr($hign,0,3)=="110"){
                $count=2;
            }elseif(substr($hign,0,4)=="1110"){
                $count=3;
            }elseif(substr($hign,0,5)=="11110"){
                $count=4;
            }elseif(substr($hign,0,6)=="111110"){
                $count=5;
            }elseif(substr($hign,0,7)=="1111110"){
                $count=6;
            }

        $res.=substr($str,$offset,$count);
        $offset+=$count;
        $chars+=1;

    }
    return $res;
}
function utf8sub1($str,$len){
    $chars=0;
    $res="";
    $offset=0;
    $length=strlen($str);
    while($chars<$len && $offset<$length){
        $hign=decbin(ord(substr($str,$offset,1)));
        if(strlen($hign)<8){
            $count=1;
        }elseif($hign & "11100000"=="11000000"){
            $count=2;
        }elseif($hign & "11110000"=="11100000"){
            $count=3;
        }elseif($hign & "11111000"=="11110000"){
            $count=4;
        }elseif($hign & "11111100"=="11111000"){
            $count=5;
        }elseif($hign & "11111110"=="11111100"){
            $count=6;
        }
        $res.=substr($str,$offset,$count);
        $chars++;
        $offset+=$count;
    }
    return $res;
}
$a="中华ah人民hdj";
echo utf8sub($a,5);
?>