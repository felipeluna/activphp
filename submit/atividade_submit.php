<?php

	session_start();

	require('../config.php');
	$idusuario = $_SESSION['idusuario'];

	if(isset($_POST) && !empty($_POST)){
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$endereco = $_POST['endereco'];
		$dataInicio = $_POST['data'];
		$hora = $_POST['hora'];
		$duracao = $_POST['duracao'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];

		//array para retornar erros dos campos
		$fields = array();

		//atribui valor se exitir varial (radiobutton)
		$idinteresse;
		if(isset($_POST['idinteresse'])){
			$idinteresse = $_POST['idinteresse'];
		}else{
			$fields['idinteresse'] = 'faltou';
			$validated = false;
		}

		//atribui valor se exitir varial (radiobutton)
		$visibilidade;
		if(isset($_POST['visibilidade'])){

			$visibilidade = $_POST['visibilidade'];

			if($visibilidade == 'public'){
				$visibilidade = 1;
			}else{
				$visibilidade = 0;
			}
		}else{
			$fields['visibilidade'] = 'faltou';
			$validated = false;
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
					'{$lat}',
					'{$lng}',
					{$visibilidade},
					'{$idusuario}',
					'{$idinteresse}');") or die(mysql_error());

			$idatividade = mysql_query("SELECT max(idatividade) as id FROM atividades WHERE titulo = '{$titulo}' AND idusuario = '{$idusuario}' ");
			$idatividade = mysql_fetch_array($idatividade);
			$idatividade = $idatividade['id'];
			$sql = mysql_query("INSERT INTO participa VALUES ({$idusuario},{$idatividade})") or die(mysql_error()." ERRO: ao tentar participar de atividade");
	}
?>