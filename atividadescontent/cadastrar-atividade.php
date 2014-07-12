<?php
	
	session_start();

	require('../config.php');
	$idusuario = $_SESSION['idusuario'];

	if(isset($_POST['submit_atividade']) && !empty($_POST)){
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$endereco = $_POST['endereco'];
		$dataInicio = $_POST['data'];
		$hora = $_POST['hora'];
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
		

		if($visibilidade == 'public'){
			$visibilidade = 1;
		}else{
			$visibilidade = 0;
		}

		$dataInicio .= " ".$hora;
		// echo "data+hora: ".$dataInicio;

		// STR_TO_DATE('5/15/2012 8:06:26', '%c/%e/%Y %r')
		mysql_query("INSERT INTO `atividades` VALUES
			('',
				'{$titulo}',
				'{$descricao}',
				 -- concat('{$dataInicio}',' ','{$hora}') as date,
				str_to_date('{$dataInicio}', '%d/%m/%Y %T' ),
				time('{$duracao}'),
				'{$endereco}',
				'3999.0',
				'8888.0',
				{$visibilidade},
				'{$idusuario}',
				'{$idinteresse}');") or die(mysql_error());	

		echo "cheque seu db";		
	}


?>