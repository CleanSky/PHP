<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>LocalSearch</title>
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
			map.centerAndZoom(point, 11);
			
			//本地搜索
			//var local1 = new BMap.LocalSearch(map, {
			//	renderOptions:{map: map}
			//});
			//local1.search("天安门");

			//配置搜索
			//var local2 = new BMap.LocalSearch("北京市", {
			//	renderOptions: {
			//		map: map,
			//		autoViewport: true,
			//		selectFirstResult: false
			//	},
			//		pageCapacity: 8
			//});
			//local2.search("中关村");

			//周边搜索
			//var local3 = new BMap.LocalSearch(map, {
			//	renderOptions:{map: map, autoViewport: true}
			//});
			//local3.searchNearby("小吃", "前门");

			//范围搜索
			//var local4 = new BMap.LocalSearch(map, {
			//	renderOptions:{map: map}
			//});
			//local.searchInBounds("银行", map.getBounds());

			//公交导航
			//var transit = new BMap.TransitRoute(map, {
			//	renderOptions: {map: map}
			//});
			//transit.search("王府井", "西单");

			//驾车导航
			//var driving = new BMap.DrivingRoute(map, {   
			// renderOptions: {   
			//   map: map,   
			//   autoViewport: true   
			// }   
			//});   
			//driving.search("中关村", "天安门");  

			//地理编码
			// 创建地址解析器实例   
			var myGeo = new BMap.Geocoder();   
			// 将地址解析结果显示在地图上，并调整地图视野   
			//myGeo.getPoint("北京市海淀区上地10街10号", //function(point){
			//	if (point) {
			//		map.centerAndZoom(point, 16);
			//		map.addOverlay(new BMap.Marker(point));
			//	}
			//}, "北京市");

			//根据坐标得到地址描述
			myGeo.getLocation(new BMap.Point(116.364, 39,993), function(result){
				if(result){
					alert(result.address);
				}
			});
		</script>
	</body>
</html>