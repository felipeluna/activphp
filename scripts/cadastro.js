$(document).ready(function(){

			//=============================
			//REGISTRO AJAX MODULE ========
			//=============================

			var form = $("#cadastroForm");

			var successFunction = function(data){
				//sem usar o parametro "data" por enquanto
				window.location.replace('dashboard.php');
			};

			//regra personalizada: valor diferente - para campo cidade
			$.validator.addMethod("valueNotEquals", function(value, element, arg){
  				return arg != value;
 			}, "Value must not equal arg.");

			$(form).validate({
				//regras para os campos 
				rules:{
                	nome: { required: true },  
                	email: { required: true, email: true },  
                	pass1: { required: true },
                	pass2: { required: true, equalTo: "$pass1" },
                	data: { required: true, date: true},
                	uf: {valueNotEquals: 0},
                	cidade: {valueNotEquals: 0}
				},

				//mensagens para os campos 
				messages: {
					nome: { required: "Prencha seu nome"},  
                	email: { required: "Prencha seu email" },  
                	pass1: { required: "Este campo é obrigatório" },
                	pass2: { required: "Este campo é obrigatório" , equalTo: "Sennhas não coincidem" },
                	data: { required: "Campo obrigatório", date: "Data inválida"},
                	uf: {valueNotEquals: "Selecione um estado"},
                	cidade: {valueNotEquals: "Selecione uma cidade"}
				},

				//campo onde erros serão exibidos
				// errorLabelContainer: $('.errologin'),
				//função de submeter
				submitHandler:function(){
					ajaxValidated(form, successFunction);
					return false;
				}
			});

});