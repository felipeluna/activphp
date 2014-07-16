$(document).ready(function(){

			//==========================
			//LOGIN AJAX MODULE ========
			//==========================

			var form = $("#loginForm");

			var successFunction = function(data){
				data = data.trim();
				if(data == 'login.ok'){
					window.location.replace('dashboard.php');
				}else if(data == "login.negado"){
					showErroLogin('E-mail e/ou senha inválidos');
					$("#loginForm input[name='email'],#loginForm input[name='pass']").addClass("input-error");
				}else if(data == "login.faltaCampos"){
					showErroLogin('E-mail e senha devem ser preenchidos');
					$("#loginForm input[name='email'],#loginForm input[name='pass']").addClass("input-error");
				}else{
					showErroLogin('Ops! Ocorreu algum erro inesperado. Tente novamente mais tarde.');
				}
			};

			var errorFunction = function(){

			};

			ajaxSubmitForm(form,successFunction,errorFunction)

});