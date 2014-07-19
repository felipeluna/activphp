<?php
//id do usuarioq respondera o pedido de amizade
$id_r = $_POST['id'];

require('../config.php');

session_start();
//id do usuarioq solicita o pedido de amizade
$id_s = $_SESSION['idusuario'];

//verificar se atual é amigo q solicitou
$sql_amizade = mysql_query("SELECT * FROM amigos
						where
						(idusuario_solicita = $id_s AND 
						idusuario_responde = $id_r) OR 
						(idusuario_solicita = $id_r AND 
						idusuario_responde = $id_s)
						") or die(mysql_error()." erro: check amizade");

 
	//continua se não forem amigos
$amizedeExiste = mysql_num_rows($sql_amizade);
	if($amizedeExiste > 0){

		$conviteaceito = mysql_fetch_array($sql_amizade, MYSQL_ASSOC);
		$conviteaceito = $conviteaceito['statusconvite'];		
		if($conviteaceito){
		//pega dados do usuario
			$sql_res= mysql_query("DELETE FROM amigos WHERE
						(idusuario_solicita = $id_s AND 
						idusuario_responde = $id_r) OR 
						(idusuario_solicita = $id_r AND 
						idusuario_responde = $id_s) AND 
						 statusconvite = true
				") or die(mysql_error()." erro: desfazer amizade");
			echo "amizade.desfeita";
		}else{
			echo "amizade.convitependente";
		}

		
	}else{
			echo "amizade.naoexiste";
	}
?>