<?php

# start redirecting output to a buffer
ob_start();

# execute the other PHP file
include("../atividadescontent/criar-atividade.php");

# grab whatever got output since ob_start() (and stop buffering)
$html = ob_get_clean();

echo $html;

?>