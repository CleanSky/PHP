<?php
	// mp3, wav �������� media player ֧�ֵĸ�ʽ.
	$file = realpath("1.mp3"); 
	$player= new COM("WMPlayer.OCX");
	$media = $player->newMedia($file);
	$time=$media->duration;   // ����λ/�롱
	$h=floor($time/3600);
	$m=floor(($time %3600)/60);
	$s=floor($time-$h*3600-$m*60);
	echo $h."Сʱ".$m."��".$s."��";
?>