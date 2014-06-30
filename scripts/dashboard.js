$(document).ready(function(){
	//initial
	$('#content').load('content/atividades.php');

	//handle clicks
	$('#perfil .info a').click(function(){
		$('#content').load('content/edit.php');
		return false;
	});

	$('#menu ul li a').click(function(){

		var page = $(this).attr('href');
		$('#content').load('content/'+page+'.php');
		return false;
	});



	
});
