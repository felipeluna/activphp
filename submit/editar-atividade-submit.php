<?php

	require('../config.php');

	if(isset($_POST) && !empty($_POST)){
		$titulo = $_POST['titulo'];
		$descricao = $_POST['descricao'];
		$endereco = $_POST['endereco'];
		$dataInicio = $_POST['data'];
		$hora = $_POST['hora'];
		$duracao = $_POST['duracao'];
		$lat = $_POST['lat'];
		$lng = $_POST['lng'];
		$id = $_POST['idatividade'];
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
			mysql_query("UPDATE `atividades` SET 
			    `titulo`='{$titulo}',
			    `descricao`='{$descricao}',
			    `datahora_inicio`= str_to_date('{$dataInicio}', '%d/%m/%Y %T' ),
			    `duracao`= time('{$duracao}'),
			    `endereco`='{$endereco}',
			    `latitude`='{$lat}',
			    `longitude`='{$lng}',
			    `visibilidade`='{$visibilidade}',
			    `idinteresse`='{$idinteresse}' WHERE idatividade = '{$id}'") or die(mysql_error());
	}
?>
