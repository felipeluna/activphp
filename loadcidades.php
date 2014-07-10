<?php
	if(isset($_POST)){
		$idestado = $_POST['uf'];

		require('config.php');

		$result = mysql_query(
		"SELECT idcidades, cidade FROM cidades where idestado = $idestado;"
		)or die(mysql_error());
		
		// echo "<select name='cidade'>";
		echo "<option value='0'>Cidade </option>";
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "<option ";
			echo "value='".$row['idcidades']."' >";
				echo utf8_encode($row['cidade']);
				echo "</option>";
		}
		// echo "</select>";
	}else{
		echo "buscacidades.erro";
	}
?>