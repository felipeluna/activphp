function validaCadastro(form){
	var nome = $(form).find('input[name="nome"]').val();
	var email = $(form).find('input[name="email"]').val();
	var pass1 = $(form).find('input[name="pass1"]').val();
	var pass2 = $(form).find('input[name="pass2"]').val();
	alert(nome+email+pass1+pass2);

	return false;
}

$(document).ready(function(){

			//=============================
			//REGISTRO AJAX MODULE ========
			//=============================

			var form = $("#cadastroForm");

			var successFunction = function(data){
				data = data.trim();
				if(data == "cadastro.ok"){
					window.location.replace('dashboard.php');
				}else if(data == "cadastro.senhasNaoCoincidem"){
					showError("As senhas fornecidas não coincidem");
					$("#cadastro input[name='pass1'], #cadastro input[name='pass2']").addClass("input-error");
				}else if(data == "cadastro.faltaCampos"){
					showError("Todos os campos devem ser preenchidos");
				}
			};

			var errorFunction = function(data){
				showError("Ops! Ocorreu um Erro. =(, descrição do erro: "+data);
			};

			ajaxSubmitForm(form,successFunction,errorFunction)

});