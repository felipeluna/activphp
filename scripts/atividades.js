$(document).ready(function(){

	$('#atividades-content').load('atividadescontent/minhas-atividades.php');
	// window.history.pushState('object', 'Atividades', 'Atividades');
	$("#tabs a[href='minhas-atividades']").addClass('tabSelected');

	$('#tabs a').click(function(){
		$('#tabs a').removeClass('tabSelected');
		$(this).addClass('tabSelected');

		var href = $(this).attr('href');
		href = href.trim();

		$('#atividades-content').load("atividadescontent/"+href+".php");
		// window.history.pushState('object', 'Atividades', 'Atividades')	

		//nao da refresh na pagina
		return false;

		//ajax

	});

});