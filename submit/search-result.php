<!-- CSS -->
<link href="styles/content-temp.css" type="text/css" rel="stylesheet" />
<link href="styles/search-result.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
<script src="scripts/content-temp.js" type="text/javascript"></script>
<script src="scripts/gerar-mapa-atividades.js" type="text/javascript"></script>

<a href="" class="x"></a>
<div id="search-result">
<?php
	if($_POST){

		function calcDistancia($lat1, $long1, $lat2, $long2)
		{
		    $d2r = 0.017453292519943295769236;

		    $dlong = ($long2 - $long1) * $d2r;
		    $dlat = ($lat2 - $lat1) * $d2r;

		    $temp_sin = sin($dlat/2.0);
		    $temp_cos = cos($lat1 * $d2r);
		    $temp_sin2 = sin($dlong/2.0);

		    $a = ($temp_sin * $temp_sin) + ($temp_cos * $temp_cos) * ($temp_sin2 * $temp_sin2);
		    $c = 2.0 * atan2(sqrt($a), sqrt(1.0 - $a));

		    return 6368.1 * $c;
		}

		require('../config.php');

		$user_lat = $_POST['user_lat'];
		$user_lng = $_POST['user_lng'];

		// $json = $_POST['json'];
		$search = $_POST['search'];
		$filtro = $_POST['filtro'];
		// echo $search;
		// echo $filtro;
		if($filtro == 'atividades'){
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
						
						echo "<div class='search2-item atividade-item'>";
						echo "<input type='hidden' class='idatividade' value='$id' />";
						echo "<span class='name'><img src='images/icons/atividades/{$idinteresse}laranja.png' /> ";
						echo $final_titulo;
						echo "</span><br>";						
						// echo "<label>{$categoria}</label><br>";

						echo "Distancia : ".calcDistancia($user_lat,$user_lng, $lat, $lng)."Km";
						echo "<label><img src='images/local.png'>{$endereco}</label><br>";
						echo "<input type='hidden' value='{$lat}' name='latitude'>";
						echo "<input type='hidden' value='{$lng}' name='longitude'>";
						echo "<img src='images/local-30x30.png' class='showonmap'>";
						echo "</div>";
					}
				}

			}			
			
		}elseif($filtro == 'interesses'){
			$q= mysql_real_escape_string($search);

			if($q != ""){//se busca nao for vazia

				//numero q limita renotrno de atividades
				
				$sql_atividades= mysql_query("SELECT * from atividades where idinteresse = {$q} order by titulo") or die(mysql_error());

				$sql_interesses= mysql_query("SELECT * from interesses where idinteresse = {$q}" ) or die(mysql_error());
				$sql_interesses = mysql_fetch_array($sql_interesses);
				$sql_interesses = utf8_encode($sql_interesses['descricao']);

				if(mysql_num_rows($sql_atividades)){
					//imprime atividades
					echo "<h2>";
					echo "Atividades:";
					echo "</h2>";
					echo "<label>Categoria: <i>{$sql_interesses}</i></label><br>";

					//conta linhas retornadas
					while($row=mysql_fetch_array($sql_atividades))
					{
						//incrementa linhas retornadas
						//dados de retorno da busca
						$final_titulo =$row['titulo'];
						$id = $row['idatividade'];
						
						echo "<div class='search-item atividade-item'>";
						echo "<img src='images/icons/atividades/";
						echo $row['idinteresse']."laranja.png' />";
						echo "<input type='hidden' class='idatividade' value='$id' />";
						echo "<span class='name'>";
						echo $final_titulo;
						echo "</span></div>";
					}
				}

			}
		}elseif($filtro == 'pessoas'){
			$q= mysql_real_escape_string($search);

			session_start();
			$idusuario = $_SESSION['idusuario'];
			
			$sql_res= mysql_query("SELECT u.idusuario as idusuario, u.nome as nome, c.cidade as cidade FROM usuarios u, cidades c WHERE u.idcidade = c.idcidade AND nome LIKE '%$q%' AND idusuario <> ".$idusuario." order by idusuario") or die(mysql_error());

			if(mysql_num_rows($sql_res)){
				//identifica categoria
				echo "<h2>";
				echo "Pessoas:";
				echo "</h2>";
				echo "<label>Resultado de busca para: <i>{$search}</i></label><br>";
				
				while($row=mysql_fetch_array($sql_res))
				{
					$nome =$row['nome'];
					$id =$row['idusuario'];
					// $b_nome ='<strong>'.$q.'</strong>';
					// $final_nome = str_ireplace($q, $b_nome, $nome);

					$cidade =utf8_encode($row['cidade']);

					echo "<div class='search-item pessoa-item' >";
					echo "<img class='foto' src='images/user_default-68x68.png' />";
					echo "<div>";
					echo "<input type='hidden' class='idusuario' value='$id' />";
					echo "<label class='name'><strong>{$nome}</strong></label><br>";
					echo "<label><img src='images/local.png' >{$cidade}</label>";
					echo "</div>";
					echo "</div>";
					
				}
			}
		}
	}
?>
</div>
<div id="map-canvas-atividades" ></div>