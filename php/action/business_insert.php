<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	session_start();
	$link = createConn();
	
	$business_id = $_REQUEST['business_id'];
	$json = "";
	
	$sql = "select mid, current_num, current_serve from queue_merchant 
			where business_id = $business_id
			and state = 1";
	$result = mysql_query($sql);
	
	if($result){
		$result = mysql_fetch_array($result);
		
		$current_serve = $result['current_serve'];
		$current_num = ++$result['current_num'];
		$old_length = $result['current_num'] - $result['current_serve'];
		$mid = $result['mid'];
		
		//接受手机端请求
		if( !empty($_REQUEST['uid']) ){
			$uid = $_REQUEST['uid'];
		}else{
			if(isset($_SESSION['uid']))	
				$uid = $_SESSION['uid'];
		}
		
		$sql = "update queue_merchant set current_num = $current_num
				where business_id = $business_id";
		mysql_query($sql);
		
		if(empty($uid)){
			$sql = "insert into queue_user (current_num, mid, business_id, old_length)
				values ($current_num, $mid, $business_id, $old_length)";
		}else{
			$sql = "insert into queue_user (uid, current_num, mid, business_id, old_length)
				values ($uid, $current_num, $mid, $business_id, $old_length) ";
		}
		mysql_query($sql);
		
		$arr_json['result'] = "success";
		$arr_json['current_serve'] = $current_serve;
		$arr_json['current_num'] = $current_num;
		$json = array2json($arr_json);
	}else{
		$arr_json['result'] = "fail";
		$arr_json['state'] = "0";
		$json = array2json($arr_json);
	}
	
	closeConn($link);
	echo $json;
?>