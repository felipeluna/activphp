<?php
//id do usuarioq respondera o pedido de amizade
$id_r = $_POST['id'];

require('../config.php');

session_start();
//id do usuarioq solicita o pedido de amizade
$id_s = $_SESSION['idusuario'];

//verificar se atual é amigo q solicitou
$sql_amizade = mysql_query("select * from amigos
						where
						(idusuario_solicita = $id_s AND
						idusuario_responde = $id_r) OR (idusuario_solicita = $id_r AND
						idusuario_responde = $id_s)
						") or die(mysql_error()." erro: check amizade");

 
	//continua se não forem amigos
$amizedeExiste = mysql_num_rows($sql_amizade);
	if($amizedeExiste > 0){

		$conviteaceito = mysql_fetch_array($sql_amizade, MYSQL_ASSOC);
		$conviteaceito = $conviteaceito['statusconvite'];		
		if($conviteaceito){
		//pega dados do usuario
			echo "amizade.desfeita";
			$sql_res= mysql_query("delete into amigos values($id_s, $id_r, false)") or die(mysql_error()." erro: fazer amizade");
		}else{
			echo "amizade.convitependente";
		}

		
	}else{
			echo "amizade.naoexiste";
	}
?>