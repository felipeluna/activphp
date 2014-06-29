$( document ).ready(function() {

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
									if(data == 'ok'){
										showErroLogin('FEZ LOGIN DE BOUA');
									}else{
										showErroLogin('Login e senha não coicidem');
									}
								}else{
									showErroLogin('E-mail e senha devem ser preenchidos');
								}
							},
						ajaxError: function(){showErroLogin();}
					}
				);


				return false;
			});
	});



});