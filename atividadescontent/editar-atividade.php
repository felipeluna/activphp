
<?php
if(isset($_POST['id'])){

$id = $_POST['id'];

require('../config.php');
$sql_res= mysql_query("select * from atividades where idatividade = '$id' order by idatividade") or die(mysql_error());
$row = mysql_fetch_array($sql_res);
//escreve titulo
$titulo = $row['titulo'];
$descricao = $row['descricao'];
$endereco = $row['endereco'];
$datahora_inicio = $row['datahora_inicio'];
$duracao = $row['duracao'];
$latitude = $row['latitude'];
$longitude = $row['longitude'];
$visibilidade = $row['visibilidade'];
$idusuario = $row['idusuario'];
$idinteresse = $row['idinteresse'];
$idatividade = $row['idatividade'];


$ano = (substr($datahora_inicio, 0,4));
$mes = substr((substr($datahora_inicio, 5,7)),0,2);
$dia = substr((substr($datahora_inicio, 8,10)),0,2);
$data_da_atividade = $dia . "/" . $mes . "/" . $ano;
// echo "<br>";

$hora_da_atividade = substr(substr($datahora_inicio,11,16),0,5);
// echo $hora;
// 1992-03-22 12:40:00
// echo "<br>";
$duracao_da_atividade = substr($duracao, 0, 5);
}


?>


<script type="text/javascript" src="scripts/jquery.mask.min.js"></script>
<script type="text/javascript" src="scripts/criar-atividade.js"></script>
<script type="text/javascript" src="scripts/editar-atividade.js"></script>
<script type="text/javascript" src="scripts/busca-endereco.js"></script>

<h1>Editar atividade</h1>

	<form action="submit/editar-atividade-submit.php" name="editar-atividade-form" method="post" id="form-editar-atividade">
		<?php
  			echo "<input type='hidden' value='{$idatividade}' name='idatividade'/>"
  		?>
		<label for="nome-atividade">Título da Atividade:</label></br>
		<?php 
		echo "<input type='text' name='titulo' value='{$titulo}' placeholder='Nome de sua atividade' id='id-atividade'/>";
		?>
		<br>
		<label for="descricao-atividade">Descrição:</label></br>
		<!-- <input cols="30" rows="7" name="descricao" placeholder="Descreva sua atividade" id="id-descricao-atividade"/> -->
		<?php
		echo "<textarea cols='30' rows='7' name='descricao' placeholder='Descreva sua atividade' id='id-descricao-atividade'>{$descricao}</textarea>";
		?>
		<br>
		<label for="endereco">Endereço:</label>
		<?php
		echo "<input type='text' value = '{$endereco}' name='endereco' placeholder='Digite o Endereço' id='id-endereco-atividade'/>";
		?>
		<br>
		<div id="map-canvas"></div>
		<br>
		<label for="data-inicio">Data:</label>
		<?php
		echo "<input type='text' value='{$data_da_atividade}'' name='data' placeholder='Data' class='data' />";
		?>
		<br>
		<label for="hora"/>Hora de inicio:</label>
		<?php
		echo "<input type='time' value='{$hora_da_atividade}' id='hora' name='hora' />";
		?>
		<br>
		<label for="duracao"/>Duração:</label>
		<?php
		echo "<input type='time' id='duracao' value='{$duracao_da_atividade}' name='duracao' />";
		?>
		<br>
		<?php 
		if($visibilidade == 1){
			echo '<input type="radio" checked name="visibilidade" id="rbtn_pu" value="public" title="Qualquer usuários pode encontrar esta atividade" >';
		}else{
			echo '<input type="radio" name="visibilidade" id="rbtn_pu" value="public" title="Qualquer usuários pode encontrar esta atividade" >';

		}
		?>
		<label for="rbtn_pu"> Evento Público</label>
		
		<br>
		<?php
		if($visibilidade == 0){
		echo '<input type="radio" checked name="visibilidade" id="rbtn_pr"  value="private" title="Apenas eu e meus convidados podem encontrar esta atividade" >';

		}else{
		echo '<input type="radio" name="visibilidade" id="rbtn_pr"  value="private" title="Apenas eu e meus convidados podem encontrar esta atividade">';

		}
		?>
		<label for="rbtn_pr"> Evento Privado</label>
		<br>
		<br>
			Categoria da atividade:<br>
			<?php
				
				$result = mysql_query(
					"SELECT idinteresse, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));


				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresse2 = $row['idinteresse'];
					if($idinteresse == $idinteresse2){
					echo "<input type='radio' checked name='idinteresse'  value ='{$idinteresse}' id='cb{$idinteresse}'>";
						
					}else{
					echo "<input type='radio' name='idinteresse'  value ='{$idinteresse}' id='cb{$idinteresse}'>";

					}

					echo "<label for='cb{$idinteresse}'>";
 					echo utf8_encode($row['descricao']);
 					echo "</label> <br />";
				}				
			?>
		<input type="hidden" name="lat" /> 
		<input type="hidden" name="lng" /> 
		<input type="submit" name="submit_atividade" />
	</form>