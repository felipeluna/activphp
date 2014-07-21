$( document ).ready(function() {

	$.getScript('scripts/moment.min.js');

	$(".data").mask("99/99/9999");


	//=======================================
	//CADASTRO ATIVIDADE AJAX MODULE ========
	//=======================================

	//dados de formulario
	var form = $("form[name='editar-atividade-form']");

	var successFunction = function(){
		showSuccess("Atividade <strong>EDITADA</strong> com sucesso! =D");
		$('#content-temp').unload();
		$('#content-temp').fadeOut();

		var atividadePage = $('.tabSelected').attr("href");

		$('#atividades-content').load("atividadescontent/"+atividadePage+".php");

		// rola pro fim da página
		// $("#content").animate({ scrollTop: $('#content')[0].scrollHeight}, 1000);
	};

	var datadosistema = $('input[name="datadosistema"]').val();

	jQuery.validator.addMethod("dateGreaterThan",
	function(value, element){
		var inputdate = moment(value, "DD/MM/YYYY");
		var today = moment(datadosistema, "DD/MM/YYYY");
		inputdate = inputdate.toDate();
		today = today.toDate();

		// alert('value: '+value);
		// var hoje = today.getDate(); 
	    if (!/Invalid|NaN/.test(new Date(inputdate))){
	    	var result = new Date(inputdate) >= new Date(today);
	    	// alert("result 1: "+result);
	        return result;
	    }

	    var result2 = isNaN(inputdate) && isNaN(today)
	        || (Number(inputdate) >= Number(today)); 
	        // alert('result2 :'+result2);
	    return result2;
	},'A data deve ser hoje('+datadosistema+') ou depois');

	$(form).validate({
		//regras para os campos 
		rules:{
        	titulo: { required: true},  
        	descricao: { required: true },
        	endereco: { required: true },
        	data: { required: true , dateITA: true, dateGreaterThan:true },
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
        	data: { required: "Campo obrigatório" , dateITA: "Data inválida", dateGreaterThan:'A data deve ser hoje('+datadosistema+') ou depois' },
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