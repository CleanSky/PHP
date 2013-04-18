<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/css.css" rel="stylesheet" type="text/css" />
		<title>基于百度地图按不同策略乘车</title>
		<!--引用百度地图API文件-->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=4dcbad31fba11d08a162dd32470505b5"></script>
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
			<div id="right-bottom">
				<!--创建一个地图容器-->
				<div id="right-bottom1"></div>
				<!--展示结果-->
				<div id="right-bottom2"></div>
			</div>
		</div>
		
		<script type="text/javascript">
			var map = new BMap.Map("right-bottom1");//创建地图实例
			var point = new BMap.Point(126.660017, 45.760348);//创建点坐标
			map.centerAndZoom(point, 12);
			map.addControl(new BMap.NavigationControl());//添加标准地图控件到地图
			map.addControl(new BMap.ScaleControl());//添加比例尺控件到地图
			map.addControl(new BMap.OverviewMapControl());//添加缩略图控件到地图
			map.enableScrollWheelZoom();//启用滚轮放大缩小
			
			//公交导航
			function search(){
				var txt1 = document.getElementById("qidian");
				var txt2 = document.getElementById("zhongdian");
				var transit = new BMap.TransitRoute(map, {
					renderOptions: {map: map,panel:"right-bottom2"},
					policy:BMAP_TRANSIT_POLICY_AVOID_SUBWAYS//不乘地铁
					//BMAP_TRANSIT_POLICY_LEAST_TIME//最少时间
					//BMAP_TRANSIT_POLICY_LEAST_TRANSFER//最少换乘
					//BMAP_TRANSIT_POLICY_LEAST_WALKING//最少步行
					//BMAP_TRANSIT_POLICY_AVOID_SUBWAYS//不乘地铁
				});
				transit.search(txt1.value, txt2.value);
			}
		</script>
	</body>
</html>
