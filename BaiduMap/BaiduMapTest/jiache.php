<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/css.css" rel="stylesheet" type="text/css" />
		<title>基于百度地图的驾车导航</title>
		<!--引用百度地图API文件-->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
	</head>

	<body>
		<div id="left">
			<?php include("gongneng.php");?>
		</div>
		<div id="right">
			<div id="right-top">
				<div style="text-align:center;margin-top:15px;font-weight:bold;">
					起点：<input id="qidian" type="text" />&nbsp;&nbsp;&nbsp;
					终点：<input id="zhongdian" type="text" />
					<input type="button" value="搜索" onclick="search()" />
				</div>
			</div>
			<!--创建一个地图容器-->
			<div id="right-bottom"></div>
		</div>
		
		<script type="text/javascript">
			var map = new BMap.Map("right-bottom");//创建地图实例
			var point = new BMap.Point(116.404, 39.915);//创建点坐标
			map.centerAndZoom(point, 11);
			
			//驾车导航
			function search(){
				var txt1 = document.getElementById("qidian");
				var txt2 = document.getElementById("zhongdian");
				var driving = new BMap.DrivingRoute(map, {
					renderOptions: {
						map: map,
						autoViewport: true
					}
				});
				driving.search(txt1.value, txt2.value);
			}
		</script>
	</body>
</html>