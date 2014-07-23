$(document).ready(function(){
	
	$('#tabs a').click(function(){
		$('#tabs a').removeClass('tabSelected');
		$(this).addClass('tabSelected');

		var href = $(this).attr('href');
		href = href.trim();

		$('#tab-content').load(href+".php");
		// window.history.pushState('object', 'Atividades', 'Atividades')	

		//nao da refresh na pagina
		return false;
	});

});