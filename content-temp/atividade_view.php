<?php

$page ='
<!-- CSS -->
	<link href="styles/content-temp.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
	<script src="scripts/content-temp.js" type="text/javascript"></script>
	<script src="scripts/atividade-view.js" type="text/javascript"></script>

<a href="" class="x"></a>';

$id = $_POST['id'];

require('../config.php');

//pega dados do usuario
$sql_res= mysql_query("select * from atividades where idatividade = '$id' order by idatividade") or die(mysql_error());
$row = mysql_fetch_array($sql_res);


//pega categoria
$idinteresse = $row['idinteresse'];
$interesse= mysql_query("select descricao from interesses where idinteresse = '$idinteresse'") or die(mysql_error());
$interesse = mysql_fetch_array($interesse);
$interesse = $interesse['descricao'];

//escreve titulo
$titulo = $row['titulo'];
$descricao = $row['descricao'];
$endereco = $row['endereco'];

$page .= '<h2>Atividade</h2>';
$page .= '<label><strong>Título: </strong></label>';
$page .= '<label>'.$titulo.'</label> <br>';

//escreve categoria com icone
$page .= '<img src="images/icons/atividades/'.$idinteresse.'laranja.png" >';// carregar imagem da categoria
$page .= $interesse.'<br>';

$page .= '<label><strong>Descrição:</strong> </label>';
$page .= '<label>'.$descricao.'</label><br>';
$page .= '<label><strong>Endereço:</strong> </label>';
$page .= '<label>'.$endereco.'</label><br>';


$txtbtn = '';

session_start();
$idusuario = $_SESSION['idusuario'];

$sql_participa =mysql_query("SELECT * from participa WHERE idusuario = {$idusuario} AND idatividade = {$id}") or die(mysql_error());

if(mysql_num_rows($sql_participa) == 0){
	$txtbtn = 'value="Participar desta atividade" class="btn-verde"';
}else{
	$txtbtn = 'value="Cancelar participação nesta atividade" class="btn-vermelho"';
}


$page .= '<form name="participar" action="submit/participa.php" method="post">';
$page .= '<input type="hidden" name="idatividade" value="'.$id.'">';
$page .= '<input type="submit" name="participaratividade_submit"'.$txtbtn.' >';
$page .= '</form>';

echo $page;
?>