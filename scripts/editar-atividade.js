$( document ).ready(function() {

	$(".data").mask("99/99/9999");


	//=======================================
	//CADASTRO ATIVIDADE AJAX MODULE ========
	//=======================================

	//dados de formulario
	var form = $("form[name='editar-atividade-form']");

	var successFunction = function(){
		showSuccess("Atividade EDITARAAAAAAAAAAARA com sucesso! =D");
	};

	$(form).validate({
		//regras para os campos 
		rules:{
        	titulo: { required: true},  
        	descricao: { required: true },
        	endereco: { required: true },
        	data: { required: true , dateITA: true},
        	hora: { required: true , time: true},
        	duracao: { required: true , time: true},
			visibilidade: { required: true},
			idinteresse: { required: true}
		},

		//mensagens para os campos 
		messages: {
			titulo: { required: "Campo obrigatório"},  
        	descricao: { required: "Campo obrigatório" },
        	endereco: { required: "Campo obrigatório" },
        	data: { required: "Campo obrigatório" , dateITA: "Data inválida"},
        	hora: { required: "Campo obrigatório" , time: "Formato de hora inválido, deve ser hh:mm"},
        	duracao: { required: "Campo obrigatório" , time: "Formato de hora inválido, deve ser hh:mm"},
			visibilidade: { required: "Campo obrigatório"},
			idinteresse: { required: "Campo obrigatório"}
		},
		//função de submeter
		submitHandler:function(){
			ajaxValidated(form, successFunction);
			return false;
		}
	});

});