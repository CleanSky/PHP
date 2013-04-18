<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Layer</title>
		<style type="text/css">
			html{height: 100%}
			body{height: 100%; margin:0px; padding: 0px}
			#container{height: 100%}
		</style>
		<!--引用百度地图API文件-->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.3"></script>
	</head>

	<body>
		<!--创建一个地图容器-->
		<div id="container"></div>
		<script type="text/javascript">
			var map = new BMap.Map("container");//创建地图实例
			var point = new BMap.Point(116.404, 39.915);//创建点坐标
			map.centerAndZoom(point, 15);//初始化地图，设置中心点坐标和地图级别

			var traffic = new BMap.TrafficLayer();//创建交通流量图层实例
			map.addTileLayer(traffic);//将图层添加到地图上
		</script>
	</body>
</html>