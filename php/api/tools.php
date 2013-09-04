<?php 
	//*****网站开发过程中一些辅助的函数*****	

	//将数据库查询结果（相当于多维数组）转化为JSON对象数组
	function query2json_arr($result){
		$json = "[";
		
		while (($row = mysql_fetch_array($result,MYSQL_ASSOC)) != NULL){
			//每个row对应一个json数组中的一个对象，row的每个属性对应一个对象的各个成员变量
			$json .= "{";
			
			foreach ($row as $key => $val){
				$json .= ("\"".$key."\"".":"."\"".$val."\"".",");
			}
			//去掉结尾的 ","
			$json = substr($json, 0, -1);
		
			$json .= "},";
		}
		//去掉结尾的 ","
		$json = substr($json, 0, -1);
		
		$json .="]";
		
		return $json;
	}//end
	
	//将数组转化为JSON对象
	function array2json($json_arr){
		$json = "{";
		foreach ($json_arr as $key => $val){
			$json .= ("\"".$key."\"".":"."\"".$val."\"".",");
		}
		//去掉结尾的 ","
		$json = substr($json, 0, -1);
		
		$json .= "}";
		
		return $json;
	}//end
	
	//将二维数组转化为JSON对象数组
	function array2json_arr($arr_arr){
		$json = "[";
		
		foreach ($arr_arr as $arr){
			$json .= "{";
			
			foreach ($arr as $key => $val){
				$json .= ("\"".$key."\"".":"."\"".$val."\"".",");
			}
			//去掉结尾的 ","
			$json = substr($json, 0, -1);
			
			$json .= "},";
			
		}
		
		//去掉结尾的 ","
		$json = substr($json, 0, -1);
		
		$json .="]";
		
		return $json;
	}//end
?>


















