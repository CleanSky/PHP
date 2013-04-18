<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/css.css" rel="stylesheet" type="text/css" />
		<title>基于百度地图的周边搜索</title>
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
					请输入您要查询的主题：<input id="zhuti" type="text" />&nbsp;&nbsp;&nbsp;请输入中心地点名称：<input id="didian" type="text" />
					<input type="button" value="搜索" onclick="search()" />
				</div>
			</div>
			<!--创建一个地图容器-->
			<div id="right-bottom"></div>
		</div>
		
		<script type="text/javascript">
			var map = new BMap.Map("right-bottom");//创建地图实例
			var point = new BMap.Point(116.404, 39.915);//创建点坐标
			map.centerAndZoom(point, 5);

			//周边搜索
			var local = new BMap.LocalSearch(map, {
				renderOptions:{map: map, autoViewport: true}
			});

			function search(){
				var txt1 = document.getElementById("zhuti");
				var txt2 = document.getElementById("didian");
				local.searchNearby(txt1.value, txt2.value);
			}
		</script>
	</body>
</html>