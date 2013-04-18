<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Overlay</title>
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

			var marker = new BMap.Marker(point);//创建标注
			map.addOverlay(marker);//将标注添加到地图中
			//监听标注事件
			marker.addEventListener("click", function(){
				alert("您点击了标注!");
			});

			//信息窗口
			var opts = {
				width: 250, //信息窗口宽度
				height: 100, //信息窗口高度
				title: "Hello" //信息窗口标题
			};
			var infoWindow = new BMap.InfoWindow("World", opts);//创建信息窗口对象
			map.openInfoWindow(infoWindow, map.getCenter());//打开信息窗口

			//折线
			var polyline = new BMap.Polyline([
				new BMap.Point(116.399, 39.910),
				new BMap.Point(116.405, 39.920)
			],
			{strokeColors:"green", strokeWeight:6, strokeOpacity:0.5});//两点之间创建6像素宽的蓝色折线
			map.addOverlay(polyline);
		</script>
	</body>
</html>