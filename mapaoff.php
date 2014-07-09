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
	<title>ActivFun - Mapa</title>

<!-- CSS -->
	<link href="styles/general.css" type="text/css" rel="stylesheet" />
	<link href="styles/mapaoff.css" type="text/css" rel="stylesheet" />
	<link rel="shortcut icon" href="images/favicon_activfun.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon_activfun.ico" type="image/x-icon">

<!-- JAVASCRIPT -->
	<script src="scripts/jquery-1.11.1.min.js" type="text/javascript"></script>
	<script src="scripts/mapa-off.js" type="text/javascript" ></script>	
	<script src="scripts/auto-complete-atividades.js" type="text/javascript" ></script>	

</head>
<body id="mapa-off">
	<header>
		<img class="logo" alt="Logomarca ActivFun Branca" src="images/logo-branca.png" />
		<form name="busca">
				<input type="text" name="campo_busca" placeholder="Busca" id="inputBusca270px" />
				<input type="submit" name="buscar" value="" id="btnBusca270px" />
				<div id="result"></div>
		</form>

		<form name="login" action="" method="post" id="loginForm">
			<label class="errologin">Combinação de email e senha inválida</label>
			<input type="text" name="email" placeholder="E-mail" /> 
			<input type="password" name="pass" placeholder="Senha" /> 
			<input type="submit" name="submit_login" value="Entrar" class="shadowButton" /></br>
			<a href="#">Esqueci minha senha</a>
		</form>
	</header>
		<script type="text/javascript" src="scripts/gerar-mapa.js"></script>
		<div id="map-canvas"></div>
	<footer>			
			<img src="images/logo-color-dashboard.png" class="logo" />
				<a href="#">Contato</a>
				<a href="#">Quem somos?</a>
				<a href="#">Termos de uso</a>
	</footer>
</body>
</html>