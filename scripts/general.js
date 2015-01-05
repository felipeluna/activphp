	function showErroLogin(message){
		$('.errologin').html(message);
		$('.errologin').fadeIn('fast');
	}


	function showSuccess(msg, func){
			$('#success').slideDown('normal',func).fadeIn('normal');
			$('#success').html(msg);
			
			setTimeout(function () {
		         $("#success").slideDown('slow').fadeOut('normal');
		    	}, 8000
		    );
	}

	function showSuccess(msg){
			$('#success').slideDown('normal').fadeIn('normal');
			$('#success').html(msg);
			
			setTimeout(function () {
		         $("#success").slideDown('slow').fadeOut('normal');
		    	}, 8000
		    );
	}

	function showError(msg){
			$('#error').slideDown('normal').fadeIn('normal');
			$('#error').html(msg);
			
			setTimeout(function () {
		         $("#error").slideDown('slow').fadeOut('normal');
		    	}, 10000
		    );
	}

	function hideError(){
		$("#error").slideDown('slow').fadeOut('normal');
	}

	function showNotice(msg){
			$('#notice').slideDown('normal').fadeIn('normal');
			$('#notice').html(msg);

			setTimeout(function () {
		         $("#notice").slideDown('slow').fadeOut('normal');
		      }, 8000
		    );
	}

function loadContentTemp(pageTemp, p_id){	

   $.ajax({
	    type: "POST",
	    url: pageTemp+".php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(page){
		    	$('#content-temp').html(page);
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
				}
	});

	$('#content-temp').fadeIn('fast');
}


function ajaxSubmitForm(form, successFunction, errorFunction){
	$(form).submit(function(){
		var v_url = $(form).attr('action');
		var v_type = $(form).attr('method');
		$.ajax({
			url: v_url,
			type: v_type,
			dataType: 'html',
			data: $(form).serialize(),
			success: successFunction,
			error: errorFunction,
			ajaxError: function(){showErroLogin('Ops! Ocorreu algum erro =( no ajax');}
			});
		return false;
	});
}

function ajaxValidated(form, successFunction){
	var v_url = $(form).attr('action');
	var v_type = $(form).attr('method');
	$.ajax({
		url: v_url,
		type: v_type,
		dataType: 'html',
		data: $(form).serialize(),
		success: successFunction,
		ajaxError: function(){showErroLogin('Ops! Ocorreu algum erro =( no ajax');}
		});
}

function salvarUserPosition(){
	if(navigator.geolocation){
	    	navigator.geolocation.getCurrentPosition(function(position) {
	     		var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

				//salva posição do usuário
				$('input[name="user_lat"]').val(position.coords.latitude);
  				$('input[name="user_lng"]').val( position.coords.longitude);

  				// alert('dados salvos: '+$('input[name="user_lat"]').val()+" "+ $('input[name="user_lng"]').val());
	    	},
	    	function() {
	      		handleNoGeolocation(true);
	    	});
	  	}
}

function funcoesMapa(){
	salvarUserPosition();
	initializeMap();
}
	

$(document).ready(function(){
	
	var script = document.createElement('script');
	script.type = 'text/javascript';
	script.src = 'http://maps.google.com/maps/api/js?key=AIzaSyBVZqVVZBg3ZgGEFB8Q4eaxiNnA4EPp3YA&libraries=places&sensor=false?v=3.exp&' +
	'callback=funcoesMapa';
	document.body.appendChild(script);	

});