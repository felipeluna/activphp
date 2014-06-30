<?php
	session_start();

	if(isset($_SESSION['email']))
	{
		header("Location: dashboard.php");
		exit();
	}
?>
<!DOCTYPE html>
<html len="pt">
<head>
	<meta charset="utf-8"/>
		<title>ActivFun - Home</title>
	<link href="styles/index.css" type="text/css" rel="stylesheet" />
	<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="scripts/index.js"></script>
</head>
<body id="home">
	<header>
		<img class="logo" alt="Logomarca ActivFun Branca" src="images/logo-branca.png" />
		<!-- 
		<?php
			// require('login_session.php');
		?> -->
		
		<form name="login" action="" method="post" id="loginForm">
		<label class="errologin">Combinação de email e senha inválida</label>
			<input type="text" name="email" placeholder="E-mail" /> 
			<input type="password" name="pass" placeholder="Senha" /> 
			<input type="submit" name="submit_login" value="Entrar"/></br>
			<a href="#">Esqueci minha senha</a>
		</form>
	</header>
	<div id="main-container">
			<form name="cadastro" action ="register.php" method="post" id="cadastroForm">
			<p>Cadastre-se, é grátis</p>
			<div class="input-group">
				<input type="text" name="name" placeholder="Nome"/>
				<input type="e-mail" name="email" placeholder="E-mail"/></br>
				<input type="password" name="pass1" placeholder="Senha"/>
				<input type="password" name="pass2" placeholder="Confirmar senha"/></br>
				<label class="grupo-input">Data de Nascimento</label>
				<?php
					#GERA OS Dias do mes
					$startyear = 1;
					echo "<select id='user_data_3i' name='dia' >";
					for ($i=0; $i < 31; $i++){
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
			<label class="grupo-input">Atividades de interesse</label>
			<div class="input-group">
			<!-- PEGA INTERESSES DO BANCO  -->
			<?php
				require('config.php');

				$result = mysql_query(
					"SELECT idinteresses, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresses = $row['idinteresses'];
					echo "<input type='checkbox' name='checkbox[]'  value ='$idinteresses' id='cb$idinteresses'>";
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
			<div class="input-group">
				<input type="submit" name="submit_cadastro" value="Cadastrar" disabled="true" id="cadastro_btn" />
				<input type="checkbox" id="checkme"/>
				<label id="concordo" for="checkme">Concordo com os <a href="#">Termos de uso</a></label>
			</div>
			</form>	
	</div>
	<footer>		
		<div class="block">
			<img class="logo" alt="Logomarca ActivFun Colorida" src="images/logo-color.png" /></br>
			<a href="#">Contato</a></br>
			<a href="#">Quem somos?</a></br>
			<a href="#">Termos de uso</a>
		</div>

		<div id="busca">
			<p>Encontre atividades que você gosta</p>
			<input type="text" name="busca_atividade" value="Busca" /></br>
			<a href="#"><img width="15px" src="images/icons/atividades/football.png" alt="ICON"> Partidas de futebol</a></br>
			<a href="#"><img width="15px" src="images/icons/atividades/basketball.png" alt="ICON"> Partidas de basquete</a></br>
			<a href="#"><img width="15px" src="images/icons/atividades/volleyball.png" alt="ICON"> Partidas de volley</a></br>
			<a href="#"><img width="15px" src="images/icons/atividades/bike.png" alt="ICON"> Passeios ciclisticos</a></br>
			<a href="#"><img width="15px" src="images/icons/atividades/chess.png" alt="ICON">Partida de Chadrez </a></br>
			<a href="#"><img width="15px" src="images/icons/atividades/rpg.png" alt="ICON"> Seções de RPG/MMO</a></br>
		</div>
	</footer>
</body>
</html>