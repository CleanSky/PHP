<?php

class mysql
{

	private $_link;
	
	public function __construct($dbhost,$dbuser,$dbpassword,$dbname,$charset='utf8')
	{
		$this->_link = mysql_connect($dbhost,$dbuser,$dbpassword,true);  /*连接数据库*/
		$this->_link or $this->errmsg('Can\'t connect to MySQL server!');  /*是否连接成功*/
		if ($this->version() > '4.1') {                  /*检查数据库版本*/
			$this->query('set names '.$charset);         /*设置数据库编码*/
		}
		mysql_select_db($dbname,$this->_link) or $this->errmsg('Can\'t select the database!');  /*打开数据库*/
	}

    /*执行数据库操作*/
	public function query($sql)
    {                                                             
		
    	$result = mysql_query($sql,$this->_link);
    	$result or $this->errmsg('Execute sql sentence error!');
    	return $result;
    }

    /*返回根据从结果集取得的行生成的数组*/
	/*MYSQL_BOTH 得到一个同时包含关联和数字索引的数组 (如同 mysql_fetch_array())*/
	/*MYSQL_ASSOC 得到一个同时包含关联和数字索引的数组 (如同 mysql_fetch_assoc())*/
	/*MYSQL_NUM 得到一个同时包含关联和数字索引的数组 (如同 mysql_fetch_row())*/
    public function fetch_array($result,$type = MYSQL_BOTH)    
    {                                                             
    	return mysql_fetch_array($result,$type);   
    }
  
  /*返回根据所取得的行生成的对象*/
    public function fetch_object($result)
    {
    	return mysql_fetch_object($result);
    }

    /*取得前一次 MySQL 操作所影响的记录行数*/
	public function affected_rows()
    {
    	 return mysql_affected_rows($this->_link);
    }

    /* 释放结果内存*/
    public function free_result($result)
    {
    	return mysql_free_result($result); 
    }

    /* 取得结果集中行的数目*/
    public function num_rows($result)
    {
    	return mysql_num_rows($result);
    }


    /* 取得结果集中字段的数目*/
    public function num_fields($result)
    {
    	return mysql_num_fields($result);
    }

    /*取得上一步 INSERT 操作产生的 ID*/
    public function insert_id()
    {
    	return mysql_insert_id($this->_link);
    }

    /* 发出mysql执行错误*/
	private function errmsg($msg)
	{
		$message  = '<strong>A mysql error has occurred!</strong><br />';
		$message .= '<strong>Error Number:</strong>'. mysql_errno($this->_link) .'<br />';
		$message .= '<strong>Error Description:</strong>'. $msg . mysql_error($this->_link) .'<br />';
		$message .= '<strong>Error Time:</strong>'. date('Y-m-d H:i:s');
		exit($message);
	}

	/*返回连接的标识*/
	public function link_id()
	{
		return $this->_link;
	}

	/*返回数据库服务器版本*/
	public function version() {
		return mysql_get_server_info($this->_link);
	}
	
	/*获得客户端真实的IP地址*/
	function getip() {
		if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
			$ip = getenv("HTTP_CLIENT_IP");
		} else
			if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
				$ip = getenv("HTTP_X_FORWARDED_FOR");
			} else
				if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
					$ip = getenv("REMOTE_ADDR");
				} else
					if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
						$ip = $_SERVER['REMOTE_ADDR'];
					} else {
						$ip = "unknown";
					}
		return ($ip);
	}
	
}
?>