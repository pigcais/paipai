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
	
	$merchant_name = $_REQUEST['merchant_name'];
	$business_theme = $_REQUEST['business_theme'];
	$url = $_REQUEST['url'];
	$province = $_REQUEST['province'];
	$city = $_REQUEST['city'];
	$county = $_REQUEST['county'];	
	$contact = $_REQUEST['contact'];
	
	//��ݼ��δʵ��
	
	$sql = "update merchant set mid=$mid, merchant_name='$merchant_name', 
			business_theme='$business_theme', url='$url', 
			province='$province', city='$city', county='$county', contact='$contact'
			where mid='$mid'";
	mysql_query($sql);
	
	$result['result'] = "success";
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>