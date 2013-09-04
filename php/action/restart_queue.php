<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	$link = createConn();

	$business_id = $_REQUEST['business_id'];

	$json;
	//判断队列是否为空
	$sql = "select current_serve, current_num from queue_merchant where business_id=$business_id";
	$result = mysql_fetch_array(mysql_query($sql), MYSQL_ASSOC);
	
	if($result['current_serve'] == ($result['current_num'] -1)){
		//当前服务为已发送的最大号，即为空，可以重置
		$sql = "update queue_merchant set current_serve=0, current_num=0 where business_id=$business_id";
		mysql_query($sql);
		$json['msg'] = "重置成功";
		$json['result'] = "success";
	}else{
		$json['msg'] = "队列尚有用户排队";	
		$json['result'] = "fail";	
	}
	
	$json = array2json($json);
	
	closeConn($link);
	echo $json;
?>