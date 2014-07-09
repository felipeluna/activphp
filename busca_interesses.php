<?php
	if($_POST){

		require('config.php');

		$q=$_POST['search'];
		$sql_res= mysql_query("select idInteresses, descricao from interesses where descricao like '%$q%' order by idInteresses") or die(mysql_error());
		while($row=mysql_fetch_array($sql_res))
		{
			$descricao =$row['descricao'];
			$b_descricao ='<strong>'.$q.'</strong>';
			$final_descricao = str_ireplace($q, $b_descricao, $descricao);

			echo "<div class='autocomplete-item'>";
			echo "<img src='images/icons/atividades/";
			echo $row['idInteresses'].".png' />";
			echo "<span class='name'>";
			echo $final_descricao;
			echo "</span></div>";

		}
	}
?>