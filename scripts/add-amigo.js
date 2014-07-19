$(document).ready(function(){

function addAmigoForm(){
	$('form[name="add-amigo"]').show();
	$('form[name="cancel-amigo"]').hide();
	$('form[name="rmv-amigo"]').hide();
	$('form[name="responde-amigo"]').hide();
}

function cancelAmigoForm(){
	$('form[name="add-amigo"]').hide();
	$('form[name="cancel-amigo"]').show();
	$('form[name="rmv-amigo"]').hide();
	$('form[name="responde-amigo"]').hide();
}

function rmvAmigoForm(){
	$('form[name="add-amigo"]').hide();
	$('form[name="cancel-amigo"]').hide();
	$('form[name="rmv-amigo"]').show();
	$('form[name="responde-amigo"]').hide();
}

function respAmigoForm(){
	$('form[name="add-amigo"]').hide();
	$('form[name="cancel-amigo"]').hide();
	$('form[name="rmv-amigo"]').hide();
	$('form[name="responde-amigo"]').show();
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

	$('form[name="cancel-amigo"]').submit(function(){

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
		    	}else if(data == 'amizade.pedidoaceito' ){
		    		showError('Ops! Parece que o pedido já foi aceito, deseja desfazer a amizade? <a href="#">SIM, DESFAZER AMIZADE</a>');
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
	    url: "submit/rmv-amigo.php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(data){	    		
		    	data = data.trim();
		    	if(data == 'amizade.desfeita'){
		    		showSuccess('Amizade <strong>DESFEITA</strong> com sucesso =D');
		    		addAmigoForm();
		    	}else if(data == 'amizade.jaexiste'){
		    		showError('Ops! Parece que vocês já são amigos');
		    	}else{
		    		showError('Ops! houve algum erro =/');
		    	}
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
			}
		});

		 return false;
	});



	$('form[name="responde-amigo"]').submit(function(e){


		// alert(e.target);
		// alert('add amigo?');
		var p_id = $('input[name="idamigo"]').val();

		$.ajax({
	    type: "POST",
	    url: "submit/aceita-amigo.php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(data){	    		
		    	data = data.trim();
		    	if(data == 'amizade.conviteaceito'){
		    		showSuccess('Convite <strong>ACEITO</strong> com sucesso =)');
		    		rmvAmigoForm();
		    	}else if(data == 'amizade.convitenaomaispendente'){
		    		showError('o convite de amizade já havia sido cancelado');
		    		addAmigoForm();
		    	}
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
			}
		});
		return false;
	});
});