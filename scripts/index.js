function validaCadastro(form){
		window.form = form;
		return false;
	}

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

	function showErroLogin(message){
		$('.errologin').html(message);
		$('.errologin').fadeIn('fast');
	}

	function showError(msg){
			$('#error').slideDown('normal').fadeIn('normal');
			$('#error').html(msg);
			
			// setTimeout(function () {
		 //         $("#error").slideDown('slow').fadeOut('normal');
		 //    	}, 8000
		 //    );
	}

	function hideError(){
		$("#error").slideDown('slow').fadeOut('normal');
	}

		// $("#loginForm").submit(function(){
		// 	$.ajax({
		// 			url: 'login_session.php',
		// 			type: 'POST',
		// 			data: $("#loginForm").serialize(),
		// 			// dataType:"json",
		// 			success: function(data){
		// 				data = data.trim();
						
		// 					if(data == "login.negado"){
		// 						showErroLogin('E-mail e/ou senha inválidos');
		// 						$("#loginForm input[name='email'],#loginForm input[name='pass']").addClass("input-error");
		// 					}else if(data == "login.faltaCampos"){
		// 						showErroLogin('E-mail e senha devem ser preenchidos');
		// 						$("#loginForm input[name='email'],#loginForm input[name='pass']").addClass("input-error");
		// 					}else if(data == "login.ok"){
		// 						window.location.replace('dashboard.php');
		// 					}
		// 				},
		// 			error: function(req, status, error) {
		// 					alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
		// 				},
		// 			ajaxError: function(){showErroLogin('Ops! Ocorreu algum erro =( no ajax');}
		// 		}
		// 	);
		// 	return false;
		// });

	$('#submit_cadastro_group').click(function(){
		var dis = $('#cadastro_btn').attr('disabled');
		if(dis == 'disabled'){
			alert('Você deve aceitar os termos de uso antes de registrar');
		}
	});

	$(function(){
			$("#cadastroForm").submit(function(){
				$.ajax({
						url: 'register.php',
						type: 'POST',
						data: $("#cadastroForm").serialize(),
						// dataType: "json",
						success: function(data){
								data = data.trim();
								alert(data);
								if(data == "cadastro.ok"){
									window.location.replace('dashboard.php');
								}else if(data == "cadastro.senhasNaoCoincidem"){
									showError("As senhas fornecidas não coincidem");
									$("#cadastro input[name='pass1'], #cadastro input[name='pass2']").addClass("input-error");
								}else if(data == "cadastro.faltaCampos"){
									showError("Todos os campos devem ser preenchidos");
								}
							},
						error:function(){
							showError("Fuuuuu!");
						},
						ajaxError: function(){showErroLogin('Ops! Ocorreu algum erro =( no ajax');}
					}
				);

				return false;
			});
	});
});