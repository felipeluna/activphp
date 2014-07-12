<?php
	if($_POST){

		require('config.php');
		// $json = $_POST['json'];
		$search = $_POST['search'];
		$filtro = $_POST['filtro'];
		// echo $search;
		// echo $filtro;
		if($filtro == 'atividades'){
			$q= mysql_real_escape_string($search);

			$sql_interesses;

			if($q != ""){//se busca nao for vazia
				$sql_interesses= mysql_query("select idinteresse, descricao from interesses where descricao like '%$q%' order by idinteresse") or die(mysql_error());

				$sql_atividades= mysql_query("select idatividade, titulo, endereco, idinteresse from atividades where descricao like '%$q%' order by idinteresse") or die(mysql_error());				

				if(mysql_num_rows($sql_atividades)){
					//imprime atividades
					echo "<div class='autocomplete-item-group'>";
					echo "Atividades";
					echo "</div>";
					
					while($row=mysql_fetch_array($sql_atividades))
					{
						$titulo =$row['titulo'];
						$b_titulo ='<strong>'.$q.'</strong>';
						$final_titulo = str_ireplace($q, $b_titulo, $titulo);

						echo "<div class='autocomplete-item'>";
						echo "<img src='images/icons/atividades/";
						echo $row['idinteresse'].".png' />";
						echo "<span class='title'>";
						echo $final_titulo;
						echo "</span></div>";

					}
				}

			}else{// se busca for vazia exibe todas categorias
				$sql_interesses= mysql_query("select idinteresse, descricao from interesses order by idinteresse") or die(mysql_error());
			}

			
			//imprime categorias com match
			if(mysql_num_rows($sql_interesses)){
				echo "<div class='autocomplete-item-group'>";
				echo "Categorias";
				echo "</div>";

			
				while($row=mysql_fetch_array($sql_interesses))
				{
					$descricao =$row['descricao'];
					$b_descricao ='<strong>'.$q.'</strong>';
					$final_descricao = str_ireplace($q, $b_descricao, $descricao);

					echo "<div class='autocomplete-item'>";
					echo "<img src='images/icons/atividades/";
					echo $row['idinteresse'].".png' />";
					echo "<span class='name'>";
					echo utf8_encode($final_descricao);
					echo "</span></div>";
				}
			}
		}elseif($filtro == 'pessoas'){
			$q= mysql_real_escape_string($search);

			session_start();
			$idusuario = $_SESSION['idusuario'];
			
			$sql_res= mysql_query("select idusuario, nome from usuarios where nome like '%$q%' and idusuario <> ".$idusuario." order by idusuario") or die(mysql_error());
			
			//identifica categoria
			echo "<div class='autocomplete-item-group'>";
			echo "Pessoas";
			echo "</div>";
			
			while($row=mysql_fetch_array($sql_res))
			{
				$nome =$row['nome'];
				$id =$row['idusuario'];
				$b_nome ='<strong>'.$q.'</strong>';
				$final_nome = str_ireplace($q, $b_nome, $nome);

				echo "<div class='autocomplete-item' >";
				echo "<img class='foto' src='images/user_default-35x35.png' />";
				echo "<input type='hidden' class='idusuario' value='$id' />";
				echo "<span class='name'>";
				echo $final_nome;
				echo "</span></div>";

			}
		}
	}
?>