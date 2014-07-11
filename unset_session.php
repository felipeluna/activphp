<?php
	session_start();
		unset($_SESSION['idusuarios']);
	session_destroy();

	if(!isset($_SESSION['idusuarios'])){
		header("Location: index.php");
		exit();
	}else{
		header("Location: dashboard.php");
		exit();
	}
?>
