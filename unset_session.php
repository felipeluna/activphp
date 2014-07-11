<?php
	session_start();
		unset($_SESSION['idusuario']);
	session_destroy();

	if(!isset($_SESSION['idusuario'])){
		header("Location: index.php");
		exit();
	}else{
		header("Location: dashboard.php");
		exit();
	}
?>
