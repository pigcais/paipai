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
	
	$name = $_REQUEST['name'];
	$describe = $_REQUEST['describe'];
	$create_date = @date("Y-m-d H:i:s");

	$sql = "insert into business (mid, name, `describe`, create_date) 
			values ('$mid', '$name', '$describe', '$create_date')";
	mysql_query($sql);
	
	$result['result'] = "success";
	$result['name'] = $name;
	$result['describe'] = $describe;
	$result['id'] = mysql_insert_id($link);
	
	$json = array2json($result);
	
	closeConn($link);
	echo $json;
?>