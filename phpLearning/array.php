<?php
/*=============================================================================
# 写一个函数，参数为$n，生成一个数组，其元素为1~$n，各元素位置随机排列，不得重复
=============================================================================*/
function rand_array($n){
	$array=array();
	$rand_array=array();
	for($i=1;$i<=$n;$i++){
		array_push($array,$i);
	}
	//return $array;
	for($i=0;$i<=($n-1);$i++){
		$rand=array_rand($array,1);
		array_push($rand_array,$array[$rand]);
		unset($array[$rand]);
	}
	return $rand_array;
}
var_dump(rand_array(10));
?>