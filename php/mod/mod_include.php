<?php 
	include 'api/DateBaseAPI.php';
	include 'mod/mod_style_sheet.php';
	
	@session_start();
	//验证码操作数生成，由于每个页面都应能注册，所以都应该有验证码生成，为了解决参数传递问题
	$op1=rand(1,10);
	$op2=rand(1,10);
	$_SESSION['op1'] = $op1;
	$_SESSION['op2'] = $op2;
?>