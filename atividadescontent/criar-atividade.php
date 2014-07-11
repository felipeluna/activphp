<script src="styles/jquery-ui.min.js"></script>
  	
<script type="text/javascript" src="scripts/data.js"></script>

</head>
<body>
	<br>
	<form action="atividadescontent/cadastrar-atividade.php" name="criar-atividade-form" method="post">
		<label for="nome-atividade"></label>
		<input type="text" name="nome-atividade" placeholder="Nomeie sua atividade" id="id-atividade"/>
		<br>
		<label for="descricao-atividade"></label>
		<textarea cols="30" rows="7" name="descricao-atividade" placeholder="Descreva sua atividade" id="id-descricao-atividade"/>
		<br>
		<label for="endereco"></label>
		<input type="text" name="endereco" placeholder="Digite o Endereço" id="id-endereco-atividade"/>
		<br>
		<br>
		<!-- <label for="data-inicio"></label> -->
		<input type="text" name="data" id="datepicker"  />
		<br>
		<label for="tempo-duracao"/>
		<input type="text" name="tempo-duracao" placeholder="tempo de duração" />
		<select name="duracao-opcoes" id="id-duracao">
			<option value="0">min</option>
			<option value="1">hrs</option>
			<option value="2">dias</option>
		</select>
		<br>
		<input type="radio" name="evento" value="public">Evento Público
		<br>
		<input type="radio" name="evento" value="private">Evento Privado
		<br>
		<br>
			Tipo de Atividade:<br>
			<?php
				
				require('../config.php');
				$result = mysql_query(
					"SELECT idinteresses, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresses = $row['idinteresses'];
					echo "<input type='radio' name='atividade'  value ='{$idinteresses}' id='cb{$idinteresses}'>";
					echo "<label for='cb{$idinteresses}'>";
 					echo utf8_encode($row['descricao']);
 					echo "</label> <br />";
				}				
			?>

		<input type="submit" name="submit_atividade" />
	</form>