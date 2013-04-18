<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/css.css" rel="stylesheet" type="text/css" />
		<title>天气预报</title>
		<!--引用百度地图API文件-->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
	</head>

	<body>
		<div id="left">
			<?php include("gongneng.php");?>
		</div>
		<div id="right" style="background:#CCCCCC;border:1px solid blue;width:872px;">
			<div id="right-top" style="text-align:center;">
				<iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://www.tianqi.com/index.php?c=code&id=12&icon=1&num=5"></iframe>
			</div>
			<div id="right-bottom" style="text-align:center;">
				<div style="margin-top: 70px">
					<iframe src="http://flash.weather.com.cn/wmaps/index.swf?url1=http%3A%2F%2Fwww%2Eweather%2Ecom%2Ecn%2Fweather%2F&url2=%2Eshtml&from=cn" width="625" height="457" marginwidth="0" marginheight="0" hspace="0" vspace="0" frameborder="0" scrolling="no"></iframe>
				</div>
			</div>
		</div>
	</body>
</html>