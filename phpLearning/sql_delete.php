<?php
//批量操作数据库表，修改表名，删除表！
	mysql_connect('localhost','root','123456'); 
	mysql_select_db('china');  
        $rs=mysql_query('show tables'); 


	while($arr=mysql_fetch_array($rs)){     
		$tf=strpos($arr[0],'main_');  
		$newt=explode('main_',$arr[0]);
		
		if($tf===0){    
			//修改表名
			$ft=mysql_query("rename table $arr[0] to $newt[1]");     
			
			//删除表
			//$sql = 'drop table zt_'.$newt[1];
			//$ft=mysql_query($sql);  

			
			if($ft){           
				echo "$arr[0] 修改成功 $newt[1]<br>";     
				//echo "$arr[0] 删除成功 $newt[1]<br>";     				
			}        
		}  

	}
?>