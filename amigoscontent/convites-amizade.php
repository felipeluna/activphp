<script src="scripts/convites-recebidos.js" type="text/javascript"></script>
<?php

session_start();
//id do usuarioq solicita o pedido de amizade
$id_local = $_SESSION['idusuario'];


//conexão com o DB
require('../config.php');

//pega convites e dados dos solicitantes
$sql_amizade_solicita = mysql_query("SELECT
						u.idusuario as idamigo,
						u.nome as nome,
						c.cidade as cidade

						FROM amigos a, usuarios u, cidades c WHERE

						a.idusuario_solicita = u.idusuario AND
						u.idcidade = c.idcidade AND
						idusuario_responde = $id_local AND
						statusconvite = false
						") or die(mysql_error()." erro: check amizade");

	if(mysql_num_rows($sql_amizade_solicita) > 0){
		while($row = mysql_fetch_array($sql_amizade_solicita)){

			$id = $row['idamigo'];
			$nome = $row['nome'];
			echo '<div class="amigo">';
			echo '<img src="images/user_default-35x35.png" >';
			echo '<div class="amigo-info"> <label> <strong>';
			echo $nome;
			echo '</strong></label>';

			echo '<form name="responde-amigo" method="post" >';
			echo '<input type="hidden" name="idamigo" value="'.$id.'">';
			echo '<input type="submit" name="aceita-amigo-submit" value="Aceitar convite de amizade" class="btn-verde">';
			echo '<input type="submit" name="rejeita-amigo-submit" value="Rejeitar convite de amizade" class="btn-vermelho">';
			echo '</form>';	
			
			echo '</div>';
			echo '</div>';
		}
	}else{
		echo"<br>";
		echo "Nenhum convite recebido pendente";
	}
?>