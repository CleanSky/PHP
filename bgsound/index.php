<?php
	srand((double)microtime()*1000000);
	$rand_number= rand() % 11;
	echo "���ܲµ����׸���ʲô�����𣿲�֪����ˢ���������׸�ɣ�";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>����������㻻</title>
	</head>

	<body>
		<bgsound src="sound/<?php echo $rand_number;?>.mid" loop="-1">
		<input type="button" value="������������" onclick="window.parent.location.reload()">
	</body>
</html>
