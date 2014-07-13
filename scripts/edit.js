$( document ).ready(function() {
	
	$(".data").mask("99/99/9999");

	function enableEditButton(){
		$('input[name="submit_edit"]').prop('disabled',false);
		$('input[name="submit_edit"]').val('Editar');
	}

	$("#editform").submit(function(){

		$('input[name="submit_edit"]').prop('disabled',true);
		$('input[name="submit_edit"]').val('Carregando');

		$.ajax({
				url: 'submit/editar_submit.php',
				type: 'POST',
				encoding:"UTF-8",
				data: $("#editform").serialize(),
				dataType: 'json',
				success: function(data){				
						showSuccess("Dados alterados com sucesso! =D", enableEditButton());
						$(".info .nome").html(data.nome);
						$(".info .cidade").html(data.cidade);
					},
				error: function(data){
					alert('errro');
					showError('Erro>>>>>>>>>: '.data);
					enableEditButton();
				},
				ajaxError: function(){
					showError('Ops! Ocorreu algum erro =(');
					enableEditButton();
				}
			}
		);

		return false;
	});


	$("select[name='uf']").change(function(){
		// 
		$.ajax({
			url: 'loadcidades.php',
			type: 'POST',
			data: $("select[name='uf']").serialize(),
			success: function(data){
				$("select[name='cidade']").html(data);
			},
			error: function(){
				alert('Erro ao carregar cidades');
			}
			});

		return false;
	});
});