<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$sql = "select * from merchant where invalid = 0";
	$result = mysql_query($sql);
	$merchant_arr;
	while (($row = mysql_fetch_array($result, MYSQL_ASSOC)) != NULL){
		$merchant_arr[$row['mid']] = $row;
	}
	$sql = "select distinct mid 
			from queue_merchant 
			where state=1
			";
	$result = mysql_query($sql);
	while (($row = mysql_fetch_array($result, MYSQL_ASSOC)) != NULL){
		if(array_key_exists($row['mid'], $merchant_arr)){
			$merchant_arr[$row['mid']]['state'] = 1;
		}
	}
	closeConn($link);
	
	echo array2json_arr($merchant_arr);
?>