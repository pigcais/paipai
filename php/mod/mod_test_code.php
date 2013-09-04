<?php 
	session_start();
	header('content-type:image/png');
	$im=imagecreate(60,20);
	$bgcolor=imagecolorallocate($im,245,239,250);
	imagefill($im,0,0,$bgcolor);
	
	$op=array('+');
	
	$codes='=';
	
	for($i=0;$i<40;$i++)
	{
	 $color=imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
	 imagesetpixel($im,rand(0,50),rand(0,20),$color);
	}
	
	$fontcolor=imagecolorallocate($im,rand(0,160),rand(0,160),rand(0,160));
	
	$op1=$_SESSION['op1'];
	$codes.=$op1;
	$operation=$op[rand(0,0)];
	$codes.=$operation;
	$op2=$_SESSION['op2'];
	$codes.=$op2;
	
	imagestring($im,5,5,rand(2,4),$codes,$fontcolor);
	
	imagepng($im);
	imagedestroy($im);
?>