<div id="search-result">
<?php
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
?>
</div>