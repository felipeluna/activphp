function validaCadastro(form){
		window.form = form;
		return false;
	}

$( document ).ready(function() {

	$("select[name='uf']").change(function(){
		$.ajax({
			url: 'loadcidades.php',
			type: 'POST',
			data: $("select[name='uf']").serialize(),
			success: function(data){
				$("select[name='cidade']").html(data);
				var s = document.getElementById('select-cidade');
				s.disabled = false;
			},
			error: function(){
				alert('Erro ao carregar cidades');
			}
			});
	});

	//initial
	// window.history.pushState('object', 'Home - Activfun', 'home');

  	var checker = document.getElementById('checkme');
	var sendbtn = document.getElementById('cadastro_btn');

				// when unchecked or checked, run the function
	function changecbagree(){
	    if(this.checked){
	        sendbtn.disabled = false;
	    } else {
	        sendbtn.disabled = true;
	    }
	}
	checker.onchange = changecbagree;

	function showErroLogin(message){
		$('.errologin').html(message);
		$('.errologin').fadeIn('fast');
	}

	function showError(msg){
			$('#error').slideDown('normal').fadeIn('normal');
			$('#error').html(msg);
			
			// setTimeout(function () {
		 //         $("#error").slideDown('slow').fadeOut('normal');
		 //    	}, 8000
		 //    );
	}

	function hideError(){
		$("#error").slideDown('slow').fadeOut('normal');
	}

});