<script src="scripts/gerar-mapa-atividades.js" type="text/javascript"></script>
<div id="search-result-com-mapa" >
<?php

	$q= mysql_real_escape_string($search);

			$sql_interesses;

			if($q != ""){//se busca nao for vazia
				$sql_interesses= mysql_query("select idinteresse, descricao from interesses where descricao like '%$q%' order by idinteresse" ) or die(mysql_error());

				//numero q limita renotrno de atividades
				
				$sql_atividades= mysql_query("select * from atividades where titulo like '%$q%' order by idinteresse") or die(mysql_error());				

				if(mysql_num_rows($sql_atividades)){
					//imprime atividades
					echo "<h2>";
					echo "Atividades:";
					echo "</h2>";
					echo "<label>Resultado de busca para: <i>{$search}</i></label><br>";

					//conta linhas retornadas
					while($row=mysql_fetch_array($sql_atividades))
					{
						$idinteresse = $row['idinteresse'];
						$categoria = mysql_query("SELECT descricao FROM interesses WHERE idinteresse = {$idinteresse}" ) or die(mysql_error());
						$categoria = mysql_fetch_array($categoria);
						$categoria = $categoria['descricao'];
						$lat = $row['latitude'];
						$lng = $row['longitude'];

						//incrementa linhas retornadas
						//dados de retorno da busca
						$final_titulo =$row['titulo'];
						$id = $row['idatividade'];
						$endereco = $row['endereco'];
						$distancia = number_format(calcDistancia($user_lat,$user_lng, $lat, $lng),2);
						echo "<div class='search2-item atividade-item'>";
						echo "<input type='hidden' class='idatividade' value='$id' />";
						echo "<span class='name'><img src='images/icons/atividades/{$idinteresse}laranja.png' /> ";
						echo $final_titulo;
						echo "</span><br>";						
						// echo "<label>{$categoria}</label><br>";

						echo "<label class='distancia'><strong>Distancia:</strong> {$distancia}Km</label>";
						echo "<label class='endereco'><img src='images/local.png'>{$endereco}</label><br>";
						echo "<input type='hidden' value='{$lat}' name='latitude'>";
						echo "<input type='hidden' value='{$lng}' name='longitude'>";
						echo "<img src='images/local-30x30.png' class='showonmap'>";
						echo "</div>";
					}
				}else{
					echo "<div class='search2-item atividade-item'>";
					echo "<span class='name'>Nenhuma atividade encontrada</span><br>
					<label>para busca: </label><i>{$search}</i>
					</div>";
				}

			}		
?>
</div>
<div id="map-canvas-atividades" ></div>