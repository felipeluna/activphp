<?php
	if($_POST){

		require('config.php');

		$q= mysql_real_escape_string($_POST['search']);

		$sql_res;

		if($q != "search="){//se busca nao for vazia
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
	}
?>