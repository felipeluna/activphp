<!-- CSS -->
<link href="styles/content-temp.css" type="text/css" rel="stylesheet" />
<link href="styles/search-result.css" type="text/css" rel="stylesheet" />

<!-- JAVASCRIPT -->
<script src="scripts/content-temp.js" type="text/javascript"></script>

<a href="" class="x"></a>

<?php
	if($_POST){

		function calcDistancia($lat1, $long1, $lat2, $long2)
		{
		    $d2r = 0.017453292519943295769236;

		    $dlong = ($long2 - $long1) * $d2r;
		    $dlat = ($lat2 - $lat1) * $d2r;

		    $temp_sin = sin($dlat/2.0);
		    $temp_cos = cos($lat1 * $d2r);
		    $temp_sin2 = sin($dlong/2.0);

		    $a = ($temp_sin * $temp_sin) + ($temp_cos * $temp_cos) * ($temp_sin2 * $temp_sin2);
		    $c = 2.0 * atan2(sqrt($a), sqrt(1.0 - $a));

		    return 6368.1 * $c;
		}

		require('../config.php');

		$user_lat = $_POST['user_lat'];
		$user_lng = $_POST['user_lng'];

		// $json = $_POST['json'];
		$search = $_POST['search'];
		$filtro = $_POST['filtro'];
		// echo $search;
		// echo $filtro;
		if($filtro == 'atividades'){
				
			include('search-atividades.php');			
			
		}elseif($filtro == 'interesses'){

			include('search-atividades-por-interesse.php');
			
		}elseif($filtro == 'pessoas'){
			include('search-pessoas.php');
		}
	}
?>