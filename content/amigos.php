<h1>Amigos</h1>

<?php

require('../config.php');

session_start();

//id do usuarioq solicita o pedido de amizade
$id = $_SESSION['idusuario'];

//verificar se atual é amigo q solicitou
$sql_amizade = mysql_query("SELECT u.idusuario as id, u.nome as nome, c.cidade as cidade FROM usuarios u, cidades c WHERE
			(idusuario IN (SELECT idusuario_solicita FROM amigos WHERE idusuario_responde = $id AND statusconvite = true)
			OR idusuario IN (SELECT idusuario_responde FROM amigos WHERE idusuario_solicita = $id AND statusconvite = true))
			AND c.idcidade = u.idcidade
						") or die(mysql_error()." erro: check amizade");

	while($row = mysql_fetch_array($sql_amizade, MYSQL_ASSOC)){
			$id_amigo = $row['id'];
			$nome = $row['nome'];
			$cidade = $row['cidade'];
			$cidade = $row['cidade'];

			echo "<div class='amigo' id='{$id_amigo}'>";
			echo "<img src='images/user_default-35x35.png'>";
			echo "<label><strong>{$nome}</strong></label>";
			echo "<label>
			<img src='images/local.png'>
			{$cidade}</label>";
			echo "</div>";
			
	}
?>