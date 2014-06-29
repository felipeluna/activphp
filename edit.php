<?php
				require('config.php');

?>

<html>
<head>
	<meta charset="utf-8"/>
	<title></title>
</head>
<body>
	<form name="cadastro" action ="edit.php" method="post">
			<p>Editar informações;</p>
			<div class="input-group">
				<?php
				$email = 'felipe@luna.com';
				$usuario_atual = mysql_query("select * from usuarios where email = '$email'");		
				$row_atual = mysql_fetch_array($usuario_atual);
				$nomeantigo = $row_atual['nome'];

				echo "<input type='text' name='name_novo'";
				echo "value='". $nomeantigo . "'/><br>";

				?>

				
				<!-- <input type="e-mail" name="email" placeholder="E-mail"/></br> -->
				<label class="grupo-input">Data de Nascimento</label>
				<?php
					#GERA OS Dias do mes
					$startyear = 1;
					echo "<select id='user_data_3i' name='dia' >";
					for ($i=0; $i < 32; $i++){
						echo "<option>";
						echo $startyear++;
						echo "</option>";
					}
					echo "</select>"
				?>

				<select id="user_data_2i" name="mes">
					<option value="1">Janeiro</option>
					<option value="2">Fevereiro</option>
					<option value="3">Março</option>
					<option value="4">Abril</option>
					<option value="5">Maio</option>
					<option selected="selected" value="6">Junho</option>
					<option value="7">Julho</option>
					<option value="8">Agosto</option>
					<option value="9">Setembro</option>
					<option value="10">Outubro</option>
					<option value="11">Novembro</option>
					<option value="12">Dezembro</option>
				</select>

				<?php
					#GERA OS ANOS para q só permita +18
					$startyear = date("Y") - 18;
					echo "<select id='user_data_1i' name='ano' >";
					for ($i=0; $i < 80; $i++){
						echo "<option>";
						echo $startyear--;
						echo "</option>";
					}
					echo "</select>"
				?>
			</div>
			<br>
			<label class="grupo-input">Atividades de interesse</label>
			<div class="input-group">
			<!-- PEGA INTERESSES DO BANCO  -->
			<?php
				//===========
				$email = 'felipe@luna.com';
				$usuario_atual = mysql_query("select * from usuarios where email = '$email'");		
				$row_atual = mysql_fetch_array($usuario_atual);
				$id_atual = $row_atual['idusuarios'];


				$sqlCommand2 = "SELECT interesses_idinteresses FROM usuarios_interesses WHERE usuarios_idusuarios='$id_atual'";
				$query2 = mysql_query( $sqlCommand2) or die (mysql_error());
				while ($row = mysql_fetch_array($query2)) {
					//echo 'entrou';
				    $selectedinteresses[] = $row['interesses_idinteresses'];
				}   



				//============

				$result = mysql_query(
					"SELECT idinteresses, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresses = $row['idinteresses'];
					echo "<input type='checkbox' name='checkbox_novo[]' value ='$idinteresses' id='cb$idinteresses'";
					if(in_array($idinteresses, $selectedinteresses)){
						echo "checked='true'>";
					}else{
						echo ">";
					}

					echo "<label for='cb$idinteresses'>";
 					echo $row['descricao'];
 					echo "</label> <br />";
				}				
			?>

			<!-- 	<input type="checkbox" name="checkbox[]"  value ='1' id="cb1" ><label for="cb1"> Futebol</label> <br />
				<input type="checkbox" name="checkbox[]"  value ='2'>Voley <br />
				<input type="checkbox" name="checkbox[]" value ='3'>Basketball <br />
				<input type="checkbox" name="checkbox[]" value ='4'>Cicismo <br />
				<input type="checkbox" name="checkbox[]" value ='5'>RPG/MMO <br />
				<input type="checkbox" name="checkbox[]"  value ='6'>Jogos de Tabuleiro <br /> -->
			</div>
			<br>
			<input type="password" name="pass1" placeholder="Senha de confirmação"/><br>

			<div class="input-group">
				<input type="submit" name="submit_edit" value="Editar" id="editar_btn" />
			</div>
			</form>	


</body>


<?php
		
	//$usuario = $_SESSION['email'];

//	if($usuario){
		//usuario logado
		$email = 'felipe@luna.com';

		if(isset($_POST['submit_edit'])){
			// novo
			$novo_nome = $_POST['name_novo'];
			$usuario_atual = mysql_query("select * from usuarios where email = '$email'");		
			$row_atual = mysql_fetch_array($usuario_atual);
			// echo $row['nome'] . " " . $row['data_nascimento'];



			$id_atual = $row_atual['idusuarios'];
			
			//update nome'
			mysql_query(" update usuarios set nome='$novo_nome' where email = '$email'");
			
//-----------				//--- teste ---
			// $sqlCommand2 = "SELECT interesses_idinteresses FROM usuarios_interesses WHERE usuarios_idusuarios='$id_atual'";
			// $query2 = mysql_query( $sqlCommand2) or die (mysql_error());
			// while ($row = mysql_fetch_array($query2)) {
			// 	echo 'entrou';
			//     $selectedinteresses[] = $row['interesses_idinteresses'];
			// }   


			// print_r($selectedinteresses);
//-----------			//--- teste ---



	//	---

			//deleta interesses da tabela
			mysql_query("delete from usuarios_interesses where usuarios_idusuarios = $id_atual");
			// //insere de novo.
			foreach($_POST['checkbox_novo'] as $interesse){
				    mysql_query(
							"insert into usuarios_interesses values ((select idusuarios from usuarios where email = '$email'), $interesse)"
							) or die(mysql_error());
			}


		}



	// }else{
	// 	//usuario nao logado
	// }


?>


</html>