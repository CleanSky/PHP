<?php
	srand((double)microtime()*1000000);
	$rand_number= rand() % 3;
	switch($rand_number){
		case 0:
			echo "��ǰ���Ÿ��������ұ���<br />";
			echo "���������ң��ܽ���<br />";
			echo "ˢ�¿�������������Ÿ���������";
			break;
		case 1:
			echo "��ǰ���Ÿ������ʺ�<br />";
			echo "���������ң��ܽ���<br />";
			echo "ˢ�¿�������������Ÿ���������";
			break;
		case 2:
			echo "��ǰ���Ÿ���������<br />";
			echo "���������ң��ܽ���<br />";
			echo "ˢ�¿�������������Ÿ���������";
			break;
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>����������㻻</title>
	</head>

	<body>
		<bgsound src="music/<?php echo $rand_number;?>.mp3" loop="-1">
		<input type="button" value="������������" onclick="window.parent.location.reload()">
	</body>
</html>
