<?php
		function createConn(){
			$host = 'localhost'; //访问mysql 主机IP或者主机名
			$dbuser = 'liufx'; //mysql 用户名
			$dbpassword = '123';//mysql 密码
			$dbname ='paidui'; //数据库名称
			
			$link = mysql_connect($host,$dbuser,$dbpassword);
			
			if($link == NULL){
				echo "cannot link to ".$host;
				return null;
			}
			
			mysql_select_db($dbname,$link);
			//mysql_query('set names utf8',$link);
			return $link;
		}
		
		function closeConn($link){
			if($link == NULL){
				echo "link is null";
				return null;
			}
			
			mysql_close($link);
			return "ok";
		} 
?>
