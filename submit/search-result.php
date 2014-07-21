<!-- CSS -->
<link href="styles/content-temp.css" type="text/css" rel="stylesheet" />
<link href="styles/search-result.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
<script src="scripts/content-temp.js" type="text/javascript"></script>

<a href="" class="x"></a>
<div id="search-result">
<?php
	if($_POST){

		require('../config.php');
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
				
				$sql_atividades= mysql_query("select idatividade, titulo, endereco, idinteresse from atividades where titulo like '%$q%' order by idinteresse") or die(mysql_error());				

				if(mysql_num_rows($sql_atividades)){
					//imprime atividades
					echo "<h2>";
					echo "Atividades:";
					echo "</h2>";
					echo "<label>Resultado de busca para: <i>{$search}</i></label><br>";

					//conta linhas retornadas
					while($row=mysql_fetch_array($sql_atividades))
					{
						//incrementa linhas retornadas
						//dados de retorno da busca
						$titulo =$row['titulo'];
						$b_titulo ='<strong>'.$q.'</strong>';
						$final_titulo = str_ireplace($q, $b_titulo, $titulo);
						$id = $row['idatividade'];
						
						echo "<div class='autocomplete-item atividade-item'>";
						echo "<img src='images/icons/atividades/";
						echo $row['idinteresse']."laranja.png' />";
						echo "<input type='hidden' class='idatividade' value='$id' />";
						echo "<span class='name'>";
						echo $final_titulo;
						echo "</span></div>";
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
						$titulo =$row['titulo'];
						$b_titulo ='<strong>'.$q.'</strong>';
						$final_titulo = str_ireplace($q, $b_titulo, $titulo);
						$id = $row['idatividade'];
						
						echo "<div class='autocomplete-item atividade-item'>";
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