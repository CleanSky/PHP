<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link href="css/css.css" rel="stylesheet" type="text/css" />
		<title>基于百度地图按不同策略驾车</title>
		<!--引用百度地图API文件-->
		<script type="text/javascript" src="http://api.map.baidu.com/api?v=1.5&ak=4dcbad31fba11d08a162dd32470505b5"></script>
	</head>

	<body>
		<div id="left">
			<?php include("gongneng.php");?>
		</div>
		<div id="right">
			<div id="right-top">
				<div style="text-align:center;margin-top:15px;font-weight:bold;" onkeydown="if(event.keyCode==13){search()}">
					起点：<input id="qidian" type="text" />
					终点：<input id="zhongdian" type="text" />
					<input id="xianzhi1" name="xianzhi" type="radio" value="0" checked="checked" />最少时间
					<input id="xianzhi2" name="xianzhi" type="radio" value="1" />最短距离
					<input id="xianzhi3" name="xianzhi" type="radio" value="2" />避开高速
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
			
			//驾车导航
			function search(){
				var txt1 = document.getElementById("qidian");
				var txt2 = document.getElementById("zhongdian");
				var xianzhi1 = document.getElementById("xianzhi1");
				var xianzhi2 = document.getElementById("xianzhi2");
				var xianzhi3 = document.getElementById("xianzhi3");
				//三种驾车策略：最少时间，最短距离，避开高速
				var routePolicy = [BMAP_DRIVING_POLICY_LEAST_TIME,BMAP_DRIVING_POLICY_LEAST_DISTANCE,BMAP_DRIVING_POLICY_AVOID_HIGHWAYS];

				if(xianzhi1.checked){
					driving_search(txt1.value,txt2.value,routePolicy[0]); //最少时间
				}else if(xianzhi2.checked){
					driving_search(txt1.value,txt2.value,routePolicy[1]); //最短距离
				}else if(xianzhi3.checked){
					driving_search(txt1.value,txt2.value,routePolicy[2]); //避开高速
				}
			}

			function driving_search(start,end,route){ 
				var driving = new BMap.DrivingRoute(map, {
					renderOptions: {map: map, panel: "right-bottom2"},
					policy: route
				});
				driving.search(start, end);
			}
		</script>
	</body>
</html>
