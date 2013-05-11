<?php
	// mp3, wav 或者其他 media player 支持的格式.
	$file = realpath("1.mp3"); 
	$player= new COM("WMPlayer.OCX");
	$media = $player->newMedia($file);
	$time=$media->duration;   // “单位/秒”
	$h=floor($time/3600);
	$m=floor(($time %3600)/60);
	$s=floor($time-$h*3600-$m*60);
	echo $h."小时".$m."分".$s."秒";
?>