
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

					$isOwner = true;
					$isPublic = true;
					$nomeatividade = "Pelada do pelé malandro";
					$endereco = "Rua do cara que mora naquela rua lá, 459";
					$data ="dd/mm/yyyy";
					$horainicio = "hh:mm";
					$horafim = "hh:mm";
					$idinteresse = '1';

					echo "<tr>";
					echo "<td class='atividade'>";
					echo "<span class='title'> $nomeatividade </span><br>";
					echo "<img src='images/icons/atividades/{$idinteresse}laranja.png' alt='icon-categoria' />";
					echo "<span>Categoria</span>";
					echo "</td>";
					echo "<td class='quando-onde'>";
					echo "<img src='images/local.png' alt='icon-local' />";
					echo "<span>{$endereco}</span><br>";
					echo "<img src='images/relogio.png'  alt='icon-data-hora' />";
					echo "<span>{$data}, das {$horainicio} as {$horafim} </span>";
					echo "</td>";
					echo "<td class='detalhes'>";
					if($isOwner){
						echo "<img src='images/amigos.png'  alt='icon-ownership' title='Dono da atividade' /><br>";
					}

					if($isPublic){
						echo "<img src='images/public.png'  alt='icon-visibility' title='Atividade pública' />";
					}else{
						echo "<img src='images/private.png'  alt='icon-visibility' title='Atividade pública' />";
					}
					echo "</td>";
					echo "</tr>";
				?>
			</tbody>
		</table>