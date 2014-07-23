$(document).ready(function(){

	$('#btn-criar-atividade').click(function(){
		loadContentTemp('criar-atividade-temp','');
	});

	$('#tab-content').load('atividadescontent/minhas-atividades.php');
	// window.history.pushState('object', 'Atividades', 'Atividades');

});
