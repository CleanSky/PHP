<?php
	set_time_limit(0);//ץȡ����ʱ������

	if($_POST['Submit']=="��ʼץȡ"){
		$URL=$_POST['link'];
		get_pic($URL);
	}

	function get_pic($pic_url) {
		//��ȡͼƬ��������
		$data=CurlGet($pic_url);

		//����������ʽ�õ�ͼƬ����
		$pattern_src1 = '/<img.*?src\=\"(.*\.jpg).*?>/';//ֻƥ��jpg��ʽ��ͼƬ
		$pattern_src2 = '/<img.*?src\=\"(.*\.bmp).*?>/';//ֻƥ��bmp��ʽ��ͼƬ
		$pattern_src3 = '/<img.*?src\=\"(.*\.png).*?>/';//ֻƥ��png��ʽ��ͼƬ
		$pattern_src4 = '/<img.*?src\=\"(.*\.gif).*?>/';//ֻƥ��gif��ʽ��ͼƬ
		$num1 = preg_match_all($pattern_src1, $data, $match_src1);/*int preg_match_all(string pattern,string subject,array matches [int flags])��subject������������																pattern ������������ʽƥ������ݲ�������� flags ָ����˳��ŵ� matches �С�*/
		$num2 = preg_match_all($pattern_src2, $data, $match_src2);
		$num3 = preg_match_all($pattern_src3, $data, $match_src3);
		$num4 = preg_match_all($pattern_src4, $data, $match_src4);
		$arr_src1=$match_src1[1];//���ͼƬ����
		$arr_src2=$match_src2[1];
		$arr_src3=$match_src3[1];
		$arr_src4=$match_src4[1];

		echo '=============================================ץȡ��ʼ=============================================<br />';

	//	get_name1($arr_src1);
	//	get_name1($arr_src2);
	//	get_name1($arr_src3);
	//	get_name1($arr_src4);

		echo "<br /><br /><br />";

		get_name2($arr_src1);
		get_name2($arr_src2);
		get_name2($arr_src3);
		get_name2($arr_src4);
		
		echo '=============================================ץȡ����=============================================<br />';
		return 0;
	}

	/*�õ�ͼƬ���ͣ������䱣�浽����ļ�ͬһĿ¼*/
	function get_name1($pic_arr){
		//ͼƬ��ź�����
		$pattern_type = '/.*\/(.*?)$/';
		
		foreach($pic_arr as $pic_item){//ѭ��ȡ��ÿ��ͼ�ĵ�ַ
			$num = preg_match_all($pattern_type,$pic_item,$match_type);
			//��������ʽ����ͼƬ
			$write_fd = @fopen($match_type[1][0],"wb");/*fopen()�������ļ�����URL,�����ʧ��,����������FALSE.fopen(filename,mode,include_path,context)filename
														���衣�涨Ҫ�򿪵��ļ���URL��mode����,�涨Ҫ�󵽸��ļ�/���ķ������͡�include_path��ѡ�����Ҳ��Ҫ��include_path �м����ļ��Ļ������Խ��ò�����Ϊ1��TRUE,context��ѡ,�涨�ļ�����Ļ�����Context �ǿ����޸�������Ϊ��һ��ѡ�*/
			echo "ͼƬ��ַ��<a href='".$pic_item."' target='_blank'>".$pic_item."</a><br />";
			@fwrite($write_fd, CurlGet($pic_item));
			@fclose($write_fd);
		}
		return 0;
	}

		function get_name2($pic_arr){
		//ͼƬ��ź�����
		$pattern_type = '/.*\/(.*?)$/';
		
		foreach($pic_arr as $pic_item){//ѭ��ȡ��ÿ��ͼ�ĵ�ַ
			$num = preg_match_all($pattern_type,$pic_item,$match_type);
			//��������ʽ����ͼƬ
			$write_fd = @fopen($match_type[1][0],"wb");/*fopen()�������ļ�����URL,�����ʧ��,����������FALSE.fopen(filename,mode,include_path,context)filename
														���衣�涨Ҫ�򿪵��ļ���URL��mode����,�涨Ҫ�󵽸��ļ�/���ķ������͡�include_path��ѡ�����Ҳ��Ҫ��include_path �м����ļ��Ļ������Խ��ò�����Ϊ1��TRUE,context��ѡ,�涨�ļ�����Ļ�����Context �ǿ����޸�������Ϊ��һ��ѡ�*/
			echo "ͼƬ��ַ��<a href='".$_POST['link'].$pic_item."' target='_blank'>".$_POST['link'].$pic_item."</a><br />";
			@fwrite($write_fd, CurlGet($_POST['link'].$pic_item));
			@fclose($write_fd);
		}
		return 0;
	}

	//ץȡ��ҳ����
	function CurlGet($url){	
		$url=str_replace('&amp;','&',$url);/*str_replace()����ʹ��һ���ַ����滻�ַ����е���һЩ�ַ�,str_replace(find,replace,string,count)find�Ǳ����,�涨Ҫ���ҵ�										ֵ.replace�Ǳ����,�涨�滻find�е�ֵ��ֵ.string�Ǳ����,�涨���������ַ���.count�ǿ�ѡ��,һ������,���滻�����м���.*/
		$curl = curl_init();/*curl_init()��ʼ��һ��cURL�Ự,����һ��cURL�������curl_setopt(), curl_exec()��curl_close() ����ʹ�á�*/
		curl_setopt($curl, CURLOPT_URL, $url);/*bool curl_setopt(resource $ch,int $option,mixed $value )Ϊ������cURL�Ự�������һ��ѡ�CURLOPT_URL��Ҫ��ȡ��URL											��ַ��Ҳ������curl_init()���������á�*/
		curl_setopt($curl, CURLOPT_HEADER, false);/*CURLOPT_HEADER����ʱ�Ὣͷ�ļ�����Ϣ��Ϊ�����������*/
		
		//curl_setopt($curl, CURLOPT_REFERER,$url);/*CURLOPT_REFERER��HTTP����ͷ��"Referer: "�����ݡ�*/
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; SeaPort/1.2; Windows NT 5.1; SV1; InfoPath.2)");/*CURLOPT_USERAGENT��HTTP�����а���																																һ��"User-Agent: "ͷ���ַ�����*/
		curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');/*CURLOPT_COOKIEJAR	���ӽ����󱣴�cookie��Ϣ���ļ���*/
		curl_setopt($curl, CURLOPT_COOKIEFILE, 'cookie.txt');/*CURLOPT_COOKIEFILE����cookie���ݵ��ļ���,cookie�ļ��ĸ�ʽ������Netscape��ʽ,����ֻ�Ǵ�HTTPͷ����Ϣ��															���ļ���*/
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);/*CURLOPT_RETURNTRANSFER��curl_exec()��ȡ����Ϣ���ļ�������ʽ���أ�������ֱ�������*/
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 0);/*CURLOPT_FOLLOWLOCATION����ʱ�Ὣ���������������ص�"Location: "����header�еݹ�ķ��ظ���������ʹ��														CURLOPT_MAXREDIRS�����޶��ݹ鷵�ص�������*/
		$values = curl_exec($curl);/*mixed curl_exec ( resource $ch )ִ�и�����cURL�Ự���������Ӧ���ڳ�ʼ��һ��cURL�Ự����ȫ����ѡ������ú󱻵��á�*/
		curl_close($curl);/*void curl_close ( resource $ch )�ر�һ��cURL�Ự�����ͷ�������Դ��cURL���ch Ҳ�ᱻ�ͷš�*/
		return $values;
	}
?>

<html>
	<head>
		<title>��ҳͼƬץȡ</title>
	</head>

	<body>
		<form action="" method="post">
			ҪץȡͼƬ����ַ��<input type="text" id="link" name="link" value="������������ҪץȡͼƬ����ַ" OnClick="this.value=''" size="100" /><br />
			<input type="submit" id="Submit" name="Submit" value="��ʼץȡ" />
		</form>
	</body>
</html>
