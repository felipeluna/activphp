<?php
	
	session_start();

	require('../config.php');
	$idusuario = $_SESSION['idusuario'];

	if(isset($_POST['submit_atividade']) && !empty($_POST)){
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$endereco = $_POST['endereco'];
		$dataInicio = $_POST['data'];
		$duracao = $_POST['duracao'];
		$idinteresse = $_POST['idinteresse'];
		$visibilidade = $_POST['visibilidade'];
		// echo $nomeAtividade ."<br>";
		// echo $descricaoAtividade ."<br>";
		// echo $idEnderecoAtividade ."<br>";
		// echo $cep ."<br>";
		// echo $dataInicio ."<br>";
		// echo $idusuario ." <br>";
		// echo $atividade;
		// echo $publicasqn;

		mysql_query("INSERT INTO `atividades`VALUES ('','{$titulo}','{$descricao}',str_to_date('{$dataInicio}', '%d/%m/%Y' ),time_format({$duracao}, '%H %I'),'{$idEnderecoAtividade}','3999.0','8888.0','{$visibilidade}','{$idusuario}','{$idinteresse}')");	

		echo "cheque seu db";		
	}


?>