$(document).ready(function(){

			//==========================
			//LOGIN AJAX MODULE ========
			//==========================

			//dados de formulario
			var form = $("#loginForm");

			var successFunction = function(data){
				//tira espaços do inicio e fim
				data = data.trim();

				
				if(data == 'login.ok'){
					//se login foi ok
					window.location.replace('dashboard.php');
				}else if(data == 'login.negado'){
					showErroLogin('Email e senha não coincidem');
				}
			};

			$(form).validate({
				//regras para os campos 
				rules:{
                	email: { required: true, email: true },  
                	pass: { required: true }
				},

				//mensagens para os campos 
				messages: {
					email: { required: 'Informe seu email.', email: 'Ops, informe um email válido' },
                	pass: { required: 'Informe sua senha.' },

				},

				//campo onde erros serão exibidos
				errorLabelContainer: $('.errologin'),
				//função de submeter
				submitHandler:function(){
					ajaxValidated(form, successFunction);
					return false;
				}
			});
			// ajaxSubmitForm(form,successFunction,errorFunction)

});