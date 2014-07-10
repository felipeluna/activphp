<?php

	mysql_connect("localhost", "root","");
	mysql_select_db("activfun");

	function cript($pass, $salt){

			// Value:
			// $2a$10$eImiTXuWVxfM37uY4JANjQ==

			// Hash the password with the salt
			$hash = crypt($pass, $salt);

			return $hash;       //add essa na d
	}
?>