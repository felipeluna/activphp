<?php
		require('config.php');
	//$usuario = $_SESSION['email'];

//	if($usuario){
		//usuario logado
		if(isset($_POST['name_novo'])){
			// novo
			$idusuario = $_POST['idusuario'];
			$novo_nome = $_POST['name_novo'];
			$usuario_atual = mysql_query("select * from usuarios where idusuario = $idusuario");		
			$row_atual = mysql_fetch_array($usuario_atual);
			// echo $row['nome'] . " " . $row['data_nascimento'];



			$id_atual = $row_atual['idusuario'];
			
			//update nome'
			mysql_query(" update usuarios set nome='$novo_nome' where idusuario = $idusuario");
			
//-----------				//--- teste ---
			// $sqlCommand2 = "SELECT idinteresse FROM usuarios_interesses WHERE usuarios_idusuario='$id_atual'";
			// $query2 = mysql_query( $sqlCommand2) or die (mysql_error());
			// while ($row = mysql_fetch_array($query2)) {
			// 	echo 'entrou';
			//     $selectedinteresses[] = $row['idinteresse'];
			// }   


			// print_r($selectedinteresses);
//-----------			//--- teste ---



	//	---
			// datas

			
				// $ano = mysql_real_escape_string($_POST['ano']);
				// $mes = mysql_real_escape_string($_POST['mes']);
				// $dia = mysql_real_escape_string($_POST['dia']);
			
				$datanova = mysql_real_escape_string($_POST['data']);
				// $datanova = (string)date('d/m/Y', strtotime($datanova));

				mysql_query("update usuarios set data_nascimento=str_to_date('$datanova', '%d/%m/%Y' ) where idusuario = $id_atual ");


				//update cidade e pá.
				mysql_query("update usuarios set idcidade = {$_POST['cidade']} where idusuario = $id_atual");


			//deleta interesses da tabela
			mysql_query("delete from usuarios_interesses where idusuario = $id_atual");
			// //insere de novo.
			foreach($_POST['checkbox_novo'] as $interesse){
				    mysql_query(
							"insert into usuarios_interesses values ((select idusuario from usuarios where idusuario = $id_atual), $interesse)"
							) or die(mysql_error());
			}



		$cidade = mysql_query("select cidade from `cidades` where idcidade = {$_POST['cidade']}") or die (mysql_error());
		$cidade = mysql_fetch_array($cidade);
		$cidade = utf8_encode($cidade['cidade']);
		$info = array ("nome"=>"$novo_nome", "cidade"=>"$cidade");
		echo json_encode($info);
		}
	// }else{
	// 	//usuario nao logado
	// }


?>