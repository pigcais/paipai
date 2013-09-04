<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();

	$business_id = $_REQUEST['business_id'];
	$user_loc = $_REQUEST['user_loc'];
	
	$sql = "select state, queue_merchant.current_num, current_serve, old_length
			from queue_merchant, queue_user
			where queue_merchant.business_id = $business_id
			and queue_user.business_id = $business_id
			and queue_user.current_num = $user_loc";
	
	$result = mysql_fetch_array(mysql_query($sql));
	
	$json_arr['msg'] = "success";
	$json_arr['state'] = $result['state'];
	$json_arr['current_num'] = $result['current_num'];
	$json_arr['old_length'] = $result['old_length'];
	$json_arr['current_serve'] = $result['current_serve'];
	
	closeConn($link);
	
	echo array2json($json_arr);
?>