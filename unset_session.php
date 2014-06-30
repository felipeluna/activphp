<?php
	session_start();
	unset($_SESSION['email']);

	if(!isset($_SESSION['email'])){
		header("Location: index.php");
		exit();
	}else{
		header("Location: dashboard.php");
		exit();
	}
?>
