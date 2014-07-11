$(document).ready(function(){

	$('a.x').click(function(){
			$('#content-temp').unload();
			$('#content-temp').fadeOut();
			return false;
		});

});