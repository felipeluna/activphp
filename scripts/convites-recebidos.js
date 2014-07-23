var clicked;

    $('form[name="responde-amigo"]').on('click',function(e){
		clicked = e.target;
	})

	$('form[name="responde-amigo"]').submit(function(e){
		
		var form = $(this);
		//pega input clicado do form
		clicked = $(clicked).attr('name');
		//inicia varial de url do ajax
		var v_url = '';
		//inicia varial de função de sucesso do ajax
		var successFunction = function(){};

		//se elemento clicado for de aceitar
		if(clicked == 'aceita-amigo-submit'){
			//aceitar amigo
			v_url = 'aceita-amigo.php';

			//funcao de sucesso
			successFunction = function(data){ 		
		    	data = data.trim();
		    	if(data == 'amizade.conviteaceito'){
		    		showSuccess('Convite <strong>ACEITO</strong> com sucesso =)');
		    		$(form).parent().parent().fadeOut();

		    	}else if(data == 'amizade.convitenaomaispendente'){
		    		showError('o convite de amizade já havia sido cancelado');
		    		$(form).parent().parent().fadeOut();
		    	}
		    };
		}else{//senao
			//rejeitar amigo
			v_url = 'rejeita-amigo.php';

			//funcao de sucesso
			successFunction = function(data){ 		
		    	data = data.trim();
		    	if(data == 'amizade.conviterejeitado'){
		    		showSuccess('Convite <strong>ACEITO</strong> com sucesso =)');
		    		$(form).parent().parent().fadeOut();
		    	}else if(data == 'amizade.naohaconvite'){
		    		showError('o convite de amizade já havia sido cancelado');
		    		$(form).parent().parent().fadeOut();
		    		addAmigoForm();
		    	}
		    };

		}
		
		//get id_amigo
		var p_id = $(this).find('input[name="idamigo"]').val();

		alert(p_id);

		$.ajax({
	    type: "POST",
	    url: "submit/"+v_url,
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: successFunction,
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
			}
		});
		return false;
	});