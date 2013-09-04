<?php 
	@session_start();
	if ($_SESSION['login'] == TRUE){
		
		// echo "Session['login']=".$_SESSION['login']."<br/>";

	}else {
		// echo "Session['login']=".$_SESSION['login']."<br/>";
		$url = "../index.php";
		
		echo "<script language='javascript' type='text/javascript'>";
		echo "window.location.href='$url'";
		echo "</script>";
	}
?>