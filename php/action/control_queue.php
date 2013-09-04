<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	session_start();
	
	$business_id = $_REQUEST['business_id'];
	$action = $_REQUEST['action'];//stop||start ����������ͣҵ��

	$state = ($action == 'stop'?0:1);
	
	$sql = "update queue_merchant set state=$state where business_id=$business_id";
	mysql_query($sql);
	
	$result['result'] = "success";
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>