<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	//接受手机端请求
	if( !empty($_REQUEST['uid']) ){
		$uid = $_REQUEST['uid'];
	}else{
		$uid = $_SESSION['uid'];
	}
	
	$pwd = $_REQUEST['pwd'];
	$confirm = $_REQUEST['confirm'];
	$gender = $_REQUEST['gender'];
	$mail = $_REQUEST['mail'];
	$address = $_REQUEST['address'];
	$phone = $_REQUEST['phone'];	
	$qq = $_REQUEST['qq'];
	
	//��֤�׶η���ҳ��js��δʵ�֣�
	
	$sql = "update user set pwd='$pwd', gender='$gender', mail='$mail', address='$address', 
			phone='$phone', qq='$qq' where uid=$uid";
	mysql_query($sql);
	
	$result['result'] = "success";
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>