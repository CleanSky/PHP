<?php
	set_time_limit(0);//抓取不受时间限制

	if($_POST['Submit']=="开始抓取"){
		$URL=$_POST['link'];
		get_pic($URL);
	}

	function get_pic($pic_url) {
		//获取图片二进制流
		$data=CurlGet($pic_url);

		//利用正则表达式得到图片链接
		$pattern_src1 = '/<img.*?src\=\"(.*\.jpg).*?>/';//只匹配jpg格式的图片
		$pattern_src2 = '/<img.*?src\=\"(.*\.bmp).*?>/';//只匹配bmp格式的图片
		$pattern_src3 = '/<img.*?src\=\"(.*\.png).*?>/';//只匹配png格式的图片
		$pattern_src4 = '/<img.*?src\=\"(.*\.gif).*?>/';//只匹配gif格式的图片
		$num1 = preg_match_all($pattern_src1, $data, $match_src1);/*int preg_match_all(string pattern,string subject,array matches [int flags])在subject中搜索所有与																pattern 给出的正则表达式匹配的内容并将结果以 flags 指定的顺序放到 matches 中。*/
		$num2 = preg_match_all($pattern_src2, $data, $match_src2);
		$num3 = preg_match_all($pattern_src3, $data, $match_src3);
		$num4 = preg_match_all($pattern_src4, $data, $match_src4);
		$arr_src1=$match_src1[1];//获得图片数组
		$arr_src2=$match_src2[1];
		$arr_src3=$match_src3[1];
		$arr_src4=$match_src4[1];

		echo '=============================================抓取开始=============================================<br />';

	//	get_name1($arr_src1);
	//	get_name1($arr_src2);
	//	get_name1($arr_src3);
	//	get_name1($arr_src4);

		echo "<br /><br /><br />";

		get_name2($arr_src1);
		get_name2($arr_src2);
		get_name2($arr_src3);
		get_name2($arr_src4);
		
		echo '=============================================抓取结束=============================================<br />';
		return 0;
	}

	/*得到图片类型，并将其保存到与该文件同一目录*/
	function get_name1($pic_arr){
		//图片编号和类型
		$pattern_type = '/.*\/(.*?)$/';
		
		foreach($pic_arr as $pic_item){//循环取出每幅图的地址
			$num = preg_match_all($pattern_type,$pic_item,$match_type);
			//以流的形式保存图片
			$write_fd = @fopen($match_type[1][0],"wb");/*fopen()函数打开文件或者URL,如果打开失败,本函数返回FALSE.fopen(filename,mode,include_path,context)filename
														必需。规定要打开的文件或URL。mode必需,规定要求到该文件/流的访问类型。include_path可选。如果也需要在include_path 中检索文件的话，可以将该参数设为1或TRUE,context可选,规定文件句柄的环境。Context 是可以修改流的行为的一套选项。*/
			echo "图片网址：<a href='".$pic_item."' target='_blank'>".$pic_item."</a><br />";
			@fwrite($write_fd, CurlGet($pic_item));
			@fclose($write_fd);
		}
		return 0;
	}

		function get_name2($pic_arr){
		//图片编号和类型
		$pattern_type = '/.*\/(.*?)$/';
		
		foreach($pic_arr as $pic_item){//循环取出每幅图的地址
			$num = preg_match_all($pattern_type,$pic_item,$match_type);
			//以流的形式保存图片
			$write_fd = @fopen($match_type[1][0],"wb");/*fopen()函数打开文件或者URL,如果打开失败,本函数返回FALSE.fopen(filename,mode,include_path,context)filename
														必需。规定要打开的文件或URL。mode必需,规定要求到该文件/流的访问类型。include_path可选。如果也需要在include_path 中检索文件的话，可以将该参数设为1或TRUE,context可选,规定文件句柄的环境。Context 是可以修改流的行为的一套选项。*/
			echo "图片网址：<a href='".$_POST['link'].$pic_item."' target='_blank'>".$_POST['link'].$pic_item."</a><br />";
			@fwrite($write_fd, CurlGet($_POST['link'].$pic_item));
			@fclose($write_fd);
		}
		return 0;
	}

	//抓取网页内容
	function CurlGet($url){	
		$url=str_replace('&amp;','&',$url);/*str_replace()函数使用一个字符串替换字符串中的另一些字符,str_replace(find,replace,string,count)find是必需的,规定要查找的										值.replace是必需的,规定替换find中的值的值.string是必需的,规定被搜索的字符串.count是可选的,一个变量,对替换数进行计数.*/
		$curl = curl_init();/*curl_init()初始化一个cURL会话,返回一个cURL句柄，供curl_setopt(), curl_exec()和curl_close() 函数使用。*/
		curl_setopt($curl, CURLOPT_URL, $url);/*bool curl_setopt(resource $ch,int $option,mixed $value )为给定的cURL会话句柄设置一个选项。CURLOPT_URL需要获取的URL											地址，也可以在curl_init()函数中设置。*/
		curl_setopt($curl, CURLOPT_HEADER, false);/*CURLOPT_HEADER启用时会将头文件的信息作为数据流输出。*/
		
		//curl_setopt($curl, CURLOPT_REFERER,$url);/*CURLOPT_REFERER在HTTP请求头中"Referer: "的内容。*/
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; SeaPort/1.2; Windows NT 5.1; SV1; InfoPath.2)");/*CURLOPT_USERAGENT在HTTP请求中包含																																一个"User-Agent: "头的字符串。*/
		curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');/*CURLOPT_COOKIEJAR	连接结束后保存cookie信息的文件。*/
		curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');/*CURLOPT_COOKIEFILE包含cookie数据的文件名,cookie文件的格式可以是Netscape格式,或者只是纯HTTP头部信息存															入文件。*/
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);/*CURLOPT_RETURNTRANSFER将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。*/
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);/*CURLOPT_FOLLOWLOCATION启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用														CURLOPT_MAXREDIRS可以限定递归返回的数量。*/
		$values = curl_exec($curl);/*mixed curl_exec ( resource $ch )执行给定的cURL会话。这个函数应该在初始化一个cURL会话并且全部的选项都被设置后被调用。*/
		curl_close($curl);/*void curl_close ( resource $ch )关闭一个cURL会话并且释放所有资源。cURL句柄ch 也会被释放。*/
		return $values;
	}
?>

<html>
	<head>
		<title>网页图片抓取</title>
	</head>

	<body>
		<form action="" method="post">
			要抓取图片的网址：<input type="text" id="link" name="link" value="请在这里输入要抓取图片的网址" OnClick="this.value=''" size="100" /><br />
			<input type="submit" id="Submit" name="Submit" value="开始抓取" />
		</form>
	</body>
</html>
