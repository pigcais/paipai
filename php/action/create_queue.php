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
	};
	
	$business_id = $_REQUEST['business_id'];
	$result;
	//判断是否已创建
	$sql = "select business_id from queue_merchant where business_id=$business_id";
	$tmp = mysql_fetch_array(mysql_query($sql));
	
	if($tmp == NULL){
		$sql = "insert into queue_merchant (mid, business_id) values ('$mid', '$business_id')";
		mysql_query($sql);
		
		$sql = "select name from business where id=$business_id";
		$result = mysql_fetch_array(mysql_query($sql));
		
		$result['result'] = "success";
		$result['business_id'] = $business_id;
	}else{
		$result['result'] = "fail";
		$result['msg'] = "该队列已存在";
	}
	
	
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>