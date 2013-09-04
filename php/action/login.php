<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	session_start();
	$link = createConn();
	
	$name = $_REQUEST['name'];
	$pwd = $_REQUEST['pwd'];
	//	$pre_test = $_REQUEST['pre_test'];//隐藏的js预查通过----随后实现
	$pre_test = TRUE;
	
	if($pre_test == TRUE){
		$sql = "select uid, name, phone from user where name='$name' and pwd='$pwd' and invalid=0";
		$result = mysql_fetch_array(mysql_query($sql));
		
		if (empty($result)){
			$response = "用户名或密码错误";
			$result = "fail";
		}else{
			$_SESSION['login'] = true;
			$_SESSION['uid'] = $result['uid'];
			$_SESSION['name'] = $result['name'];
			
			//判断该用户是否已为商家
			$uid = $result['uid'];
			$sql = "select mid from merchant where mid='$uid'";
			$result = mysql_fetch_array(mysql_query($sql));
			if(!empty($result)){
				$_SESSION['merchant'] = true;
				$merchant = 1;
			}else{
				$_SESSION['merchant'] = false;
				$merchant = 0;
			}
			//若phone字段不为空，则获取后四位为验证码备用
			if (!empty($result['phone']))
				$_SESSION['code'] = substr($result['phone'], -4, 4);
				
			$response = "登陆成功";
			$result = "success";
		}
	}
	
	closeConn($link);
	
	$json_arr['msg'] = $response;
	$json_arr['result'] = $result;
	
	if( isset($uid) ){
		$json_arr['uid'] = $uid;
		$json_arr['merchant'] = $merchant;
	}
	
	$json = array2json($json_arr);
	echo $json;
?>