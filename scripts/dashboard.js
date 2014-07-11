$(document).ready(function(){

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

	function showSuccess(msg){
			$('#success').slideDown('normal').fadeIn('normal');
			$('#success').html(msg);

			setTimeout(function () {
		         $("#success").slideDown('slow').fadeOut('normal');
		      }, 8000
		    );
	}

	function showNotice(msg){
			$('#notice').slideDown('normal').fadeIn('normal');
			$('#notice').html(msg);

			setTimeout(function () {
		         $("#notice").slideDown('slow').fadeOut('normal');
		      }, 8000
		    );
	}

	function showError(msg){
			$('#error').slideDown('normal').fadeIn('normal');
			$('#error').html(msg);
			
			setTimeout(function () {
		         $("#error").slideDown('slow').fadeOut('normal');
		    	}, 8000
		    );
	}

