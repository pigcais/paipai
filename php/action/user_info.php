<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	session_start();
	
	//接受手机端请求
	if( !empty($_REQUEST['uid']) ){
		$uid = $_REQUEST['uid'];
	}else{
		$uid = $_SESSION['uid'];
	}

	$sql = "select * from user where uid=$uid";
	$result = mysql_query($sql);
	$result = mysql_fetch_array($result, MYSQL_ASSOC);
	
	if(!empty($result)){
		$result['result'] = 'success';
	}else{
		$result['result'] = 'fail';
	}
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>