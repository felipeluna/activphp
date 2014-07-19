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
						idusuario_solicita = $id_r AND
						idusuario_responde = $id_s AND
						statusconvite = false
						") or die(mysql_error()." erro: check amizade");

 
	//continua se não forem amigos
	$conviteExiste = mysql_num_rows($sql_amizade);

	if($conviteExiste > 0){
		mysql_query("DELETE FROM amigos
						where
						idusuario_solicita = $id_r AND
						idusuario_responde = $id_s
						") or die(mysql_error()." erro: aceitar amizade");
		
		echo "amizade.conviterejeitado";
		
	}else{
			echo "amizade.naohaconvite";
	}
?>