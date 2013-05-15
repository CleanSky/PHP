<?php
//PHP 对 MySQL 数据库进行备份
//该代码连接到MySQL数据库，将products数据库的结构和数据copy到另外一个数据库
      mysql_connect('localhost', 'test', '123456');
      mysql_select_db('test');
      if(copy_table('products', 'products_bak')) {
	echo "success\n";
      }
      else {
	echo "failure\n";
      }

      function copy_table($from, $to) {
	if(table_exists($to)) {
	  $success = false;
	}
	else {
	  mysql_query("CREATE TABLE $to LIKE $from");
	  mysql_query("INSERT INTO $to SELECT * FROM $from");
	  $success = true;
        }
        return $success;
      }

      function table_exists($tablename, $database = false) {
	if(!$database) {
	  $res = mysql_query("SELECT DATABASE()");
          $database = mysql_result($res, 0);
        }
        $res = mysql_query("
           SELECT COUNT(*) AS count
           FROM information_schema.tables
           WHERE table_schema = '$database'
           AND table_name = '$tablename'
        ");
        return mysql_result($res, 0) == 1;
      }
?>