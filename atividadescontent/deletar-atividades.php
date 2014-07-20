<?php
	if(isset($_POST['id']) == true){
		$idatividade = $_POST['id'];
		require('../config.php');
		mysql_query("DELETE FROM `atividades` WHERE `idatividade` = {$idatividade}");
	}
?>