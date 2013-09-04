<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$business_id = $_REQUEST['business_id'];
	$current_serve = $_REQUEST['current_serve'];
	
	$sql = "update queue_merchant set current_serve=current_serve+1 where business_id=$business_id";
	mysql_query($sql);
	
	$sql = "delete from queue_user where current_num=$current_serve
			and business_id=$business_id";
	
	$result['result'] = "success";
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>