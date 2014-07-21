<?php

$page ='
<!-- CSS -->
	<link href="styles/content-temp.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
	<script src="scripts/content-temp.js" type="text/javascript"></script>

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



$page .= '<form name="participar">';
$page .= '<input type="hidden" name="idatividade" value="$id">';
$page .= '<input type="submit" name="participaratividade_submit" value="Participar desta atividade" class="btn-verde">';
$page .= '</form>';

echo $page;
?>