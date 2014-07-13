<?php
				session_start();

				require('../config.php');
				$idusuario = $_SESSION['idusuario'];
				$usuario_atual = mysql_query("select * from usuarios where idusuario = $idusuario");		
				$row_atual = mysql_fetch_array($usuario_atual);

?>

	<script type="text/javascript" src="scripts/edit.js"></script>
	<form name="cadastro" action ="" method="post" id="editform">
		<h1>Editar informações</h1>
		<div class="input-group">
			<label for="nomeusuario">Nome: </label>
			<?php
			
				$nomeantigo = $row_atual['nome'];

				echo "<input type='text' name='name_novo' id='nomeusuario'";
				echo "value='". $nomeantigo . "'/>
			<br>
			";

				?>
			<!-- <input type="e-mail" name="email" placeholder="E-mail"/>
		</br>
		-->
		<label for="data-nascimento">Data de Nascimento:</label>
		
		<?php

			$datanasceu = $row_atual['data_nascimento'];
			$datanasceu = date("d/m/Y", strtotime($datanasceu));

			echo '<input type="text" name="data" placeholder="Data" class="data" id="data-nascimento"';
			echo 'value="'.$datanasceu.'"/>';	

				
	?>
</div>
<br>
<!-- local -->
<label class="grupo-input">Local:</label>
			<?php
				
				$id_idcidade = $row_atual['idcidade'];
				$estado1 = mysql_query("select uf, idestado from `estados` where idestado = (select idestado from `cidades` where idcidade =" . $id_idcidade . ");");
				$estado = mysql_fetch_array($estado1);
				// echo $estado['uf'];
				$result = mysql_query(
					"SELECT idestado, uf FROM estados;"
				)or die(mysql_error("Ops, ocorreu algum erro =("));
				
				echo "<select name='uf'>";
				// echo "<option value='0' >Estado </option>";
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					echo "<option ";
					echo "value='".$row['idestado']."' ";
					if($row['idestado'] == $estado['idestado']){
						echo "selected ";
					}
					echo ">"; // fecha tag de option
 					echo $row['uf'];
 					echo "</option>";
				}
				echo "</select>";
			?>

			<select name="cidade" id="select-cidade">

						
					<?php

						$estado_do_cara = $estado['idestado']; // id do estado do cara.

						$cidade_do_cara = mysql_query("select cidade from cidades where idcidade = {$id_idcidade}"); //nome da cidade.

						// todas as cidades desse estado.
						$result = mysql_query("select idcidade, cidade, idestado from `cidades` where idestado = {$estado_do_cara}")or die(mysql_error("Ops, ocorreu algum erro =("));
						
						while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
							echo "<option ";
							echo "value = '{$row['idcidade']}'";
							if($row['idcidade'] == $id_idcidade){
								echo " selected ";
							}
							echo " >";
							echo utf8_encode($row['cidade']);
							echo "</option>";
						}

						// <option value = 'asdfasdf' selected > asdfasdfafsd </option>
					?>
			</select>



<br>
<label class="grupo-input">Atividades de interesse:</label>
<div class="input-group">
<!-- PEGA INTERESSES DO BANCO  -->
<?php
				//===========
				$usuario_atual = mysql_query("select * from usuarios where idusuario = $idusuario");		
				$row_atual = mysql_fetch_array($usuario_atual);
				$id_atual = $row_atual['idusuario'];

				$selectedinteresses = array();

				$sqlCommand2 = "SELECT idinteresse FROM usuarios_interesses WHERE idusuario= $id_atual";
				$query2 = mysql_query( $sqlCommand2) or die (mysql_error());
				while ($row = mysql_fetch_array($query2)) {
					//echo 'entrou';
				    $selectedinteresses[] = $row['idinteresse'];
				}   

				//============

				$result = mysql_query(
					"SELECT idinteresse, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresse = $row['idinteresse'];
					echo "<input type='checkbox' name='checkbox_novo[]' value ='$idinteresse' id='cb$idinteresse'";
					if(in_array($idinteresse, $selectedinteresses)){
						echo "checked='true'>";
					}else{
						echo ">";
					}

					echo "<label for='cb$idinteresse'>";
 					echo utf8_encode($row['descricao']);
 					echo "</label><br />";
				}				
			?>
<!-- 	<input type="checkbox" name="checkbox[]"  value ='1' id="cb1" >
<label for="cb1">Futebol</label>
<br />
<input type="checkbox" name="checkbox[]"  value ='2'>
Voley
<br />
<input type="checkbox" name="checkbox[]" value ='3'>
Basketball
<br />
<input type="checkbox" name="checkbox[]" value ='4'>
Cicismo
<br />
<input type="checkbox" name="checkbox[]" value ='5'>
RPG/MMO
<br />
<input type="checkbox" name="checkbox[]"  value ='6'>
Jogos de Tabuleiro
<br />
-->
</div>
<br><!-- 
<input type="password" name="pass1" placeholder="Senha de confirmação"/>
<br> -->
<?php
echo "<input type='hidden' name='idusuario' value='";
echo $idusuario;
echo "' />";
?>
<input type="submit" name="submit_edit" value="Editar" id="editar_btn" />
</form>

