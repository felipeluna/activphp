<!DOCTYPE html>
<html  len="pt">
	<head>
		<meta charset="utf-8"/>
		<title>ActivFun - Dashboard</title>
		<link href="styles/dashboard.css" type="text/css" rel="stylesheet" />
	</head>
	<body id="dashboard">
		<header>
			<img class="logo" alt="Logomarca ActivFun Branca" src="images/logo-branca-dashboard.png" />

			<div class="user">
				<img class="notificacoes" src="images/notificacoes.png" />
				<img class="foto" alt="Foto usuario" src="images/user-35x35.jpg" />
				<ul>
					<li>
						<a href="#">Conta</a>
					</li>
					<li>
						<a href="unset_session.php">Sair</a>
					</li>
				</ul>
			</div>

		</header>
		<div id="main-container">
		<div id="esq">
			<div id="perfil">
				<img class="foto" alt="Foto usuario" src="images/user-68x68.jpg" />
				<div class="info">
					<label class="nome">NOME USUÀRIO</label> </br>
					<img src="images/local_menor.png"/><label class="cidade">CIDADE</label></br>
					<a href="iframes/editar_perfil.htm">Editar perfil</a>
				</div>
			</div>
			<div id="menu">
				
				<ul>
					<li>
						<div> <img alt="icone" src="images/atividades.png"/> </div> <a>atividades</a>
					</li>
					<li>
						<div> <img alt="icone" src="images/amigos.png"/> </div> <a>amigos</a>
					</li>
					<li>
						<div> <img alt="icone" src="images/convites.png"/> </div> <a>convites</a>
					</li>
					<li>
						<div> <img alt="icone" src="images/grupos.png"/> </div> <a>grupos</a>
					</li>
				</ul>

			</div>
		</div>
		<div id="dir">
			<?php
				session_start();
				
				if(isset($_SESSION['email']))
				{
					echo"sessao aberta para";
					echo $_SESSION['email'];

				}else{
					// echo"sem seção";
					header("Location: index.php");
					exit();
				}			

			?>
		</div>
		</div>
		<footer>			
			<img src="images/logo-color-dashboard.png" class="logo" />
				<a href="#">Contato</a>
				<a href="#">Quem somos?</a>
				<a href="#">Termos de uso</a>
		</footer>
	</body>
</html>