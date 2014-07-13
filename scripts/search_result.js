$(document).ready(function(){

	$('a.x').click(function(){
			$('#content-temp').unload();
			$('#content-temp').fadeOut();

			//limpa campo de busca
			$('#inputBusca270px').val('');
			return false;
		});

});