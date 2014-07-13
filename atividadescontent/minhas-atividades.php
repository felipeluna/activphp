
	<!-- Minhas atividades -->

		<table id="minhas-atividades">
			<thead>
				<tr>
					<td>Atividade</td>
					<td>Quando e onde</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php

					session_start();
					
					require('../config.php');

					$idusuario = $_SESSION['idusuario'];


					$result = mysql_query("select * from `atividades` where idusuario = {$idusuario}") or die(mysql_error());

					
					while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
						
						$nomeatividade = $row['titulo'];
						$descricao = utf8_encode($row['descricao']);
						$data = utf8_encode($row['datahora_inicio']);

						// $res = $data->format('d/m/Y H:i:s');
						$endereco = $row['endereco'];
						$duracao = utf8_encode($row['duracao']);
						$idinteresse = utf8_encode($row['idinteresse']);
						$visibilidade = utf8_encode($row['visibilidade']);
						$idatividade = $row['idatividade'];

						$cat = mysql_query("select descricao from interesses where idinteresse = {$idinteresse}");
						$cat = mysql_fetch_array($cat);
						$categoria = utf8_encode($cat['descricao']);

						//$categoria = mysql_fetch_array($cat['descricao']);

						$isOwner = true;

						if($visibilidade == 1){
							$isPublic = true;
						}else{
							$isPublic = false;
						}
						//inicio da linha
						echo "<tr id='$idatividade' >";
						//coluna de nome e categoria
						echo "<td class='atividade'>";
						echo "<span class='title'> $nomeatividade </span><br>";
						echo "<img src='images/icons/atividades/{$idinteresse}laranja.png' alt='icon-categoria' />";
						echo "<span>{$categoria}</span>";
						echo "</td>";
						//Coluna de local e hora
						echo "<td class='quando-onde'>";
						echo "<img src='images/local.png' alt='icon-local' />";
						echo "<span>{$endereco}</span><br>";
						echo "<img src='images/relogio.png'  alt='icon-data-hora' />";
						echo "<span>{$data}, com duracao de {$duracao} </span>";
						echo "</td>";
						//coluna de detalhes
						echo "<td class='detalhes'>";
						if($isOwner){
							echo "<img src='images/amigos.png'  alt='icon-ownership' title='Dono da atividade' /><br>";
						}
						if($isPublic){
							echo "<img src='images/public.png'  alt='icon-visibility' title='Atividade pública' />";
						}else{
							echo "<img src='images/private.png'  alt='icon-visibility' title='Atividade pública' />";
						}
						//coluna editar
						echo "</td>";
						echo "<td class='editar'>";
						echo '<a class="editar-atividade" title="Editar atividade">';
						echo '<img src="images/editar.png" />';
						echo '</a">';
						echo "</td>";
						echo "</td>";
						//coluna deletar
						echo "<td class='deletar'>";
						echo '<a class="deletar-atividade" title="Deletar atividade">';
						echo '<img src="images/trash.png" />';
						echo '</a">';
						echo "</td>";
						//fim da linha da tabela
						echo "</tr>";
					}		
				?>
			</tbody>
		</table>