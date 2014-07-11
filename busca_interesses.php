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

			$sql_res;

			if($q != ""){//se busca nao for vazia
				$sql_res= mysql_query("select idInteresses, descricao from interesses where descricao like '%$q%' order by idInteresses") or die(mysql_error());
			}else{// se busca for vazia exibe todas categorias
				$sql_res= mysql_query("select idInteresses, descricao from interesses order by idInteresses") or die(mysql_error());
			}

			//identifica categoria
			echo "<div class='autocomplete-item-group'>";
			echo "Categorias";
			echo "</div>";
			
			while($row=mysql_fetch_array($sql_res))
			{
				$descricao =$row['descricao'];
				$b_descricao ='<strong>'.$q.'</strong>';
				$final_descricao = str_ireplace($q, $b_descricao, $descricao);

				echo "<div class='autocomplete-item'>";
				echo "<img src='images/icons/atividades/";
				echo $row['idInteresses'].".png' />";
				echo "<span class='name'>";
				echo utf8_encode($final_descricao);
				echo "</span></div>";

			}
		}elseif($filtro == 'pessoas'){
			$q= mysql_real_escape_string($search);

			session_start();
			$email = $_SESSION['email'];
			$sql_res= mysql_query("select idusuarios, nome from usuarios where nome like '%$q%' and email != '$email' order by idusuarios") or die(mysql_error());
			
			//identifica categoria
			echo "<div class='autocomplete-item-group'>";
			echo "Pessoas";
			echo "</div>";
			
			while($row=mysql_fetch_array($sql_res))
			{
				$nome =$row['nome'];
				$b_nome ='<strong>'.$q.'</strong>';
				$final_nome = str_ireplace($q, $b_nome, $nome);

				echo "<div class='autocomplete-item' >";
				echo "<img class='foto' src='images/user_default-35x35.png' />";
				echo "<span class='name'>";
				echo utf8_encode($final_nome);
				echo "</span></div>";

			}
		}
	}
?>