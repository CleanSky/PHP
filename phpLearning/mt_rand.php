<?php

/*
* mt_rand 是一个比rand更快、更好的随机数字生成器。
* 如果把该随机数字生成器放入函数中，则效果会更好。
* 返回一个1到6之间的随机数
*/

function roll() {
	return mt_rand(1, 6);
}

function roll_side($sides) {
	return mt_rand(1, $sides);
}

echo rand(1, 6)."<br />";
echo roll()."<br />";

echo roll_side(6)."<br />";//roll a six-side die
echo roll_side(10)."<br />";//roll a ten-side die
echo roll_side(20)."<br />";//roll a twenty-side die
?>