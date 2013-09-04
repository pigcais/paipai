<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$id = $_REQUEST['business_id'];
	$name = $_REQUEST['name'];
	$describe = $_REQUEST['describe'];	
	
	$sql = "update business set name='$name', `describe`='$describe' where id='$id'";
	mysql_query($sql);
	
	$result['result'] = $sql;
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>