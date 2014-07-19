$(document).ready(function(){

function addAmigoForm(){
	$('form[name="add-amigo"]').show();
	$('form[name="cancel-amigo"]').hide();
	$('form[name="rmv-amigo"]').hide();
}

function cancelAmigoForm(){
	$('form[name="add-amigo"]').hide();
	$('form[name="cancel-amigo"]').show();
	$('form[name="rmv-amigo"]').hide();
}

function rmvAmigoForm(){
	$('form[name="add-amigo"]').hide();
	$('form[name="cancel-amigo"]').hide();
	$('form[name="rmv-amigo"]').show();
}

$('form[name="add-amigo"]').submit(function(){

		// alert('add amigo?');
		var p_id = $('input[name="idamigo"]').val();

		$.ajax({
	    type: "POST",
	    url: "submit/add-amigo.php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(data){	    		
		    	data = data.trim();
		    	if(data == 'amizade.pedidoenviado'){
		    		showSuccess('Convite de amizade enviado =D');
		    		cancelAmigoForm();
		    	}else if(data == 'amizade.jaexiste'){
		    		showError('Ops! Parece que vocês já são amigos');
		    	}else{
		    		showError('Ops! houver algum erro =/');
		    	}
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
			}
		});

		 return false;
	});

	$('form[name="cancela-amigo"]').submit(function(){

		// alert('add amigo?');
		var p_id = $('input[name="idamigo"]').val();

		$.ajax({
	    type: "POST",
	    url: "submit/cancela-pedido-amigo.php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(data){	    		
		    	data = data.trim();
		    	if(data == 'amizade.pedidocancelado'){
		    		showSuccess('Convite <strong>CANCELADO</strong> com sucesso =)');
		    		addAmigoForm();
		    	}else if(data == 'amizade.naoexiste'){
		    		showSuccess('Amizade já havia sido <strong>DESFEITA</strong>');
		    		addAmigoForm();
		    	}else{
		    		showError('Ops! houver algum erro =/');
		    	}
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
			}
		});
		return false;
	});


	$('form[name="rmv-amigo"]').submit(function(){

		// alert('add amigo?');
		var p_id = $('input[name="idamigo"]').val();

		$.ajax({
	    type: "POST",
	    url: "submit/add-amigo.php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(data){	    		
		    	data = data.trim();
		    	if(data == 'amizade.pedidoenviado'){
		    		showSuccess('Convite de amizade enviado =D');
		    		addAmigoForm();
		    	}else if(data == 'amizade.jaexiste'){
		    		showError('Ops! Parece que vocês já são amigos');
		    	}else{
		    		showError('Ops! houver algum erro =/');
		    	}
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
			}
		});

		 return false;
	});
});