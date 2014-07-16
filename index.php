<?php
	session_start();

	if(isset($_SESSION['idusuario']))
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
<!-- CSS -->
	<link href="styles/general.css" type="text/css" rel="stylesheet" />
	<link href="styles/index.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPTS -->
	<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="scripts/jquery.mask.min.js"></script>
	<script type="text/javascript" src="scripts/general.js"></script>
	<script type="text/javascript" src="scripts/index.js"></script>
	<script type="text/javascript" src="scripts/cadastro.js"></script>
	<script type="text/javascript" src="scripts/login.js"></script>
	<script type="text/javascript" src="scripts/jquery.validate.js"></script>
	<!--<script type="text/javascript" src="scripts/validando.js"></script>-->
	<script type="text/javascript" src="scripts/additional-methods.min.js"></script>
<!-- FAVICON  -->
	<link rel="shortcut icon" href="images/favicon_activfun.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon_activfun.ico" type="image/x-icon">

</head>
<body id="home">
	<header>
		<img class="logo" alt="Logomarca ActivFun Branca" src="images/logo-branca.png" />		
		<form name="login" action="submit/login_session.php" method="post" id="loginForm">
			<label class="errologin">Combinação de email e senha inválida</label>
			<input type="text" name="email" placeholder="E-mail" /> 
			<input type="password" name="pass" placeholder="Senha" /> 
			<input type="submit" name="submit_login" value="Entrar" class="shadowButton" /></br>
			<a href="#">Esqueci minha senha</a>
		</form>
	</header>
	<div id="error"></div>
	<div id="main-container">
		<form name="cadastro" action ="submit/cadastro_submit.php" method="post" id="cadastroForm">
			<p>Cadastre-se, é grátis</p>
			<div class="input-group">
			<label for="username"></label>
				<input type="text" name="nome" placeholder="Nome" id="username"/>
			<label for="email"></label>
				<input type="e-mail" name="email" placeholder="E-mail" id="email"/></br>
				<label for="pass1"></label>
			<input type="password" name="pass1" placeholder="Senha" id="pass1"/>
				<label for="pass1"></label>
			<input type="password" name="pass2" placeholder="Confirmar senha" id="pass2"/></br>
				<label for="data-nascimento" class="grupo-input">Data de Nascimento</label>
				<input type="text" name="data" placeholder="Data" class="data" id="data-nascimento" />
				<?php
					// #GERA OS Dias do mes
					// $startyear = 1;
					// echo "<select id='user_data_3i' name='dia' >";
					// 	echo "<option>";
					// 	echo "Dia";
					// 	echo "</option>";
					// for ($i=0; $i < 31; $i++){
					// 	echo "<option>";
					// 	echo $startyear++;
					// 	echo "</option>";
					// }
					// echo "</select>"
				?>

				<!-- <select id="user_data_2i" name="mes">
					<option value="0">Mês</option>
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
				</select> -->

				<?php
					// #GERA OS ANOS para q só permita +18
					// $startyear = date("Y") - 18;
					// echo "<select id='user_data_1i' name='ano' >";
					// echo "<option>";
					// 	echo "Ano";
					// 	echo "</option>";
					// for ($i=0; $i < 80; $i++){
					// 	echo "<option>";
					// 	echo $startyear--;
					// 	echo "</option>";
					// }
					// echo "</select>";
				?>
			</div>
			<label class="grupo-input">Local</label>
			<?php
				require('config.php');
				

				$result = mysql_query(
					"SELECT idestado, uf FROM estados;"
				)or die(mysql_error("Ops, ocorreu algum erro =("));
				
				echo "<select name='uf'>";
				echo "<option value='0' >Estado </option>";
				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					echo "<option ";
					echo "value='".$row['idestado']."' >";
 					echo $row['uf'];
 					echo "</option>";
				}
				echo "</select>";
			?>

			<select name="cidade" disabled="true" id="select-cidade">
					<option value="0">Cidade</option>
			</select>

			<label class="grupo-input">Atividades de interesse</label>
			<div class="input-group">
			<!-- PEGA INTERESSES DO BANCO  -->
			<?php
				

				$result = mysql_query(
					"SELECT idinteresse, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresse = $row['idinteresse'];
					echo "<input type='checkbox' name='checkbox[]'  value ='$idinteresse' id='cb$idinteresse'>";
					echo "<label for='cb$idinteresse'>";
 					echo utf8_encode($row['descricao']);
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
			<div class="input-group" >
				<div id="submit_cadastro_group">
					<input type="submit" name="submit_cadastro" value="Cadastrar" disabled="true" id="cadastro_btn" class="shadowButton" />
				</div>
				<input type="checkbox" id="checkme"/>
				<label id="concordo" for="checkme">Concordo com os <a href="#">Termos de uso</a></label>
			</div>

			<!-- inserir messagens de erro. -->
		</form>	
	</div>
	<footer>		
		<div id="interesses">
			<p>Encontre atividades que você gosta</p>

			<form name="busca">
				<input type="text" name="campo_busca" placeholder="Busca" id="inputBusca270px" />
				<input type="submit" name="buscar" value="" id="btnBusca270px" />
			</form></br>
			
			<?php
				$result = mysql_query(
					"SELECT idinteresse, descricao FROM interesses;"
					)or die(mysql_error("Ops, ocorreu algum erro =("));

				while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
					$descricao = $row['descricao'];
					$idinteresse = $row['idinteresse'];
					echo "<div class='interesse'><a href='#'><img width='15px' src='images/icons/atividades/";
					echo $idinteresse;
					echo ".png' alt='ICON'>";
					echo utf8_encode($descricao);
					echo "</a></div>";
				}				
			?>

			<!-- <div class="interesse"><a href="#"><img width="15px" src="images/icons/atividades/football.png" alt="ICON"> Partidas de futebol</a></div>
			<div class="interesse"><a href="#"><img width="15px" src="images/icons/atividades/basketball.png" alt="ICON"> Partidas de basquete</a></div>
			<div class="interesse"><a href="#"><img width="15px" src="images/icons/atividades/volleyball.png" alt="ICON"> Partidas de volley</a></div>
			<div class="interesse"><a href="#"><img width="15px" src="images/icons/atividades/bike.png" alt="ICON"> Passeios ciclisticos</a></div>
			<div class="interesse"><a href="#"><img width="15px" src="images/icons/atividades/chess.png" alt="ICON">Partida de Chadrez </a></div>
			<div class="interesse"><a href="#"><img width="15px" src="images/icons/atividades/rpg.png" alt="ICON"> Seções de RPG/MMO</a></div> -->
		</div>
		<div class="block">
			<img class="logo" alt="Logomarca ActivFun Colorida" src="images/logo-color.png" /></br>
			<a href="#">Contato</a></br>
			<a href="#">Quem somos?</a></br>
			<a href="#">Termos de uso</a>
		</div>
	</footer>
</body>
</html>