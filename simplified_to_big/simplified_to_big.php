<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>简繁转换</title>
	</head>

	<body>
		<?php
			include("convert.php"); 
			function language($str){ 
				return zhconversion_tw($str);//转换为台湾正体 
			} 
			ob_start('language'); 
		?> 
		中国大陆，简体！<br />
		中国台湾，繁体！<br />
		插件牛逼，插件威武！<br />
		为什么？我叫邹炳松，请问您怎么称呼？<br />
		<?php
			ob_end_flush(); 
		?> 
	</body>
</html>