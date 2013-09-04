<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$mid = $_POST['mid'];
	
	$sql = "select queue_merchant.*, business.name as business_name, state
			from queue_merchant, business 
			where queue_merchant.business_id = business.id
			and queue_merchant.mid = $mid";	
	
	$result = mysql_query($sql);
	
	$response = query2json_arr($result);//将数据库查询出来的结果转化为JSON对象
	
	closeConn($link);
	
	echo $response;
?>