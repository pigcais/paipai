<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	session_start();
	
	//接受手机端请求
	if( !empty($_REQUEST['uid']) ){
		$mid = $_REQUEST['uid'];
	}else{
		$mid = $_SESSION['uid'];
	}

	$sql = "select queue_merchant.*, business.name 
			from queue_merchant, business 
			where business_id=id
			and queue_merchant.mid='$mid'";
	$result = mysql_query($sql);
	
	$json = query2json_arr($result);
	
	closeConn($link);
	echo $json;
?>