<?php
	srand((double)microtime()*1000000);
	$rand_number= rand() % 3;
	switch($rand_number){
		case 0:
			echo "当前播放歌曲：爱我别走<br />";
			echo "歌曲艺术家：周杰伦<br />";
			echo "刷新可以重新随机播放歌曲！！！";
			break;
		case 1:
			echo "当前播放歌曲：彩虹<br />";
			echo "歌曲艺术家：周杰伦<br />";
			echo "刷新可以重新随机播放歌曲！！！";
			break;
		case 2:
			echo "当前播放歌曲：稻香<br />";
			echo "歌曲艺术家：周杰伦<br />";
			echo "刷新可以重新随机播放歌曲！！！";
			break;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>背景音乐随便换</title>
	</head>

	<body>
		<bgsound src="music/<?php echo $rand_number;?>.mp3" loop="-1">
		<input type="button" value="更换背景音乐" onclick="window.parent.location.reload()">
	</body>
</html>
