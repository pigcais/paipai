<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	session_start();
	
	$link = createConn();
	
	//接受手机端请求
	if( !empty($_REQUEST['uid']) ){
		$mid = $_REQUEST['uid'];
	}else{
		$mid = $_SESSION['uid'];
	}
	
	//��֤�׶η���ҳ��js��δʵ�֣�
	
	$sql = "select * from merchant where mid='$mid'";
	$result = mysql_query($sql);
	$result = mysql_fetch_array($result);
	
	$result['result'] = "success";
	$json = array2json($result);
	closeConn($link);
	
	echo $json;
?>