<?php
	require('../config.php');

	session_start();
	
	$idusuario = $_SESSION['idusuario'];
	$idatividade = $_POST['idatividade'];

	//verifica se usuario ja participa
	$sql_ja_participa = mysql_query("SELECT * FROM participa WHERE idusuario = {$idusuario} AND idatividade = {$idatividade}") or die(mysql_error()." ERRO: ao checar participação de atividade");

	if(mysql_num_rows($sql_ja_participa) == 0){
		$sql = mysql_query("INSERT INTO participa VALUES ({$idusuario},{$idatividade})") or die(mysql_error()." ERRO: ao tentar participar de atividade");
	}else{
		$sql = mysql_query("DELETE FROM participa WHERE idusuario = {$idusuario} AND idatividade = {$idatividade}") or die(mysql_error()." ERRO: ao tentar participar de atividade");		
	}
?>