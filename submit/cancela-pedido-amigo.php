<?php
//id do usuarioq respondera o pedido de amizade
$id_r = $_POST['id'];

require('../config.php');

session_start();
//id do usuarioq solicita o pedido de amizade
$id_s = $_SESSION['idusuario'];

//verificar se ja é amigo
$sql_amizade= mysql_query("select * from amigos
						where
						(idusuario_solicita = $id_s AND
						idusuario_responde = $id_r) AND
						statusconvite = false
						") or die(mysql_error()." erro: check amizade");

	//continua se não forem amigos
	if(mysql_num_rows($sql_amizade)>0){

		//verifica status do convite
		$conviteaceito = mysql_fetch_array($sql_amizade, MYSQL_ASSOC);
		$conviteaceito = $conviteaceito['statusconvite'];	

		if(!$conviteaceito){
		//pega dados do usuario
		$sql_res= mysql_query("delete from amigos
			where
				(idusuario_solicita = $id_s AND
				idusuario_responde = $id_r) OR
				(idusuario_solicita = $id_r AND
				idusuario_responde = $id_s)
			") or die(mysql_error()." erro: fazer amizade");
			echo "amizade.pedidocancelado";
		}else{
			echo "amizade.pedidoaceito";
		}
		
	}else{
		echo "amizade.naoexiste";
	}
?>