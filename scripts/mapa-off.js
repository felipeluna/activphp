function showErroLogin(message){
		$('.errologin').html(message);
		$('.errologin').fadeIn('fast');
	}
	
$(document).ready(function(){
			$("#loginForm").submit(function(){
				$.ajax({
						url: 'login_session.php',
						type: 'POST',
						data: $("#loginForm").serialize(),
						// dataType:"json",
						success: function(data){
							data = data.trim();
								if(data == "login.negado"){
									showErroLogin('E-mail e/ou senha inválidos');
									$("#loginForm input[name='email'],#loginForm input[name='pass']").addClass("input-error");
								}else if(data == "login.faltaCampos"){
									showErroLogin('E-mail e senha devem ser preenchidos');
									$("#loginForm input[name='email'],#loginForm input[name='pass']").addClass("input-error");
								}else if(data == "login.ok"){
									window.location.replace('dashboard.php');
								}
							},
						error: function(req, status, error) {
   							alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
   						},
						ajaxError: function(){showErroLogin('Ops! Ocorreu algum erro =( no ajax');}
					}
				);
				return false;
			});
});