$(document).ready(function(){

function fazerFormCancelarPedido(){
	var idamigo = $('input[name="idamigo"]').val();
	var novoHtml = '<input type="hidden" name="idamigo" value="'+idamigo+'" />';
	novoHtml = novoHtml+ '<input type="submit" name="cancela-pedido-amigo_submit" value="Cancelar pedido de amizade">';

	$('form[name="add-amigo"]').html(novoHtml);
	$('form[name="add-amigo"]').attr('name', 'cancela-pedido-amigo');
}

function fazerFormFazerPedido(){
	var idamigo = $('input[name="idamigo"]').val();
	var novoHtml = '<input type="hidden" name="idamigo" value="'+idamigo+'" />';
	novoHtml = novoHtml+ '<input type="submit" name="cancela-pedido-amigo_submit" value="Cancelar pedido de amizade">';

	$('form[name="cancela-pedido-amigo"]').html(novoHtml);
	$('form[name="cancela-pedido-amigo"]').attr('name', 'add-amigo');
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
		    		fazerFormCancelarPedido();
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


	$('form[name="cancela-pedido-amigo"]').submit(function(){

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
		    	if(data == 'amizade.pedidoenviado'){
		    		showSuccess('Convite de amizade enviado =D');
		    		fazerFormCancelarPedido();
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