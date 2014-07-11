<?php
				session_start();

				require('../config.php');
				$idusuario = $_SESSION['idusuario'];
				$usuario_atual = mysql_query("select * from usuarios where idusuario = $idusuario");		
				$row_atual = mysql_fetch_array($usuario_atual);

?>

	<script type="text/javascript" src="scripts/edit.js"></script>
	<form name="cadastro" action ="edit_submit.php" method="post" id="editform">
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
		<label >Data de Nascimento:</label>
		<?php

					$datanasceu = $row_atual['data_nascimento'];
				

						
					$time = strtotime($datanasceu);
					// $anonasceu = date('Y', $time);
					
					$dianasceu = date('d', $time);
				
					// $mesnasceu = date('m', $time);

					// echo $dianasceu . "-" . $mesnasceu . "-" . $anonasceu;

					#GERA OS Dias do mes
				
					echo "<select id='user_data_3i' name='dia' >";
					for ($i=1; $i< 32; $i++){

						echo "<option ";
						if($i < 10){
							

							$diaa = "0".$i;
							$dianasceu2 = (string)$dianasceu;
							if($dianasceu2 == $diaa){
								echo "selected='selected'>";
							}else{
								echo ">";

							}
							echo $diaa;
						}else{
							$dianasceu2 = (string)$dianasceu;
							if($dianasceu2 == $i){
								echo "selected='selected'>";
							}else{							
							echo ">";
							
							}
							echo $i;
						}
						
						echo "</option>";
						}
					
					echo "</select>";
				?>
				
		<select id="user_data_2i" name="mes">

		<?php

			//====================================================================
			// gera meses dinamicamente + seleciona o mes em que o cara nasceu. ==
			//====================================================================

			$meses = Array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
			$mesnasceu = date('m', $time);
			$mesnasceu = (string)$mesnasceu;

			for ($i=0; $i < 12 ; $i++) { 
				if($i < 10){
					$d = "0".$i;
				}else{
					$d = $i;
				}
				echo "<option value='" . $d . "' ";

				if($mesnasceu == $d){

					// vai ter selected
					echo "selected='selected'>";
				}else{

					//naovai ter
					echo ">";
				}
				//imprimir mes
				echo $meses[$i]."</option>";
			}
		?>

	</select>

	<?php
		#GERA OS ANOS para q só permita +18
		$anonasceu = date('Y', $time);
		$anonasceu = (string)$anonasceu;
		$startyear = date("Y") - 18;
		echo "<select id='user_data_1i' name='ano'>";
		for ($i=0; $i< 80; $i++){
			echo "<option ";
			if($startyear == $anonasceu){
				echo "selected = 'selected'>";
			}else{
				echo ">";
			}
			echo $startyear--;
			echo "</option>";
		}
		echo "</select>";
	?>
</div>
<br>
<!-- local -->
<label class="grupo-input">Local</label>
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

				$sqlCommand2 = "SELECT idinteresse FROM usuarios_interesses WHERE usuarios_idusuario= $id_atual";
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

