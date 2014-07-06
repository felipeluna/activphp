$( document ).ready(function() {

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

	$(function(){
			$("#loginForm").submit(function(){
				$.ajax({
						url: 'login_session.php',
						type: 'POST',
						data: $("#loginForm").serialize(),
						success: function(data){
								if(data != ''){
									if(data == 'falta'){
										showErroLogin('E-mail e senha devem ser preenchidos');
									}else if(data == 'ok'){
										window.location.replace('dashboard.php');
									}else{
										// showErroLogin(data);
										showErroLogin('E-mail e/ou senha invalido');
									}
								}else{
									//login ok
									window.location.replace('dashboard.php');
								}
							},
						ajaxError: function(){showErroLogin('Ops! Ocorreu algum erro =( no ajax');}
					}
				);


				return false;
			});
	});

	$('#submit_cadastro_group').click(function(){
		var dis = $('#cadastro_btn').attr('disabled');
		if(dis == 'disabled'){
			alert('Você deve aceitar os termos de uso antes de registrar');
		}
	});

});