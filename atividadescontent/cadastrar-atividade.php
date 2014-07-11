<?php
	
	session_start();

	require('../config.php');
	$idusuarios = $_SESSION['idusuarios'];
	if(isset($_POST['submit_atividade']) && !empty($_POST)){
		$nomeAtividade = $_POST['nome-atividade'];
		$descricaoAtividade = $_POST['descricao-atividade'];
		$idEnderecoAtividade = $_POST['endereco'];
		$cep = $_POST['cep'];
		$dataInicio = $_POST['data'];
		$atividade = $_POST['atividade'];
		$publicasqn = $_POST['evento'];
		// echo $nomeAtividade ."<br>";
		// echo $descricaoAtividade ."<br>";
		// echo $idEnderecoAtividade ."<br>";
		// echo $cep ."<br>";
		// echo $dataInicio ."<br>";
		// echo $idusuarios ." <br>";
		// echo $atividade;
		// echo $publicasqn;


		mysql_query("INSERT INTO `atividades`(`idAtividades`, `titulo`, `descricao`, `data_inicio`, `data_fim`, `endereco`, `latitude`, `longitude`, `publica_privada`, `usuarios_idusuarios`, `Interesses_idInteresses`) VALUES ('','{$nomeAtividade}','{$descricaoAtividade}','{$dataInicio}','faltaimplementar','{$idEnderecoAtividade}','falta','falta','{$publicasqn}','{$idusuarios}','{$atividade}')");	

		echo "cheque seu db";
		
	}


?>