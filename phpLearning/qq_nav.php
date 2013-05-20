<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>导航</title>
	<style>
	/* reset */
	body, h1, h2, h3, h4, h5, h6, hr, p, blockquote,dl, dt, dd, ul, ol, li, fieldset, form, lengend, button, input, textarea,th, td { margin: 0; padding: 0 }
	body,button, select, textarea { font-family: "宋体","Arial",HELVETICA; font-size:14px; background:#ffffff; -webkit-text-size-adjust:100% }
	h1,h2,h3,h4, h5, h6 { font-size: 100%; font-weight:normal }
	address, cite, dfn, em, var,i { font-style: normal }
	code, kbd, pre, samp, tt { font-family: "Courier New", Courier, monospace }
	small { font-size: 12px }
	ul, ol { list-style: none }
	legend { color: #000 }
	fieldset, img { border: none }
	button, input, select, textarea { font-size: 100%; vertical-align:middle }
	table { border-collapse: collapse; border-spacing:0 }
	img { vertical-align:bottom }
	
	/* clearfix */
	.movielist ul:before,.movielist ul:after,.clearfix:before,.clearfix:after { content:"";display:table } .clearfix:after { clear:both } 
	.movielist ul,.clearfix { zoom:1 }
	
	.ll { float:left } .r { float:right } .pr { position:relative }
	.dis { display:block }
	.undis { display:none }
	textarea { resize:none }
	a:link { outline:none; color: #000; text-decoration: none }
	a:visited { color: #000; text-decoration: none }
	a:hover, a:active { color: #cd0000; text-decoration: underline }
	a:focus{ outline:0 }
	/*全局*/
	body { font:12px/1.75 "宋体","Arial",sans-serif;  background:#fff; color:#000; -webkit-text-size-adjust:100% }
	.user_mod .userName:after,.btbox:after,.hot-read .bd li:after,.hot-comment .bd dl:after,.wb-news-mod .bd dl:after,.love-read dl:after,.essence-mod dl:after,.cf:after { content:""; display:block; clear:both; height:0px; visibility:hidden }
	.user_mod .userName,.btbox,.hot-read .bd li,.hot-comment .bd dl,.wb-news-mod .bd dl,.love-read dl,.essence-mod dl,.cf { *display:inline-block; zoom:1 }
	.ff-t { font-family:Tahoma } .fw-b { font-weight:bold } .f14 { font-size:14px }
	.mar-cf { margin-bottom:0 }
	.mar-b-10 { margin-bottom:10px }
	.mar-b-30 { margin-bottom:23px }
	.mar-b-18 { margin-bottom:11px }
	
	/* layout */
	.body-Article-QQ { width:1000px; margin:0 auto }
	.main { float:left; width:640px }
	.side { float:right; width:300px }
	#top {top:0; width:100%; z-index:100; left:0; margin-bottom:10px;  }
	.topList { width:100%;  height:85px; overflow:hidden }
	.navWrap { height:35px; margin-bottom:10px }
	.nav { width:100%; min-width:1000px; text-align:center; height:35px; background:#379be9; top:0; z-index: 100 }
	
	
	/*主导航 迷你导航*/
	.nav-Article-QQ { padding:0 10px 0 0; line-height:25px; float:left; font-family: Microsoft Yahei; position: relative; z-index:20 }
	.nav-Article-QQ ul { float:left }
	.nav-Article-QQ ul li { float:left; font-size:14px; background:url(http://mat1.gtimg.com/joke/temp/bg_nav_li.png) no-repeat right center }
	.nav-Article-QQ ul li a,.nav-Article-QQ ul li a:visited,.nav-Article-QQ ul li a:link,.nav-Article-QQ ul li a:hover { color:#feffff; text-decoration:none }
	.nav-Article-QQ ul li a { display:block; padding:5px 11px }
	.nav-Article-QQ ul li a:hover { background:#1669AB }
	.colorPd { color:#fff000 }
	.nav-Article-QQ ul .colorPd a,.nav-Article-QQ ul .colorPd a:visited,.nav-Article-QQ ul .colorPd a:link,.nav-Article-QQ ul .colorPd a:hover { color:#fff000 }
	
	.nav-Article-QQ ul .nav-color a,.nav-Article-QQ ul .nav-color a:visited,.nav-Article-QQ ul .nav-color a:link,.nav-Article-QQ ul .nav-color a:hover { color:#FFCC00 }
	 .nav-Article-QQ { outline: none; }
	 #moreNav { position: relative; }
	 #moreNav .moreLink:hover { background:none; }
	 .moreNav1 { display:block; padding-right:10px; background:url( http://mat1.gtimg.com/news/dc/images/icon_down.gif) no-repeat right center; }
	 .moreNav2 { display:block; padding-right:10px; position: relative; background:url( http://mat1.gtimg.com/news/dc/images/icon_up.gif) no-repeat right center; }
	 .navmenu { display:none; position: absolute;  top:35px; background:#379BE9; text-align:left; width:74px; }
	 .navmenu a:hover { background:#1669AB; }
	 .nav-Article-QQ { z-index:20; }
	.nav-color { color:#FFCC00; }
	.nav-Article-QQ ul .nav-color a,.nav-Article-QQ ul .nav-color a:visited,.nav-Article-QQ ul .nav-color a:link,.nav-Article-QQ ul .nav-color a:hover { color:#FFCC00; }
	.nav-Article-QQ ul li a {padding:5px 8px;}
	
	</style>
	
	</head>
	<body>
	
	
	<div class="navWrap">
	
	<div class="nav" id="nav" role="navigation">
	
	<!--nav-Article-QQ航 -->
	<div class="nav-Article-QQ clearfix" accesskey="2" title="" tabindex="-1">
		<ul class="clearfix" bosszone="mainNav">
	         <li bosszone="qqcom"><a href="http://www.toto.cc" target="_blank" title="腾讯网首页" accesskey="1">首页</a></li>
	         <li bosszone="news"><a href="http://news.toto.cc" target="_blank">新闻</a></li>
	         <li bosszone="sports"><a href="http://sports.toto.cc" target="_blank">体育</a></li>
	         <li bosszone="ent"><a href="http://ent.toto.cc" target="_blank">娱乐</a></li>
	         <li bosszone="vqq"><a href="http://v.toto.cc" target="_blank">视频</a></li>
	         <li bosszone="finance"><a href="http://finance.toto.cc" target="_blank">财经</a></li>
	         <li bosszone="stock"><a href="http://finance.toto.cc/stock/" target="_blank">股票</a></li>
	         <li bosszone="auto"><a href="http://auto.toto.cc" target="_blank">汽车</a></li>
	         <li bosszone="house"><a href="http://house.toto.cc" target="_blank">房产</a></li>
	         <li bosszone="tech"><a href="http://tech.toto.cc" target="_blank">科技</a></li>
	         <li bosszone="digi"><a href="http://digi.toto.cc" target="_blank">数码</a></li>
	         <li bosszone="games"><a href="http://games.toto.cc" target="_blank">游戏</a></li>
	         <li bosszone="edu"><a href="http://edu.toto.cc" target="_blank">教育</a></li>
	         <li bosszone="lady"><a href="http://fashion.toto.cc/" target="_blank">时尚</a></li>
	         <li bosszone="cul"><a href="http://cul.toto.cc" target="_blank">文化</a></li>
	         <li bosszone="more" id="moreNav">
					  <a class="moreLink"><span class="moreNav1" id="moreNav1">更多</span></a>
					  <div class="navmenu" id="navmenu" style="display: none;">
						  <a href="http://comic.toto.cc/" target="_blank">动漫</a>
							<a href="http://book.toto.cc/" target="_blank">读书</a>
	<a href="http://kid.toto.cc/" target="_blank">儿童</a> 
							<a href="http://astro.lady.toto.cc/" target="_blank">星座</a> 
							<a href="http://www.toto.cc/map/" target="_blank">全部频道</a>
						</div><!-- /navmenu -->
					 </li>
		</ul>
	</div>
	<script type="text/javascript">
	
			//function ob(a,b){
			var Omore = document.getElementById('moreNav');
			var OList = document.getElementById('navmenu');
			var omoreNav = document.getElementById('moreNav1');
	
	    Omore.onmouseover = function(){ 
			   OList.style.display = 'block';
	       omoreNav.className = 'moreNav2';
			 }
			
			Omore.onmouseout = function() {
			  OList.style.display = 'none';
				omoreNav.className = 'moreNav1';
				 } 
			//}
	
		 // ob('moreNav','navmenu')
	
		</script><!--[if !IE]>|xGv00|c97b2e7cd080b53480dfc354f3470697<![endif]-->
	
	</div><!--[if !IE]>|xGv00|5c7dc86550fb88c83364accb5eb28971<![endif]--> <!--[if !IE]>|xGv00|69ebf639a622390ebcd110695eb11288<![endif]--></div>
	
	</body>
</html>