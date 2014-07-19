


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



$addAmigo = '';
$cancelAmigo = '';
$rmvAmigo = '';
$respAmigo = '';

	//SOLICITANTE
	if(mysql_num_rows($sql_amizade_solicita)>0){

		$conviteaceito = mysql_fetch_array($sql_amizade_solicita, MYSQL_ASSOC);
		$conviteaceito = $conviteaceito['statusconvite'];		

		//add amigo
		$addAmigo .= '<form name="add-amigo" method="post" class="hidden">';
		//responde amizade
		$respAmigo = '<form name="responde-amigo" method="post" class="hidden">';

		if($conviteaceito){
			//convite enviado foi aceito
			$cancelAmigo .= '<form name="cancel-amigo" method="post" class="hidden" >';
			$rmvAmigo .= '<form name="rmv-amigo" method="post" >';
		}else{
			//convite não aceito
			$cancelAmigo .= '<form name="cancel-amigo" method="post">';
			$rmvAmigo .= '<form name="rmv-amigo" method="post" class="hidden" >';
		}

	}elseif( mysql_num_rows($sql_amizade_responde)>0 ){
		//RECEBEU CONVITE

		$conviteaceito = mysql_fetch_array($sql_amizade_responde, MYSQL_ASSOC);
		$conviteaceito = $conviteaceito['statusconvite'];

		//add amigo
		$addAmigo .= '<form name="add-amigo" method="post" class="hidden">';
		$cancelAmigo .= '<form name="cancel-amigo" method="post" class="hidden" >';

		if($conviteaceito){
			//convite enviado foi aceito
			//responde amizade
			$respAmigo = '<form name="responde-amigo" method="post" class="hidden">';
			//desfazr amizade
			$rmvAmigo .= '<form name="rmv-amigo" method="post" >';
		}else{
			//convite não aceito
			//responde amizade
			$respAmigo = '<form name="responde-amigo" method="post" >';
			//desfazr amizade
			$rmvAmigo .= '<form name="rmv-amigo" method="post" class="hidden" >';
		}

	}else{
		//NAO ENVIOU NEM RECEBEU CONVITE

		//solicita amizade
		$addAmigo .= '<form name="add-amigo" method="post">';

		//responde amizade
		$respAmigo = '<form name="responde-amigo" method="post" class="hidden" >';

		//cancel
		$cancelAmigo .= '<form name="cancel-amigo" method="post" class="hidden" >';

		//desfaz amizade
		$rmvAmigo .= '<form name="rmv-amigo" method="post" class="hidden" >';
			
	}

	$addAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$addAmigo .= '<input type="submit" name="add-amigo-submit" value="Enviar convite de amizade" class="btn-verde">';
	$addAmigo .= '</form>';	

	$cancelAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$cancelAmigo .= '<input type="submit" name="cancel-amigo-submit" value="Cancelar convite de amizade" class="btn-vermelho">';
	$cancelAmigo .= '</form>';	

	$rmvAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$rmvAmigo .= '<input type="submit" name="rmv-amigo-submit" value="Desfazer amizade" class="btn-vermelho" >';
	$rmvAmigo .= '</form>';	

	$respAmigo .= '<input type="hidden" name="idamigo" value="'.$id.'">';
	$respAmigo .= '<input type="submit" name="rmv-amigo-submit" value="Aceitar convite de amizade" class="btn-verde">';
	$respAmigo .= '<input type="submit" name="rmv-amigo-submit" value="Rejeitar convite de amizade" class="btn-vermelho">';
	$respAmigo .= '</form>';	

echo $addAmigo;
echo $cancelAmigo;
echo $rmvAmigo;
echo $respAmigo;

?>