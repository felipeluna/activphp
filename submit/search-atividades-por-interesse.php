<script src="scripts/gerar-mapa-atividades.js" type="text/javascript"></script>
<div id="search-result-com-mapa">
<?php
$q= mysql_real_escape_string($search);

			if($q != ""){//se busca nao for vazia

				//numero q limita renotrno de atividades
				
				$sql_atividades= mysql_query("SELECT * from atividades where idinteresse = {$q} order by titulo") or die(mysql_error());

				$sql_interesses= mysql_query("SELECT * from interesses where idinteresse = {$q}" ) or die(mysql_error());
				$sql_interesses = mysql_fetch_array($sql_interesses);
				$sql_interesses = utf8_encode($sql_interesses['descricao']);

				$idinteresse = $q;

				$categoria = mysql_query("SELECT descricao FROM interesses WHERE idinteresse = {$idinteresse}" ) or die(mysql_error());
				$categoria = mysql_fetch_array($categoria);
				$categoria = utf8_encode($categoria['descricao']);

				if(mysql_num_rows($sql_atividades)){
					//imprime atividades
					echo "<h2>";
					echo "Atividades:";
					echo "</h2>";
					echo "<label>Categoria: <i>{$sql_interesses}</i></label><br>";

					//conta linhas retornadas
					while($row=mysql_fetch_array($sql_atividades))
					{
						
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
					<label>Na categoria de : </label><i>{$categoria}</i>
					</div>";
				}

			}
?>
</div>
<div id="map-canvas-atividades" ></div>