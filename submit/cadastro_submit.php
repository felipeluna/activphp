	<?php 
	require('../config.php');

	if(isset($_POST) && !empty($_POST)){
		//http://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
		$email = $_POST['email'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		$nome = mysql_real_escape_string($_POST['nome']);
		$email = mysql_real_escape_string($email);


		//funcao de teste
		function test_input($data)
		{
		   $data = trim($data);
		   $data = stripslashes($data);
		   $data = htmlspecialchars($data);
		   
		   return $data;
		}

		//definindo variáveis de erro.
		$nameErr = $emailErr = $genderErr = $websiteErr = "";

		if(
			$email != "" &&
			$pass1 != "" &&
			$pass2 != "" &&
			$nome != ""
		){
			if($pass1 == $pass2){
				// tudo ok, pode cadastar.
				// verificação de cadastro.
				// informacoes principais.

				$pass1 = mysql_real_escape_string($pass1);
		

				// A higher "cost" is more secure but consumes more processing power
				$cost = 10;

				// Create a random salt
				$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');

				// Prefix information about the hash so PHP knows how to verify it later.
				// "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
				$salt = sprintf("$2a$%02d$", $cost) . $salt;

				// Value:
				// $2a$10$eImiTXuWVxfM37uY4JANjQ==

				// Hash the password with the salt
				$hash = crypt($pass1, $salt);

				$pass1 = $hash;       //add essa na database.
				//echo $pass1;
				
				//data
				// $ano = mysql_real_escape_string($_POST['ano']);
				// $mes = mysql_real_escape_string($_POST['mes']);
				// $dia = mysql_real_escape_string($_POST['dia']);
			
				// $date = $dia . "/" . $mes . "/" . $ano;
				$date = $_POST['data'];
				
				//LOCAL
				$uf = $_POST['uf'];
				$cidade = $_POST['cidade'];

				
				

				mysql_query(
					"insert into usuarios values ('','$nome', '$email', '$pass1', '$salt', str_to_date('$date', '%d/%m/%Y' ), NULL, SYSDATE(), $cidade);"
					)or die(mysql_error());
				
				$idusuario = mysql_query("select idusuario from usuarios where email = '$email'") or die(mysql_error());
				$idusuario = mysql_fetch_array($idusuario, MYSQL_ASSOC);
				$idusuario = $idusuario['idusuario'];

				foreach($_POST['checkbox'] as $interesse){

				    mysql_query(
							"insert into usuarios_interesses values ({$idusuario}, {$interesse});"
							) or die(mysql_error()." erro ao inserir interesses do usuario");
				}

				
				session_start();
				$_SESSION['idusuario'] = $idusuario;
				$_SESSION['pass'] = $pass1;

				echo "cadastro.ok";
				// header("Location: dashboard.php");
				// exit;
				// mysql_query(

				// 	"insert into usuarios_interesses values ("
				// 	);
			}else{
				echo "cadastro.senhasNaoCoincidem";
			}
		}else{
			echo "cadastro.faltaCampos";
		}
	}else{		
		echo "Ops! Você não pode acessar esta página";
	}
?>