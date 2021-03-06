$(document).ready(function(){

	$('#dashboard #main-container #content-temp').css("overflow","auto");

function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}

	//initial
	$('#content').load('content/atividades.php');
	// window.history.pushState('object', 'Atividades', 'Atividades');
	$("#menu ul li a[href='atividades']").parent().addClass('selected');

	//handle clicks
	$('#perfil .info a').click(function(){
		$('#content').load('content/edit.php');
		// window.history.pushState('object', 'Editar Perfil', 'editar');

		$('#menu ul li a').parent().removeClass('selected');
		return false;
	});

	$('#alterarFoto').click(function(){
		$('#content').load('content/alterar_foto.php');
		// window.history.pushState('object', 'Editar Perfil', 'editar');

		$('#menu ul li a').parent().removeClass('selected');
		return false;
	});

	$('#menu ul li a').click(function(){

		var page = $(this).attr('href');
		$('#content').load('content/'+page+'.php');

		$('#menu ul li a').parent().removeClass('selected');

		$(this).parent().addClass('selected');

		if(page == 'atividades'){
			$("option[value='atividades']").attr('selected','selected');
		}else if(page == 'amigos'){	
			$("option[value='pessoas']").attr('selected','selected');
		}
   		//This is where we update the address bar with the 'url' parameter
    	// window.history.pushState('object', toTitleCase(page), page);
 
    	//This stops the browser from actually following the link
    	//e.preventDefault();
		return false;
	});

	$('#dashboard header .user .showheaderoptions').click(function(){
		$('#headeroptions').toggle("fast");
	});

	$('#alterarFoto').parent().hover(function(){
		$('#alterarFoto').fadeIn("fast");
	});

	$('#alterarFoto').parent().mouseleave(function(){
		$('#alterarFoto').fadeOut("fast");
	});
});