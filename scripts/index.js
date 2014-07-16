
$( document ).ready(function() {

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

	$(".data").mask("99/99/9999");

	$('#submit_cadastro_group').click(function(){
		var dis = $('#cadastro_btn').attr('disabled');
		if(dis == 'disabled'){
			alert('Você deve aceitar os termos de uso antes de registrar');
		}
	});


	// $("#cadastroForm").validate({
	// 		rules:{

	// 		},
	// 		messages:{

	// 		}
	// 	});

	$(".data").mask("99/99/9999");

	// $("#cadastroForm").submit(function(){
	// 	$.ajax({
	// 			url: 'submit/cadastro_submit.php',
	// 			type: 'POST',
	// 			data: $("#cadastroForm").serialize(),
	// 			// dataType: "json",
	// 			success: function(data){
	// 					data = data.trim();
						
	// 					if(data == "cadastro.ok"){
	// 						window.location.replace('dashboard.php');
	// 					}else if(data == "cadastro.senhasNaoCoincidem"){
	// 						showError("As senhas fornecidas não coincidem");
	// 						$("#cadastro input[name='pass1'], #cadastro input[name='pass2']").addClass("input-error");
	// 					}else if(data == "cadastro.faltaCampos"){
	// 						showError("Todos os campos devem ser preenchidos");
	// 					}
	// 				},
	// 			error:function(data){
	// 				showError("Ops! Ocorreu um Erro. =(, descrição do erro: "+data);
	// 			},
				
	// 		}
	// 	);

	// 	return false;
	// });
});