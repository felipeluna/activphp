<h1>Convites</h1>

<?php
//id do usuarioq respondera o pedido de amizade
require('../config.php');

session_start();
//id do usuarioq solicita o pedido de amizade
$id_r = $_SESSION['idusuario'];

//verificar se ja é amigo
$sql_amizade= mysql_query("SELECT * FROM amigos
						where
						idusuario_responde = $id_r
						") or die(mysql_error()." erro: check amizade");

	//continua se não forem amigos
	if(mysql_num_rows($sql_amizade)>0){
		$row = mysql_fetch_array($sql_amizade);
		$id_s = $row['idusuario_solicita'];
		echo "<p>Usuáio de id:{$id_s} fez enviou um convite de amizade</p> <br>";
		echo "<div>
			<input type='submit' value='Aceitar convite' >
			<input type='submit' value='Recustar convite' >
		</div>";
	}else{
		echo "<p>VOCÊ NÃO TEM NENHUM CONVITE</p>";
	}
?>