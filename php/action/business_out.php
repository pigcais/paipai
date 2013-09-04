<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();
	
	$user_loc = $_REQUEST['user_loc'];
	$business_id = $_REQUEST['business_id'];
	
	$sql = "delete from queue_user
			where current_num = $user_loc
			and business_id = $business_id";
			
	if( mysql_query($sql) ){
		$response['result'] = 'success';
		$response['msg'] = "退出成功";
	}else{
		$response['result'] = 'fail';
		$response['msg'] = "退出失败";
	}
	//更新queue_merchant的empty_num(这个待定)
	
	closeConn($link);
	echo array2json($response);
?>











