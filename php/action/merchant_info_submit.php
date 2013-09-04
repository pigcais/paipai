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
	
	$sql = "insert into merchant (mid, merchant_name, business_theme, url, province, city, county, contact) 
			values('$mid', '$merchant_name', '$business_theme', '$url', '$province', '$city', '$county', '$contact')";
	mysql_query($sql);
	
	$_SESSION['merchant'] = true;
	
	if($_SESSION['merchant']){
		$merchant = 1;
	}else{
		$merchant = 0;
	}
	
	$result['result'] = "success";
	$result['merchant'] = $merchant;
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>