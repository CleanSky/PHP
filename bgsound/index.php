<?php
	srand((double)microtime()*1000000);
	$rand_number= rand() % 11;
	echo "您能猜到这首歌是什么歌曲吗？不知道，刷新听听下首歌吧！";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>背景音乐随便换</title>
	</head>

	<body>
		<bgsound src="sound/<?php echo $rand_number;?>.mid" loop="-1">
		<input type="button" value="更换背景音乐" onclick="window.parent.location.reload()">
	</body>
</html>
