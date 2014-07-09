<?php
				session_start();
				
				if(isset($_SESSION['email']))
				{
					//LOAD CONTENT

				}else{
					// echo"sem seção";
					header("Location: index.php");
					exit();
				}			

			?>
<!DOCTYPE html>
<html  len="pt">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
		<title>ActivFun - Dashboard</title>
		<link href="styles/dashboard.css" type="text/css" rel="stylesheet" />		
		<script type="text/javascript" src="scripts/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="scripts/dashboard.js"></script>		

		<link rel="shortcut icon" href="images/favicon_activfun.ico" type="image/x-icon">
		<link rel="icon" href="images/favicon_activfun.ico" type="image/x-icon">

	</head>
	<body id="dashboard">
		<header>
			<img class="logo" alt="Logomarca ActivFun Branca" src="images/logo-branca-dashboard.png" />

			<div class="user">
				<img class="notificacoes" src="images/notificacoes.png" />
				<div class="block">
					<img class="foto" alt="Foto usuario" src="images/user_default-35x35.png" />
					<a class="showheaderoptions" href="#"></a>
				<div>
				<ul id="headeroptions">
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
			<div id='success'></div>
			<div id='notice'></div>
			<div id='error'></div>
		<div id="esq">
			<div id="perfil">

				<?php
					//carrega dados do usuario em variaveis para perfil
					require('config.php');
					$email = $_SESSION['email'];
					$usuario_atual = mysql_query("select * from usuarios where email = '$email'");		
					$row_atual = mysql_fetch_array($usuario_atual);

					$cidade = $row_atual['cidades_idcidades'];
					$cidade = mysql_query("select cidade from cidades where idcidades = '$cidade'");		
					$cidade = mysql_fetch_array($cidade);

				?>
				<div class="container">
					<a href="#" id="alterarFoto">Alterar foto</a>
					<img  class="foto" alt="Foto usuario" src="images/user_default-68x68.png" />
				</div>
				<div class="info">
				<?php
					echo "<label class='nome'>";
					echo $row_atual['nome'];
					echo "</label>";
				?>
					</br>
					<img src="images/local_menor.png"/><label class="cidade"><?php echo $cidade['cidade']; ?></label></br>
					<a href="edit">Editar perfil</a>
				</div>
			</div>
			<div id="menu">				
				<ul>
					<li>
						<div> <img alt="icone" src="images/atividades.png"/> </div> <a href="mapa">atividades</a>
					</li>
					<li>
						<div> <img alt="icone" src="images/amigos.png"/> </div> <a href="amigos">amigos</a>
					</li>
					<li>
						<div> <img alt="icone" src="images/convites.png"/> </div> <a href="convites">convites</a>
					</li>
					<li>
						<div> <img alt="icone" src="images/grupos.png"/> </div> <a href="grupos">grupos</a>
					</li>
				</ul>

			</div>
		</div>
		<div id="content">
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