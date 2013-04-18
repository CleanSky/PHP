<!DOCTYPE html> 
<html> 
<head> 
<meta charset="utf-8"/> 
<title>异步加载</title> 
<script type="text/javascript"> 
function initialize() { 
var mp = new BMap.Map('map'); 
mp.centerAndZoom(new BMap.Point(121.491, 31.233), 11); 
} 
  
function loadScript() { 
var script = document.createElement("script"); 
script.src  = 
"http://api.map.baidu.com/api?v=1.5&ak=4dcbad31fba11d08a162dd32470505b5&callback=initialize";

document.body.appendChild(script); 
} 
  
window.onload = loadScript; 
</script> 
</head> 
<body> 
<div id="map" style="width:500px;height:320px"></div> 
</body> 
</html> 
