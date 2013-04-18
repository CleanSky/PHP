<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Hello, World</title>
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

			window.setTimeout(function(){
				map.panTo(new BMap.Point(116.409, 39.918));
			}, 2000);//两秒后地图移动到新的中心点

			map.addControl(new BMap.NavigationControl());//添加标准地图控件到地图
			map.addControl(new BMap.ScaleControl());//添加比例尺控件到地图
			map.addControl(new BMap.OverviewMapControl());//添加缩略图控件到地图
			map.addControl(new BMap.MapTypeControl());//地图种类控件
			map.setCurrentCity("北京");//仅当设置城市信息时，MapTypeControl的切换功能才能可用
		</script>
	</body>
</html>