<?php 
	require('config.php');
	if(isset($_POST['submit'])){
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
				$date = $ano . "/" . $mes . "/" . $dia;
			//	echo $date;
				//STR_TO_DATE('$date', '%m/%d/%Y')
				$time = strtotime($date);

				$newformat = date('Y-m-d',$time);

				echo $newformat;

				//interesses
				// $futebol = mysql_real_escape_string($_POST['futebol']);
				// $voley = mysql_real_escape_string($_POST['voley']);
				// $basketball = mysql_real_escape_string($_POST['basketball']);
				// $ciclismo = mysql_real_escape_string($_POST['ciclismo']);
				// $rpg = mysql_real_escape_string($_POST['rpg']);
				// $tabuleiro = mysql_real_escape_string($_POST['tabuleiro']);


				//mysql_query("insert into `usuarios` (``, `$name`, `$email`, `$pass1`,`date(\"Y-m-d\", $aniversario)`,``,`$datestamp`)");
				mysql_query(
					"insert into usuarios (idusuarios, nome, email, password, data_nascimento, foto, create_time )
					values ('','$name', '$email', '$pass1', $newformat, NULL, NULL )"


					) or die(mysql_error());	

		}
			
		
		
	}else{
		
		
		
	}




?>

<form action="register.php" method="POST">
	Nome: <input type="text" name="name" /> </br>
	E-mail: <input type="text" name="email" /> </br>
	Senha: <input type="password" name="pass1" /> <br>
	Confirmar Senha: <input type="password" name="pass2" /> <br>

<div>
	Data de Nascimento: 
<select id="user_data_3i" name="dia">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option selected="selected" value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>

<select id="user_data_2i" name="mes">
<option value="1">January</option>
<option value="2">February</option>
<option value="3">March</option>
<option value="4">April</option>
<option value="5">May</option>
<option selected="selected" value="6">June</option>
<option value="7">July</option>
<option value="8">August</option>
<option value="9">September</option>
<option value="10">October</option>
<option value="11">November</option>
<option value="12">December</option>
</select>
<select id="user_data_1i" name="ano">
<option value="1920">1920</option>
<option value="1921">1921</option>
<option value="1922">1922</option>
<option value="1923">1923</option>
<option value="1924">1924</option>
<option value="1925">1925</option>
<option value="1926">1926</option>
<option value="1927">1927</option>
<option value="1928">1928</option>
<option value="1929">1929</option>
<option value="1930">1930</option>
<option value="1931">1931</option>
<option value="1932">1932</option>
<option value="1933">1933</option>
<option value="1934">1934</option>
<option value="1935">1935</option>
<option value="1936">1936</option>
<option value="1937">1937</option>
<option value="1938">1938</option>
<option value="1939">1939</option>
<option value="1940">1940</option>
<option value="1941">1941</option>
<option value="1942">1942</option>
<option value="1943">1943</option>
<option value="1944">1944</option>
<option value="1945">1945</option>
<option value="1946">1946</option>
<option value="1947">1947</option>
<option value="1948">1948</option>
<option value="1949">1949</option>
<option value="1950">1950</option>
<option value="1951">1951</option>
<option value="1952">1952</option>
<option value="1953">1953</option>
<option value="1954">1954</option>
<option value="1955">1955</option>
<option value="1956">1956</option>
<option value="1957">1957</option>
<option value="1958">1958</option>
<option value="1959">1959</option>
<option value="1960">1960</option>
<option value="1961">1961</option>
<option value="1962">1962</option>
<option value="1963">1963</option>
<option value="1964">1964</option>
<option value="1965">1965</option>
<option value="1966">1966</option>
<option value="1967">1967</option>
<option value="1968">1968</option>
<option value="1969">1969</option>
<option value="1970">1970</option>
<option value="1971">1971</option>
<option value="1972">1972</option>
<option value="1973">1973</option>
<option value="1974">1974</option>
<option value="1975">1975</option>
<option value="1976">1976</option>
<option value="1977">1977</option>
<option value="1978">1978</option>
<option value="1979">1979</option>
<option value="1980">1980</option>
<option value="1981">1981</option>
<option value="1982">1982</option>
<option value="1983">1983</option>
<option value="1984">1984</option>
<option value="1985">1985</option>
<option value="1986">1986</option>
<option value="1987">1987</option>
<option value="1988">1988</option>
<option value="1989">1989</option>
<option value="1990">1990</option>
<option value="1991">1991</option>
<option value="1992">1992</option>
<option value="1993">1993</option>
<option value="1994">1994</option>
<option value="1995">1995</option>
<option value="1996">1996</option>
<option value="1997">1997</option>
<option value="1998">1998</option>
<option value="1999">1999</option>
<option value="2000">2000</option>
<option value="2001">2001</option>
<option value="2002">2002</option>
<option value="2003">2003</option>
<option value="2004">2004</option>
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option selected="selected" value="2014">2014</option><br>
</select>
</div>	
	
	<br>
	Atividades de Interesse: <br>
	
	<input type="checkbox" name="futebol" value="Futebol"  value ='1'>Futebol <br />
	<input type="checkbox" name="voley" value="Voley" value ='1'>Voley <br />
	<input type="checkbox" name="basketball" value="Basketball" value ='1'>Basketball <br />
	<input type="checkbox" name="ciclismo" value="Ciclismo" value ='1'>Cicismo <br />
	<input type="checkbox" name="rpg" value="RPG" value ='1'>RPG/MMO <br />
	<input type="checkbox" name="tabuleiro" value="abuleiro" value ='1'>Jogos de Tabuleiro <br />

	
	
	
	<input type="submit" value="Cadastrar" name="submit"/>
	
	</form>
	


<?php
?>