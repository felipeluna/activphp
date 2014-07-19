


<!-- CSS -->

<!-- JAVASCRIPT -->
<script src="scripts/add-amigo.js" type="text/javascript"></script>
<a href="" class="x"></a>

<?php
$id = $_POST['id'];

require('../config.php');

//pega dados do usuario
$sql_res= mysql_query("select * from usuarios where idusuario = '$id' order by idusuario") or die(mysql_error());
$row = mysql_fetch_array($sql_res);

$nome = $row['nome'];
?>


<img src="images/user_default-35x35.png" >
<label>
<?php echo $nome ?>
</label>

<?php
//pega cidade
$cidade = $row['idcidade'];
$sql_res= mysql_query("select cidade from cidades where idcidade = '$cidade'") or die(mysql_error());
$row = mysql_fetch_array($sql_res);
$cidade = $row['cidade'];
echo "<label>'{$cidade}'</label>";

session_start();
//id do usuarioq solicita o pedido de amizade
$id_s = $_SESSION['idusuario'];
// id do usuario q vai responder a amizade
$id_r = $id;

//verificar se ja é amigo
$sql_amizade_solicita = mysql_query("select * from amigos
						where
						(idusuario_solicita = $id_s AND
						idusuario_responde = $id_r)
						") or die(mysql_error()." erro: check amizade");

//verificar se atual é amigo q responde
$sql_amizade_responde = mysql_query("select * from amigos
						where
						(idusuario_solicita = $id_r AND
						idusuario_responde = $id_s)
						") or die(mysql_error()." erro: check amizade");

$conviteaceito = mysql_fetch_array($sql_amizade, MYSQL_ASSOC);
$conviteaceito = $conviteaceito['statusconvite'];

$addAmigo = '';
$cancelAmigo = '';
$rmvAmigo = '';

if(mysql_num_rows($sql_amizade) == 0 && !$conviteaceito){
	//add amigo
	$addAmigo .= '<form name="add-amigo" method="post">';

	//cancel amigo
	$cancelAmigo .= '<form name="cancel-amigo" method="post" class="hidden">';

	//rmv amigo
	$rmvAmigo .= '<form name="rmv-amigo" method="post" class="hidden">';

}elseif(mysql_num_rows($sql_amizade) > 0){
	//add amigo
	$addAmigo .= '<form name="add-amigo" method="post" class="hidden">';
	
	if($conviteaceito){
		$rmvAmigo .= '<form name="rmv-amigo" method="post" >';	
		$cancelAmigo .= '<form name="cancel-amigo" method="post" clss="hidden">';		
	}else{
		$rmvAmigo .= '<form name="rmv-amigo" method="post" class="hidden">';
		$cancelAmigo .= '<form name="cancel-amigo" method="post">';	
	}
}

	$addAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$addAmigo .= '<input type="submit" name="add-amigo-submit" value="Enviar convite de amizade">';
	$addAmigo .= '</form>';	

	$cancelAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$cancelAmigo .= '<input type="submit" name="cancel-amigo-submit" value="Cancelar convite de amizade">';
	$cancelAmigo .= '</form>';	

	$rmvAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$rmvAmigo .= '<input type="submit" name="rmv-amigo-submit" value="Desfazer amizade">';
	$rmvAmigo .= '</form>';	

echo $addAmigo;
echo $cancelAmigo;
echo $rmvAmigo;

?>