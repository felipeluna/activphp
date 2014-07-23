$(document).ready(function(){



	// idatividade = $('input[name="idatividade"]').val();

	var form = $("form[name='participar']");

	var successFunction = function(){
		
		var txtbtn = $('input[name="participaratividade_submit"]').val();
		if(txtbtn == 'Participar desta atividade'){
			showSuccess("Você agora <strong>participa<strong> desta atividade");
			$('input[name="participaratividade_submit"]').val('Cancelar participação nesta atividade');
			$('input[name="participaratividade_submit"]').removeClass('btn-verde');
			$('input[name="participaratividade_submit"]').addClass('btn-vermelho');

			var atividadePage = $('.tabSelected').attr("href");

			$('#atividades-content').load("atividadescontent/"+atividadePage+".php");

		}else if (txtbtn == 'Cancelar participação nesta atividade'){
			showSuccess("Você <strong>cancelou</strong> sua participação nesta atividade");
			$('input[name="participaratividade_submit"]').val('Participar desta atividade');
			$('input[name="participaratividade_submit"]').addClass('btn-verde');
			$('input[name="participaratividade_submit"]').removeClass('btn-vermelho');

			var atividadePage = $('.tabSelected').attr("href");

			$('#atividades-content').load("atividadescontent/"+atividadePage+".php");
		}
	};

	var errorFunction = function(){
		showError("ops, houve algum erro =/. Tente recarregar a página e tentar novamente.");
	};

	ajaxSubmitForm(form, successFunction, errorFunction);

});