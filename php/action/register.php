<?php 
	include_once '../api/DateBaseAPI.php';
	include_once '../api/tools.php';
	
	session_start();
	$link = createConn();
	
	$name = $_REQUEST['name'];
	$pwd = $_REQUEST['pwd'];
	$pwd_confirm = $_REQUEST['pwd_confirm'];
//	$pre_test = $_REQUEST['pre_test'];//隐藏的js预查通过----随后实现
	$pre_test = TRUE;
	

	//判断用户名是否已存在
	$sql = "select uid from user where name = '$name' and invalid=0";
	$result = mysql_fetch_array(mysql_query($sql));
	if (empty($result)){
		if($pre_test == TRUE){
			//验证码检查，由于页面部分已经对一般用户进行过滤，此处主要防止机器人直接发送请求，所以验证失败无需任何处理
			$match = '/^[0-9]+$/i';
		 	if($pwd === $pwd_confirm){ 
				//code为纯数字，为了防止"7sa" == 7
				if( isset($_REQUEST['code']) && preg_match($match,$_REQUEST['code']) ){
					$code = $_REQUEST['code'];
					//如果有code变量则说明来自web端进行检查，否则来自手机端则不检查验证码
					if ($code == $_SESSION['op1'] + $_SESSION['op2']){
						$create_date = @date("Y-m-d H:i:s");
						$sql = "insert into user (name, pwd, create_date) values('$name', '$pwd', '$create_date')";
						mysql_query($sql);
						
						$_SESSION['login'] = true;
						$_SESSION['uid'] = mysql_insert_id();
						$_SESSION['name'] = $name;
						if (!empty($result['phone']))
							$_SESSION['code'] = substr($result['phone'], -4, 4);
		
						$response = "注册成功";
					}else{
						$response = "注册失败 验证码错误";
					}
				}else{
						$create_date = @date("Y-m-d H:i:s");
						$sql = "insert into user (name, pwd, create_date) values('$name', '$pwd', '$create_date')";
						mysql_query($sql);
						
						$_SESSION['login'] = true;
						$_SESSION['uid'] = mysql_insert_id();
						$_SESSION['name'] = $name;
						if (!empty($result['phone']))
							$_SESSION['code'] = substr($result['phone'], -4, 4);
		
						$response = "注册成功";
				}
		 	}else{
		 		$response = "注册失败";
		 	} 
		}
	}else{
		$response = "注册失败，用户名已存在";
	}


	
	closeConn($link);
	
	$json_arr['msg'] = $response;
	$json = array2json($json_arr);
	echo $json;
?>