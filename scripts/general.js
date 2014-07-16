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