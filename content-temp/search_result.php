<?php

$page ='
<!-- CSS -->
	<link href="styles/search_result.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
	<script src="scripts/search_result.js" type="text/javascript"></script>

<a href="" class="x"></a>';

$id = $_POST['id'];

require('../config.php');

//pega dados do usuario
$sql_res= mysql_query("select * from usuarios where idusuarios = '$id' order by idusuarios") or die(mysql_error());
$row = mysql_fetch_array($sql_res);

$nome = $row['nome'];

$page .= '<img src="images/user_default-35x35.png" >';// carregar foto
$page .= '<label>'.$nome.'</label>';

//pega cidade
$cidade = $row['cidades_idcidades'];
$sql_res= mysql_query("select cidade from cidades where idcidades = '$cidade'") or die(mysql_error());
$row = mysql_fetch_array($sql_res);
$cidade = $row['cidade'];

$page .= '<label>'.$cidade.'</label>';

$page .= '<form name="addamigo">';
$page .= '<input type="hidden" name="idamigo" value="$id">';
$page .= '<input type="submit" name="addamigo_submit" value="Enviar convite de amizade">';
$page .= '</form>';

echo $page;
?>