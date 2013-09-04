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
	
	//��֤�׶η���ҳ��js��δʵ�֣�
	
	$sql = "select queue_user.*, business.name as business_name, queue_merchant.state, queue_merchant.current_serve
			from queue_user, business, queue_merchant
			where queue_user.business_id = business.id
			and queue_user.business_id = queue_merchant.business_id
			and queue_user.uid = $uid
			";
	
	$result = mysql_query($sql);
	// if(!empty($result)){
		// $result['result'] = 'success';
	// }else{
		// $result['result'] = 'fail';
	// }
	
	$result = query2json_arr($result);
	echo $result;
	closeConn($link);
?>