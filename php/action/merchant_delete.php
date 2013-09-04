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

	//先判断是否还有队列在排队
	$sql = "select mid from queue_merchant where mid='$mid'";
	$result = mysql_fetch_array(mysql_query($sql));
	
	if($result == NULL){
		$sql = "delete from merchant where mid=$mid";
		mysql_query($sql);
		
		$result['result'] = "success";
		$result['msg'] = "success";
		$_SESSION['merchant'] = false;
	}else{
		$result['result'] = "fail";
		$result['msg'] = "尚有队列未删除";
	}
	
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
	
?>