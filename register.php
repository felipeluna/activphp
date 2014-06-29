<?php 
	require('config.php');
	if(isset($_POST['submit_cadastro'])){
		//http://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
		$email = $_POST['email'];
		$pass1 = $_POST['pass1'];
		$pass2 = $_POST['pass2'];
		
		if($pass1 == $pass2){
				// tudo ok, pode cadastar.
				// verificação de cadastro.
				// informacoes principais.

				$datestamp = new DateTime();
				$datestamp->getTimestamp();


				$name = mysql_real_escape_string($_POST['name']);
				$email = mysql_real_escape_string($email);
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
				$ano = mysql_real_escape_string($_POST['ano']);
				$mes = mysql_real_escape_string($_POST['mes']);
				$dia = mysql_real_escape_string($_POST['dia']);
			
				$date = $dia . "-" . $mes . "-" . $ano;
				echo $date;
				
				mysql_query(
					"insert into usuarios (idusuarios, nome, email, password, data_nascimento, foto, create_time )
					values ('','$name', '$email', '$pass1', str_to_date($date, '%d %m %Y'), NULL, NULL )"
					)or die(mysql_error());

				// 	) or die(mysql_error());
				
				foreach($_POST['checkbox'] as $interesse){
				    mysql_query(
							"insert into usuarios_interesses values ((select idusuarios from usuarios where email = '$email'), $interesse)"
							) or die(mysql_error());
				}


				header("Location: dashboard.php");
				exit;
				// mysql_query(

				// 	"insert into usuarios_interesses values ("
				// 	);


		}else{
			echo "SENHAS NAO COINCIDEM";
		}
	}else{
		
		echo "Nao veio do submit";
		
	}
?>