
<script type="text/javascript" src="scripts/jquery.mask.min.js"></script>
<script type="text/javascript" src="scripts/general.js"></script>
<script type="text/javascript" src="scripts/criar-atividade.js"></script>
<script type="text/javascript" src="scripts/busca-endereco.js"></script>


	<form action="" name="criar-atividade-form" method="post">
		<label for="nome-atividade">Título da Atividade:</label></br>
		<input type="text" name="titulo" placeholder="Nome de sua atividade" id="id-atividade"/>
		<br>
		<label for="descricao-atividade">Descrição:</label></br>
		<!-- <input cols="30" rows="7" name="descricao" placeholder="Descreva sua atividade" id="id-descricao-atividade"/> -->
		<textarea cols="30" rows="7" name="descricao" placeholder="Descreva sua atividade" id="id-descricao-atividade"/>
		<br>
		<label for="endereco">Endereço:</label>
		<input type="text" name="endereco" placeholder="Digite o Endereço" id="id-endereco-atividade"/>
		<br>
		<div id="map-canvas"></div>
		<br>
		<label for="data-inicio">Data:</label>
		<input type="text" name="data" placeholder="Data" class="data" />
		<br>
		<label for="hora"/>Hora de inicio:</label>
		<input type="time" id="hora" name="hora" />
		<br>
		<label for="duracao"/>Duração:</label>
		<input type="time" id="duracao" name="duracao" />
		<br>
		<input type="radio" name="visibilidade" id="rbtn_pu" value="public" title="Qualquer usuários pode encontrar esta atividade" >
		<label for="rbtn_pu"> Evento Público</label>
		<br>
		<input type="radio" name="visibilidade" id="rbtn_pr"  value="private" title="Apenas eu e meus convidados podem encontrar esta atividade" >
		<label for="rbtn_pr"> Evento Privado</label>
		<br>
		<br>
			Categoria da atividade:<br>
			<?php
				
				require('../config.php');
				$result = mysql_query(
					"SELECT idinteresse, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));


				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresse = $row['idinteresse'];
					echo "<input type='radio' name='idinteresse'  value ='{$idinteresse}' id='cb{$idinteresse}'>";
					echo "<label for='cb{$idinteresse}'>";
 					echo utf8_encode($row['descricao']);
 					echo "</label> <br />";
				}				
			?>
		<input type="hidden" name="lat" /> 
		<input type="hidden" name="lng" /> 
		<input type="submit" name="submit_atividade" />
	</form>