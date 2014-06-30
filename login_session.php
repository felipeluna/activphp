<?php
	require('config.php');
	
	if(isset($_POST) && !empty($_POST)){
		$email = mysql_real_escape_string($_POST['email']);
		$senha = $_POST['pass'];

		if($email != "" && $senha !=""){
			$senha = mysql_real_escape_string($senha);

			$sql = mysql_query("SELECT salt FROM usuarios WHERE email = '$email';");

			$row = mysql_fetch_array($sql, MYSQL_ASSOC);

			$senha = cript($senha, $row['salt']);

			$sql = mysql_query("SELECT email, password FROM usuarios WHERE email = '$email' AND password='$senha';");
			$row = mysql_num_rows($sql);

			if($row > 0){
				session_start();
				$_SESSION['email'] = $email;
				$_SESSION['pass'] = $senha;
				
			}else{
				echo "erro";
			}
		}else{
			echo "falta";
		}
	}else{
		echo "";
	}
?>