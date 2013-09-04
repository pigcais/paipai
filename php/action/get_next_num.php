<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$business_id = $_REQUEST['business_id'];

	$sql = "update queue_merchant set current_num=current_num+1 where business_id=$business_id";
	mysql_query($sql);
	
	$result['result'] = "success";
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>