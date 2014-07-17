$(document).ready(function(){

	//pega cidade de acordo com uf selecionado
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
                	pass2: { required: true, equalTo: "#pass1" },
                	data: { required: true, dateITA: true},
                	uf: {valueNotEquals: 0},
                	cidade: {valueNotEquals: 0}
				},

				//mensagens para os campos 
				messages: {
					nome: { required: "Prencha seu nome"},  
                	email: { required: "Prencha seu email", email: "Digite um email válido" },  
                	pass1: { required: "Este campo é obrigatório" },
                	pass2: { required: "Este campo é obrigatório" , equalTo: "Sennhas não coincidem" },
                	data: { required: "Campo obrigatório", dateITA: "Data inválida"},
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