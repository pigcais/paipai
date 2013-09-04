<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$name = $_REQUEST['name'];
	$sql = "select uid from user where name = '$name' and invalid=0";

	$result = mysql_fetch_array(mysql_query($sql));
	
	if (empty($result)){
		$response = "ok"; 
	}
	else{
		$response = "no";
	}
	
	closeConn($link);
	
	$json_arr['msg'] = $response;
	$json = array2json($json_arr);
	echo $json;
?>