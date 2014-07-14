<?php

$page ='
<!-- CSS -->
	<link href="styles/search_result.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
	<script src="scripts/search_result.js" type="text/javascript"></script>
	<script src="scripts/add-amigo.js" type="text/javascript"></script>
<a href="" class="x"></a>';

$id = $_POST['id'];

require('../config.php');

//pega dados do usuario
$sql_res= mysql_query("select * from usuarios where idusuario = '$id' order by idusuario") or die(mysql_error());
$row = mysql_fetch_array($sql_res);

$nome = $row['nome'];

$page .= '<img src="images/user_default-35x35.png" >';// carregar foto
$page .= '<label>'.$nome.'</label>';

//pega cidade
$cidade = $row['idcidade'];
$sql_res= mysql_query("select cidade from cidades where idcidade = '$cidade'") or die(mysql_error());
$row = mysql_fetch_array($sql_res);
$cidade = $row['cidade'];

$page .= '<label>'.$cidade.'</label>';

session_start();
//id do usuarioq solicita o pedido de amizade
$id_s = $_SESSION['idusuario'];
// id do usuario q vai responder a amizade
$id_r = $id;

//verificar se ja é amigo
$sql_amizade= mysql_query("select * from amigos
						where
						(idusuario_solicita = $id_s AND
						idusuario_responde = $id_r) OR
						(idusuario_solicita = $id_r AND
						idusuario_responde = $id_s)
						") or die(mysql_error()." erro: check amizade");

if(mysql_num_rows($sql_amizade) == 0){
	$page .= '<form name="add-amigo" method="post">';
	$page .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$page .= '<input type="submit" name="addamigo_submit" value="Enviar convite de amizade">';
	$page .= '</form>';	
}else{
	$conviteaceito = mysql_fetch_array($sql_amizade, MYSQL_ASSOC);
	$conviteaceito = $conviteaceito['statusconvite'];
	if($conviteaceito){
		$page .= '<form name="rmv-amigo" method="post">';
		$page .= '<input type="hidden" name="idamigo" value="'.$id.'">';
		$page .= '<input type="submit" name="rmv-amigo_submit" value="Desfazer amizade">';
		$page .= '</form>';
	}else{
		$page .= '<form name="cancela-pedido-amigo" method="post">';
		$page .= '<input type="hidden" name="idamigo" value="'.$id.'">';
		$page .= '<input type="submit" name="cancela-pedido-amigo_submit" value="Cancelar pedido de amizade">';
		$page .= '</form>';
	}
}



echo $page;
?>