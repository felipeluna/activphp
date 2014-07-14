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
						idusuario_responde = $id_r) OR
						(idusuario_solicita = $id_r AND
						idusuario_responde = $id_s)
						") or die(mysql_error()." erro: check amizade");

	//continua se não forem amigos
	if(mysql_num_rows($sql_amizade)==0){

		//pega dados do usuario
		$sql_res= mysql_query("insert into amigos values($id_s, $id_r, false)") or die(mysql_error()." erro: fazer amizade");
		echo "amizade.pedidoenviado";
	}else{
		echo "amizade.jaexiste";
	}
?>