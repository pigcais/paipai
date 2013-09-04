<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$id = $_REQUEST['business_id'];	
	
	$sql = "delete from business where id='$id'";
	mysql_query($sql);
	
	$result['result'] = "success";
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>