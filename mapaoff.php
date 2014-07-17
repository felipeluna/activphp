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
	<title>ActivFun - Mapa</title>

<!-- CSS -->
	<link href="styles/general.css" type="text/css" rel="stylesheet" />
	<link href="styles/mapaoff.css" type="text/css" rel="stylesheet" />

<!-- Favicon -->
	<link rel="shortcut icon" href="images/favicon_activfun.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon_activfun.ico" type="image/x-icon">

<!-- JAVASCRIPT -->
	<script src="scripts/jquery-1.11.1.min.js" type="text/javascript" ></script>
	<script src="scripts/jquery.validate.js" type="text/javascript"></script>
	<script src="scripts/general.js" type="text/javascript" ></script>	
	<script src="scripts/login.js" type="text/javascript" ></script>	

</head>
<body id="mapa-off">
	<header>
		<img class="logo" alt="Logomarca ActivFun Branca" src="images/logo-branca.png" />

		<?php			
			include 'busca270px.php';
		?>

		<form name="login" action="submit/login_session.php" method="post" id="loginForm">
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