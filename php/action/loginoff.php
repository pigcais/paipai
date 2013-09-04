<?php 
	include_once '../api/tools.php';
	
	session_start();
	
	unset($_SESSION['login']);
	
	if(!isset($_SESSION['login'])){
		$json_arr['result'] = "success";
	}else{
		$json_arr['result'] = "fail";
	}
	
	$json = array2json($json_arr);
	echo $json;
?>