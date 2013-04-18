<!DOCTYPE html>
<html>
	<head>
		<!--下一个meta标签有助于页面在移动平台上展示-->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>控制空间位置</title>
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

			var opts1 = {offset: new BMap.Size(150, 15)};//控件位置偏移
			var opts2 = {type: BMAP_NAVIGATION_CONTROL_LARGE};//调整平移缩放地图控件的外观

			map.addControl(new BMap.NavigationControl(opts2));//添加标准地图控件到地图
			map.addControl(new BMap.ScaleControl(opts1));//添加比例尺控件到地图
			map.addControl(new BMap.OverviewMapControl());//添加缩略图控件到地图
			map.addControl(new BMap.MapTypeControl());//地图种类控件
			map.setCurrentCity("北京");//仅当设置城市信息时，MapTypeControl的切换功能才能可用

/*
			//自定义控件
			function ZoomControl(){
				//设置默认停靠位置
				this.defaultAnchor = BMAP_ANCHOR_TOP_LEFT;
				this.defaultOffset = new BMap.Size(150, 15);
			}

			//通过JavaScript的prototype属性继承于BMap.Control
			ZoomControl.prototype = new BMap.Control();

			//自定义控件必须实现initialize方法，并且将控件的DOM元素返回
			//在本方法中建个div元素作为控件的容器，并将其添加到地图容器中
			ZoomControl.prototype.initialize = function(map) {
				//创建一个DOM元素
				var div = document.createElement("div");
				//添加文字说明
				div.appendChild(document.createTextNode("放大2级");
				//设置样式
				div.style.cursor = "pointer";
				div.style.border = "1px solid gray";
				div.style.backgroundColor = "white";
				//绑定事件，点击一次放大两级
				div.onclick = function(e){
					map.zoomTo(map.getZoom() + 2);
				}

				//添加DOM元素到地图中
				map.getContainer().appendChild(div);

				//将DOM元素返回
				return div;
			}

			//创建控件实例
			var myZoomCtrl = new ZoomControl();
			//添加到地图中
			map.addControl(myZoomCtrl);
*/
		</script>
	</body>
</html>